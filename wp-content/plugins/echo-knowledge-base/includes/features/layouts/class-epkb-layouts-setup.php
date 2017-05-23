<?php  if ( ! defined( 'ABSPATH' ) ) exit;

class EPKB_Layouts_Setup {

	static $demo_mode = false;

	public function __construct() {
		add_shortcode( EPKB_KB_Handler::KB_MAIN_PAGE_SHORTCODE_NAME, array( 'EPKB_Layouts_Setup', 'output_kb_main_page_shortcode' ) );
		add_filter( 'query_vars', array($this, 'add_article_slug_query_var') );
	}

	/**
	 * Output layout based on KB Shortcode. We could be either on Main Page or on Article Page with Sidebar Layout (see rewrite rules).
	 * Never called on article link with Sidebar Layout not on (could be deactivated).
	 *
	 * SCENARIOS:
	 *   - Basic/Tabs -> Sidebar Layout
	 *   - Basic/Tabs -> Article
	 *   - Grid -> Sidebar Layout
	 *   - Sidebar Layout
	 *   - Grid/Sidebar Layout BUT when Elegant Layouts is temporary disabled
	 *
	 * @param array $shortcode_attributes are shortcode attributes that the user added with the shortcode

	 * @return string of HTML output replacing the shortcode itself
	 */
	public static function output_kb_main_page_shortcode( $shortcode_attributes) {

		$kb_config = self::get_kb_config( $shortcode_attributes );

		// determine whether this is Main Page or Article Page
		$main_page_layout = EPKB_KB_Config_Layouts::get_kb_main_page_layout_name( $kb_config );
		$is_article_page = EPKB_KB_Handler::is_on_page_with_article_url() && $main_page_layout != EPKB_KB_Config_Layouts::SIDEBAR_LAYOUT;
		if ( $is_article_page ) {
			return self::output_article_page( $kb_config );
		} else {
			return self:: output_kb_main_page( $kb_config );
		}
	}

	/**
	 * Show KB Main page. If the Article Page has layout then output it here.
	 *
	 * @param bool $is_builder_on
	 * @param null $kb_config
	 * @param array $article_seq
	 * @param array $categories_seq
	 *
	 * @return string
	 */
	public static function output_kb_main_page( $kb_config, $is_builder_on=false, $article_seq=array(), $categories_seq=array() ) {

		// let layout class display the KB main page
		$layout_output = '';
		$layout = empty($kb_config['kb_main_page_layout']) ? '' : $kb_config['kb_main_page_layout'];
		if ( ! self::is_core_layout( $layout ) ) {
			ob_start();
			apply_filters( 'epkb_' . strtolower($layout) . '_layout_output', $kb_config, $is_builder_on, $article_seq, $categories_seq );
			$layout_output = ob_get_clean();

			// use Basic Layout if current layout is missing
			$layout = empty($layout_output) ? EPKB_KB_Config_Layout_Basic::LAYOUT_NAME : $layout;
		}

		// if this is core layout then generate it; for missing non-core layouts use Basic one
		if ( empty($layout_output) ) {
			$layout_class_name = 'EPKB_Layout_' . ucfirst($layout);
			$layout_class = class_exists($layout_class_name) ? new $layout_class_name() : new EPKB_Layout_Basic();
			ob_start();
			$layout_class->display_kb_main_page( $kb_config, $is_builder_on, $article_seq, $categories_seq );
			$layout_output = ob_get_clean();
		}

		return $layout_output;
	}

	/**
	 * Outputs current layout (not just article) of the Article Page
	 *
	 * @param $kb_config
	 * @param bool $is_builder_on
	 * @param array $article_seq
	 * @param array $categories_seq
	 *
	 * @return string
	 */
	public static function output_article_page( $kb_config, $is_builder_on=false, $article_seq=array(), $categories_seq=array() ) {

		// get Article Page Layout
		$layout_output = '';
		$layout = empty($kb_config['kb_article_page_layout']) ? '' : $kb_config['kb_article_page_layout'];
		if ( $layout == EPKB_KB_Config_Layouts::SIDEBAR_LAYOUT ) {
			ob_start();
			apply_filters( 'epkb_article_page_layout_output', $kb_config, $is_builder_on, $article_seq, $categories_seq );
			$layout_output = ob_get_clean();
		}

		// if no layout found then just display article
		if ( empty($layout_output) ) {

			if ( self::$demo_mode ) {
				$kb_config['empty_article_content'] = EPKB_KB_Demo_Data::get_demo_article();
				$post = null;
			} else {
				$max_category_level = apply_filters( 'epkb_max_layout_level', $kb_config['kb_article_page_layout'] );
				$max_category_level = EPKB_Utilities::is_positive_or_zero_int( $max_category_level ) ? $max_category_level : 3;
				$post = self::get_first_article( $categories_seq, $article_seq, $max_category_level );
			}

			$layout_output = '<div id="epkb-article-page-container">';
			$layout_output .= self::display_article( $post, $kb_config['empty_article_content'], false);
			$layout_output .= '</div>';
		}

		return $layout_output;
	}

	private static function is_core_layout( $layout ) {
		return $layout == EPKB_KB_Config_Layout_Basic::LAYOUT_NAME || $layout == EPKB_KB_Config_Layout_Tabs::LAYOUT_NAME;
	}

	/**
	 * Check that the layout exists and is properly configured
	 *
	 * @param array $shortcode_attributes
	 *
	 * @return array return the KB configuration
	 */
	private static function get_kb_config( $shortcode_attributes ) {

		$kb_id = empty($shortcode_attributes['id']) ? EPKB_KB_Config_DB::DEFAULT_KB_ID : $shortcode_attributes['id'] ;
		if ( ! EPKB_Utilities::is_positive_int( $kb_id ) ) {
			EPKB_Logging::add_log_var( "KB ID in shortcode is invalid. Using KB ID 1 instead of: ", $kb_id );
			$kb_id = EPKB_KB_Config_DB::DEFAULT_KB_ID;
		}

		if ( count( $shortcode_attributes ) > 1 ) {
			EPKB_Logging::add_log_var( "KB with ID " . $kb_id . ' has too many shortcode attributes', $shortcode_attributes );
		}

		//retrieve KB config
		$kb_config = epkb_get_instance()->kb_config_ojb->get_kb_config( $kb_id );
		if ( is_wp_error( $kb_config ) ) {
			EPKB_Logging::add_log_var( "failed to retrieve KB configuration. Using defaults instead.", $kb_id, $kb_config );
			$kb_config = EPKB_KB_Config_Specs::get_default_kb_config( $kb_id );
		}

		return $kb_config;
	}

	/**
	 * Add article slug param, used for layouts with article
	 * 
	 * @param $query_vars
	 * @return array
	 */
	public function add_article_slug_query_var( $query_vars ) {
		$query_vars[] = 'epkb_article_page';
		return $query_vars;
	}

	/**
	 * Display first article when user loads the KB Main Page the first time without article slug
	 *
	 * @param $category_seq_data
	 * @param $articles_seq_data
	 * @param int $level
	 * @param bool $return_post_id
	 * @return null|WP_Post|int - based on $return_post_id it will return post id or WP Post or null
	 */
	public static function get_first_article( $category_seq_data, $articles_seq_data, $level=2, $return_post_id=false ) {

		$post = null;

		// find it on the first level
		foreach( $category_seq_data as $category_id => $sub_categories ) {
			if ( ! empty($articles_seq_data[$category_id]) ) {
				$keys = array_keys($articles_seq_data[$category_id]);
				if ( ! empty($keys[2]) && EPKB_Utilities::is_positive_int( $keys[2] ) ) {
					return $return_post_id ? $keys[2] : EPKB_Utilities::get_post_secure( $keys[2] );
				}
			}

			if ( $level < 2 ) {
				continue;
			}

			// find it on the second level
			foreach( $sub_categories as $sub_category_id => $sub_sub_categories ) {
				if ( ! empty( $articles_seq_data[ $sub_category_id ] ) ) {
					$keys = array_keys( $articles_seq_data[ $sub_category_id ] );
					if ( ! empty( $keys[2] ) && EPKB_Utilities::is_positive_int( $keys[2] ) ) {
						return $return_post_id ? $keys[2] : EPKB_Utilities::get_post_secure( $keys[2] );
					}
				}

				if ( $level < 3 ) {
					continue;
				}

				// find it on the third level
				foreach( $sub_sub_categories as $sub_sub_category_id => $sub_sub_sub_categories ) {
					if ( ! empty( $articles_seq_data[ $sub_sub_category_id ] ) ) {
						$keys = array_keys( $articles_seq_data[ $sub_sub_category_id ] );
						if ( ! empty( $keys[2] ) && EPKB_Utilities::is_positive_int( $keys[2] ) ) {
							return $return_post_id ? $keys[2] : EPKB_Utilities::get_post_secure( $keys[2] );
						}
					}
				}
			}
		}

		return $post;
	}

	/**
	 * Knowledge Base Article template
	 *
	 * This template is used by KB system to display an article based on settings in KB admin template
	 *
	 * @param WP_Post $post
	 * @param bool $display - whether to return or echo the article content
	 * @param $empty_post_meg
	 * @return mixed|string
	 */
	public static function display_article( $post, $empty_post_meg, $display=true ) {

		$post = self::$demo_mode ? null : $post;

		if ( empty($post) ) {
			$content = wp_kses_post( $empty_post_meg );
		} else {
			$content = '<h2 class="article_title kb-article-id" id="' . $post->ID . '">' . esc_html($post->post_title ) . '</h2>';
			$content .= $post->post_content;
			$content .= '<div>Last updated on ' . DateTime::createFromFormat( 'Y-m-d H:i:s', $post->post_modified )->format( 'F d, Y' ) . '</div>';
			$content = apply_filters( 'the_content', $content );
			$content = str_replace( ']]>', ']]&gt;', $content );
		}

		$output = '<main id="main" class="site-main" role="main">' .
		          '<div id="kb-article-content">' . $content . '</div>' .
		          '</main>';

		if ( $display ) {
			echo $output;
		}

		return $output;
	}
}
