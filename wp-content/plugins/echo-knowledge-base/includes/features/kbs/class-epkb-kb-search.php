<?php  if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Search Knowledge Base
 *
 * @copyright   Copyright (C) 2017, Echo Plugins
 */
class EPKB_KB_Search {

	public function __construct() {
		add_action( 'wp_ajax_epkb-search-kb', array($this, 'search_kb') );
		add_action( 'wp_ajax_nopriv_epkb-search-kb', array($this, 'search_kb') );
	}

	/**
	 * Process AJAX search request
	 */
	public function search_kb() {
		/** @var wpdb $wpdb */
		global $wpdb;

		// we don't need nonce and permission check here

		$kb_id = EPKB_Utilities::sanitize_get_id( $_GET['epkb_kb_id'] );
		if ( is_wp_error( $kb_id ) ) {
			EPKB_Logging::add_log_var("found invalid kb_id when saving config", $kb_id );
			wp_die( json_encode( array( 'status' => 'success', 'search_result' => esc_html__( 'Error occurred. Please try again later.', 'echo-knowledge-base' ) ) ) );
		}

		$kb_config = epkb_get_instance()->kb_config_ojb->get_kb_config( $kb_id );
		if ( is_wp_error( $kb_config ) ) {
			EPKB_Logging::add_log_var( "failed to retrieve KB configuration. Using defaults instead.", $kb_id, $kb_config );
			$kb_config = EPKB_KB_Config_Specs::get_default_kb_config( $kb_id );
		}

		$search_terms = isset($_GET['search_words']) ? $_GET['search_words'] : '';
		$search_terms = sanitize_text_field($search_terms);

		// require minimum size of search word(s)
		if ( empty($search_terms) || strlen($search_terms) < 3 ) {
			wp_die( json_encode( array( 'status' => 'success', 'search_result' => esc_html__( $kb_config['min_search_word_size_msg'], 'echo-knowledge-base' ) ) ) );
		}

		// search for given keyword(s)
		$like_search_term = '%' . $wpdb->esc_like($search_terms) . '%';
		$query = $wpdb->get_results(
			$wpdb->prepare("
							SELECT DISTINCT ID, post_title, post_content, guid
							FROM $wpdb->posts wp LEFT JOIN $wpdb->postmeta wpm "  /** @secure 02.17 */  . "
							ON post_id = ID
							WHERE post_type = '%s'
								AND post_status = 'publish'  " /** only PUBLISHED results */ . "
								AND (
									post_title LIKE '%s' OR
									post_content LIKE '%s'
							) ",
				EPKB_KB_Handler::get_post_type( $kb_id ), $like_search_term, $like_search_term, $like_search_term ));

		if ( empty($query) ) {
			$search_result = __( $kb_config['no_results_found'], 'echo-knowledge-base' );

		} else {
			$search_result = '<h3>' . esc_html__( $kb_config['search_results_msg'], 'echo-knowledge-base' ) . ' ' . $search_terms . '</h3>';
			$search_result .= '<ul>';
			foreach( $query as $row ) {
				$article_url = get_permalink( $row->ID );
				if ( empty($article_url) ) {
					continue;
				}

				$search_result .=
					'<li>' .
						'<a href="' .  esc_url( $article_url ) . '" class="epkb-ajax-search" data-kb-article-id="' . $row->ID . '">' .
							'<span class="epkb-article-title">' .
								'<i class="ep_icon_document"></i>' .
								'<span>'.esc_html($row->post_title).'</span>' .
							'</span>' .
						'</a>' .
					'</li>';
			}
			$search_result .= '</ul>';
		}

		// we are done here
		wp_die( json_encode( array( 'status' => 'success', 'search_result' => $search_result ) ) );
	}

}
