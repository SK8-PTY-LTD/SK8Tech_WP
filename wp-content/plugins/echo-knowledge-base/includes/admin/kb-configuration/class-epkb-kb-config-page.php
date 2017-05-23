<?php  if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Display feature settings
 *
 * @copyright   Copyright (C) 2017, Echo Plugins
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class EPKB_KB_Config_Page {
	
	var $kb_config = array();
	/** @var  EPKB_KB_Config_Elements */
	var $form;
	var $feature_specs = array();
	var $kb_main_page_layout = EPKB_KB_Config_Layout_Basic::LAYOUT_NAME;
	var $kb_article_page_layout = EPKB_KB_Config_Layouts::KB_ARTICLE_PAGE_NO_LAYOUT;
	var $show_main_page = false;

	public function __construct( $kb_config=array() ) {
		$this->kb_config              = empty($kb_config) ? epkb_get_instance()->kb_config_ojb->get_current_kb_configuration() : $kb_config;
		$this->feature_specs          = EPKB_KB_Config_Specs::get_fields_specification( $this->kb_config['id'] );
		$this->form                   = new EPKB_KB_Config_Elements();
		$this->kb_main_page_layout    = EPKB_KB_Config_Layouts::get_kb_main_page_layout_name( $this->kb_config );
		$this->kb_article_page_layout = EPKB_KB_Config_Layouts::get_article_page_layout_name( $this->kb_config );
		$this->show_main_page         = isset($_REQUEST['epkb-demo']) || isset($_REQUEST['ekb-main-page']);
	}

	/**
	 * Displays the KB Config page with top panel + sidebar + preview panel
	 */
	public function display_kb_config_page() {

		// setup hooks for KB config fields for core layouts
		EPKB_KB_Config_Layouts::register_kb_config_hooks();

		// display all elements of the configuration page
		$this->display_page();
	}

	/**
	 * Display KB Config content areas
	 */
	private function display_page() {        ?>

		<div class="wrap">
			<h1></h1>
		</div>
		<div id="ekb-admin-page-wrap" class="ekb-admin-page-wrap epkb-config-container">
			<div class="epkb-config-wrapper">
				<div class="wrap" id="ekb_core_top_heading">
					<div><a hidden id="top"></a></div>
				</div>

				<div id="epkb-config-main-info">		<?php
					$this->display_top_panel(); ?>
				</div>  <?php
					$this->display_main_panel();

					$this->display_sidebar();  ?>
			</div>

            <div class="epkb-kb-config-notice-message"></div>
		</div>
		<div id="epkb-dialog-sequence-now-custom"></div>

		<div id="epkb-dialog-info-icon" title="" style="display: none;">
			<p id="epkb-dialog-info-icon-msg"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span></p>
		</div>		<?php
	}

	/**
	 * Display SIDEBAR for given TOP icon - KB Main Page / Article Page
	 */
	private function display_sidebar() {	    ?>

		<form id="epkb-config-config">

	        <div class="epkb-sidebar-container" id="epkb-main-page-settings" style="display: none;">
	            <div class="epkb-menu-header">
	                <div class="epkb-header-name">
	                    <h2>Main Page</h2>
	                </div>
	            </div>
	            <ul class="epkb-menu-level">                              <?php
		            $this->display_kb_main_page_sections();     ?>
				</ul>
			</div>

			<div class="epkb-sidebar-container" id="epkb-article-page-settings" style="display: none;">
	            <div class="epkb-menu-header">
	                <div class="epkb-header-name">
	                    <h2>Article Page</h2>
	                </div>
	            </div>
	            <ul class="epkb-menu-level">                              <?php
				    $this->display_article_page_sections();     ?>
				</ul>
			</div>

			<div id='epkb-ajax-in-progress' style="display:none;">
				<?php esc_html__( 'Saving configuration', 'echo-knowledge-base' ); ?> <img class="epkb-ajax waiting" style="height: 30px;" src="<?php echo Echo_Knowledge_Base::$plugin_url . 'img/loading_spinner.gif'; ?>">
			</div>

			<div id="epkb-dialog-info-config" title="" style="display: none;">
				<p id="epkb-dialog-info-config-msg"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span></p>
			</div>

			<input type="text" name="kb_name" id="kb_name" value="<?php echo $this->kb_config['kb_name']; ?>" hidden>
		</form>      <?php
	}

	/**************************************************************************************
	 *
	 *                   TOP PANEL
	 *
	 *************************************************************************************/

	/**
	 * Display top overview panel
	 */
	private function display_top_panel() {

		$article_page_layouts = EPKB_KB_Config_Layouts::get_article_page_layouts( $this->kb_main_page_layout );
		$hidden = empty($article_page_layouts) ? 'style="display: none;"' : '';     ?>

		<div class="epkb-info-section epkb-kb-name-section">   <?php
			$this->display_list_of_kbs(); 			?>
		</div>

		<div class="epkb-info-section epkb-info-main <?php echo $this->show_main_page ? '' : 'epkb-active-page'; ?>">
			<div class="overview-icon-container">
				<p>Overview</p>
				<div class="page-icon overview-icon ep_icon_data_report" id="epkb-config-overview"></div>
			</div>
		</div>

		<!--  MAIN PAGE BUTTONS -->
		<div class="epkb-info-section epkb-info-pages <?php echo $this->show_main_page ? 'epkb-active-page' : ''; ?>" id="epkb-main-page-button">
			<div class="page-icon-container">
				<p>Main Page</p>
				<div class="page-icon ep_icon_flow_chart" id="epkb-main-page"></div>
                <div id="epkb-user-flow-arrow" class="user_flow_arrow_icon  ep_icon_arrow_carrot_right" <?php echo $hidden; ?>></div>
			</div>
		</div>

		<!--  ARTICLE PAGE BUTTONS -->
		<div class="epkb-info-section epkb-info-pages" id="epkb-article-page-button" <?php echo $hidden; ?>>
			<div class="page-icon-container">
				<p>Article Page</p>
				<div class="page-icon ep_icon_document" id="epkb-article-page"></div>
			</div>
		</div>

		<div class="epkb-info-section epkb-info-save" style="display:none;">			<?php
			$this->form->submit_button( array(
				'label'             => 'Save',
				'id'                => 'epkb_save_kb_config',
				'main_class'        => 'epkb_save_kb_config',
				'action'            => 'epkb_save_kb_config',
				'input_class'       => 'epkb-info-settings-button',
			) );

			$this->form->submit_button( array(
				'label'             => 'Cancel',
				'id'                => 'epkb_cancel_config',
				'main_class'        => 'epkb_cancel_config',
				'action'            => 'epkb_cancel_config',
				'input_class'       => 'epkb-info-settings-button',
			) );    ?>
		</div>		<?php
	}


	/**************************************************************************************
	 *
	 *                   MAIN PANEL
	 *
	 *************************************************************************************/

	/**
	 * Display individual preview panels
	 */
	private function display_main_panel() {       ?>

		<div class="epkb-config-content" id="epkb-config-overview-content" <?php echo $this->show_main_page ? 'style="display: none;"' : ''; ?>>   <?php
			$this->display_overview();  	?>
		</div>

		<div class="epkb-config-content" id="epkb-main-page-content" <?php echo $this->show_main_page ? '' : 'style="display: none;"'; ?>>    <?php
			$this->display_kb_main_page_layout_preview();     ?>
		</div>

		<div class="epkb-config-content" id="epkb-article-page-content" style="display: none;">    <?php
			$this->display_article_page_layout_preview();     ?>
		</div>

		<input type="hidden" id="epkb_kb_id" value="<?php echo $this->kb_config['id']; ?>"/>   <?php
	}

	/**
	 * Display Overview Page
	 *
	 * @param array $articles_seq_data
	 * @param array $category_seq_data
	 */
	public function display_overview( $articles_seq_data=array(), $category_seq_data=array() ) {

		$kb_id = $this->kb_config['id'];

		$all_kb_terms      = EPKB_Categories_DB::get_kb_categories( $kb_id );
		$nof_kb_categories = $all_kb_terms === null ? 'unknown' : count( $all_kb_terms );
		$nof_kb_articles   = EPKB_Articles_DB::get_count_of_all_kb_articles( $kb_id );

		$kb_main_pages_url = '';
		$kb_main_pages_info = EPKB_KB_Handler::get_kb_main_pages( $this->kb_config );
		foreach( $kb_main_pages_info as $post_id => $post_info ) {
			$post_status = $post_info['post_status'] == 'Published' ? '' : ' (' . $post_info['post_status'] . ')';
			$kb_main_pages_url .= '  <li>' .	$post_info['post_title'] . $post_status . ' &nbsp;&nbsp;';

			if ( $post_info['post_status'] != 'Trash' ) {
				$kb_main_pages_url .= '<a href="' . get_permalink( $post_id ) . '" target="_blank">View</a> ';
			}

			$kb_main_pages_url .= ' &nbsp;&nbsp;<a href="' . get_edit_post_link( $post_id ) . '" target="_blank">' . esc_html__( 'Edit', 'echo-knowledge-base' ) . '</a></li>';
		}

		$kb_main_pages_url = empty($kb_main_pages_url) ? ' &nbsp None found' : $kb_main_pages_url;

		if ( $this->display_upgrade_message() ) {
			?>

			<div class="callout callout_success epkb_upgrade_message">
				<h4>What's New</h4>
				<p>         <?php
					$i18_what_is_new_link = '<a href="' . admin_url( 'index.php?page=epkb-welcome-page' ) . '" target="_blank">' .
					                        esc_html__( 'here', 'echo-knowledge-base' ) . '</a>';
					$plugin_name = '<strong>' . __('Knowledge Base', 'echo-knowledge-base') . '</strong>';
					$output = $plugin_name . ' ' . sprintf( esc_html( _x( 'plugin was updated to version %s. Check out new features and improvements %s ',
							' version number, link to what is new page', 'echo-knowledge-base' ) ),
							Echo_Knowledge_Base::$version, $i18_what_is_new_link );
					echo $output;    ?>
				</p>  <?php
					echo apply_filters( 'epkb_add_on_upgrade_message', '' );				?>
				<button id="epkb_close_upgrade"><?php esc_html_e( 'Close', 'echo-knowledge-base' ); ?></button>
			</div>		<?php
		}   ?>

		<div class="callout callout_info">
			<h4>Dashboard</h4>
            <div class="row">
                <div class="config-col-4">
		            <?php
		            echo $this->form->text(  array(
				            'name' => 'kb_name_tmp', // used as placeholder to polute actual field in the sidebar <form>
				            'value' => isset($this->kb_config[ 'name' ]) ? $this->kb_config[ 'name' ] : $this->kb_config[ 'kb_name' ],  // TODO remove isset()
				            'input_group_class' => 'config-col-12',
				            'label_class' => 'config-col-3',
				            'input_class' => 'config-col-9'
			            ) + $this->feature_specs['kb_name'] );
		            ?>
                </div>
                <div class="config-col-6">

                    <div class="config-col-3">
			            <?php
			            $this->form->submit_button( array(
				            'label'             => 'Update',
				            'id'                => 'epkb_save_dashboard',
				            'main_class'        => 'epkb_save_dashboard',
				            'action'            => 'epkb_save_dashboard',
				            'input_class'       => 'epkb-info-settings-button'
			            ) );
			            ?>
                    </div>
                    <div class="config-col-3">
			            <?php
			            $this->form->submit_button( array(
				            'label'             => 'Cancel',
				            'id'                => 'epkb_cancel_dashboard',
				            'main_class'        => 'epkb_cancel_dashboard',
				            'action'            => 'epkb_cancel_dashboard',
				            'input_class'       => 'epkb-info-settings-button',
			            ) );
			            ?>
                    </div>

                </div>
            </div>


		</div>  <?php

		echo EPKB_KB_Handler::get_kb_status_msg( $this->kb_config, $this->kb_config['kb_main_page_layout'], $articles_seq_data, $category_seq_data ); ?>

		<div class="callout callout_info">
			<h4>KB Main Page</h4>
			<p>To display a <strong>Knowledge Base Main page</strong>, add the following KB shortcode to any page: &nbsp;&nbsp;<strong>
					[<?php echo EPKB_KB_Handler::KB_MAIN_PAGE_SHORTCODE_NAME . ' id=' . $kb_id; ?>]</strong></p>
			<p><strong>Existing KB Main Page(s):</strong></p>
			<ul>
				<?php echo $kb_main_pages_url; ?>
			</ul>
		</div>

		<div class="callout callout_info">
			<h4>KB Categories</h4>
			<p><strong>KB Categories</strong> help you to organize KB articles into groups and hierarchies.</p>
			<ul>
				<li><a href="<?php echo admin_url('edit-tags.php?taxonomy=' . EPKB_KB_Handler::get_category_taxonomy_name( $kb_id ) .
				                                  '&post_type=' . EPKB_KB_Handler::get_post_type( $kb_id )); ?>">View all your Categories</a></li>
				<li>Total Categories: <?php echo $nof_kb_categories; ?></li>
			</ul>
		</div>

		<div class="callout callout_info">
			<h4>KB Articles</h4>
			<p><strong>KB article</strong> belongs to one or more KB categories or sub-categories.</p>
			<ul>
				<li><a href="<?php echo admin_url('edit.php?post_type=' . EPKB_KB_Handler::get_post_type( $kb_id )); ?>">View all your Articles</a></li>
				<li>Total Articles: <?php echo $nof_kb_articles; ?></li>
			</ul>

		</div>   <?php
	}

	/**
	 * Display the Main Page layout preview.
	 *
	 * @param bool $display
	 * @param array $articles_seq_data
	 * @param array $category_seq_data
	 * @return string
	 */
	public function display_kb_main_page_layout_preview( $display=true, $articles_seq_data=array(), $category_seq_data=array() ) {

		// retrieve KB preview using Current KB or Demo KB
		// setup either current KB or demo KB data
		$checked = '';
		if ( isset($_REQUEST['epkb-demo']) || ( isset($_POST['epkb_demo_kb']) && $_POST['epkb_demo_kb'] == "true" ) ) {
			$demo_data = EPKB_KB_Demo_Data::get_category_demo_data( $this->kb_config['kb_main_page_layout'], $this->kb_config );
			$category_seq_data = $demo_data['category_seq'];
			$articles_seq_data = $demo_data['article_seq'];
			$checked = 'checked';
		}

		// find KB Main Page that is not in trash
		$first_post_id = '';
		$kb_main_pages_info = EPKB_KB_Handler::get_kb_main_pages( $this->kb_config );
		foreach( $kb_main_pages_info as $post_id => $post_info ) {
			if ( $post_info['post_status'] != 'Trash' ) {
				$first_post_id = $post_id;
				break;
			}
		}

		$link_output = '';
		if ( ! empty($first_post_id) ) {
			$link = get_permalink( $first_post_id ) . '" target="_blank';
			$link_output = '<a href="' . $link . '"><div class="epkb-view ep_icon_external_link"></div></a>';
		}

		$main_page_output =
			'<div class="epkb-preview-info">' .
                '<div class="epkb-layout">
                    <strong>' . $this->kb_main_page_layout . ' Layout Preview</strong>'
					. $link_output . '
                </div>' .
                '<div class="epkb-info ep_icon_info"></div>' .
				'<div class="epkb-data-switch">
                    <div class="switch-container">
	                    <label class="switch">
                            <input id="epkb-layout-preview-data" type="checkbox" name="layout-preview-data" ' . $checked . '>
                            <div class="slider round"></div>
                            <div class="kb-name">Demo KB</div>
                            <div class="kb-demo">Current KB</div>
	                    </label>
	                </div>
                </div>'.
                '<div class="epkb-preview-information">
                    <h5>Information</h5>
                    <div class="epkb-preview-content">
                     <p><strong>' . $this->kb_main_page_layout . ' Layout Preview</strong>: The preview box below shows only a simplified version of the actual page. The preview
                       can help you to visualize how changes to configuration will affect the page.</p>
                     <p><strong>Current / Demo KB</strong>: You can switch to the <strong>Demo KB</strong> to see how populated Knowledge Base looks with 
                       a specific configuration. The Demo data is never saved to your KB.</p>
                    </div>
                   
                </div>'.
            '</div>';
		$main_page_output .= EPKB_Layouts_Setup::output_kb_main_page( $this->kb_config, true, $articles_seq_data, $category_seq_data );

		// setup test icons
		if ( $this->kb_config['kb_main_page_layout'] == EPKB_KB_Config_Layouts::GRID_LAYOUT &&
		     ( isset($_REQUEST['epkb-demo']) || ( isset($_POST['epkb_demo_kb']) && $_POST['epkb_demo_kb'] == "true" ) ) ) {
			$count = 2;
			$main_page_output = preg_replace( '/ep_icon_document/', 'ep_icon_person', $main_page_output, $count );
			$main_page_output = preg_replace( '/ep_icon_document/', 'ep_icon_shopping_cart', $main_page_output, $count );
			$main_page_output = preg_replace( '/ep_icon_document/', 'ep_icon_money', $main_page_output, $count );
			$main_page_output = preg_replace( '/ep_icon_document/', 'ep_icon_tag', $main_page_output, $count );
			$main_page_output = preg_replace( '/ep_icon_document/', 'ep_icon_credit_card', $main_page_output, $count );
			$main_page_output = preg_replace( '/ep_icon_document/', 'ep_icon_building', $main_page_output, $count );
		}
		
		if ( $display ) {
			echo $main_page_output;
		}

		return $main_page_output;
	}

	/**
	 * Show Article Page preview
	 *
	 * @param bool $display
	 * @return mixed|string
	 */
	public function display_article_page_layout_preview( $display=true ) {

		$category_seq_data = array();
		$articles_seq_data = array();
		$is_demo = isset($_POST['epkb_demo_kb']) && $_POST['epkb_demo_kb'] == "true";
		// setup either current KB or demo KB data
		if ( $is_demo ) {
			EPKB_Layouts_Setup::$demo_mode = true;
			$demo_data = EPKB_KB_Demo_Data::get_category_demo_data( $this->kb_config['kb_article_page_layout'], $this->kb_config );
			$category_seq_data = $demo_data['category_seq'];
			$articles_seq_data = $demo_data['article_seq'];
		}

		$article_page_output =
			'<div class="epkb-preview-info">' .
			'<div class="epkb-layout">' . $this->kb_article_page_layout . ' Layout </div>' .
			'<div class="epkb-info ep_icon_info"></div>' .
			'<div class="epkb-preview-information">
                    <h5>Information</h5>
                    <p>This preview box below is not an exact representation of the front end but a guide for your settings.</p>
                </div>'.
			'</div>';

			$temp_config = $this->kb_config;
			$temp_config['kb_main_page_layout'] = 'Sidebar';
			$temp_config['empty_article_content'] = EPKB_KB_Demo_Data::get_demo_article();

			$article_page_output .= EPKB_Layouts_Setup::output_article_page( $temp_config, true, $articles_seq_data, $category_seq_data );

		if ( $display ) {
			echo $article_page_output;
		}

		return $article_page_output;
	}


	/**************************************************************************************
	 *
	 *                   SIDEBARS: KB MAIN PAGE
	 *
	 *************************************************************************************/

	private function display_kb_main_page_sections() {

		$this->sidebar_menu_item( array(
			'menu-name'     => 'Layout',
			'header-name'   => 'Main Page',
			'id'            => 'epkb-config-layout',
			'content'       => $this->get_main_page_layout_sidebar_form(),
			'hidden'        => ''
        ));
		$this->sidebar_menu_item( array(
			'menu-name'     => 'Order',
			'header-name'   => 'Main Page',
			'id'            => 'epkb-config-ordering',
			'content'       => $this->get_order_sidebar_form(),
			'hidden'        => ''
		));
		$this->sidebar_menu_item( array(
			'menu-name'     => 'Styles',
			'header-name'   => 'Main Page',
			'id'        => 'epkb-config-styles',
			'content'   => $this->get_styles_sidebar_form(),
			'hidden'    => ''
		));
		$this->sidebar_menu_item( array(
			'menu-name'     => 'Colors',
			'header-name'   => 'Main Page',
			'id'        => 'epkb-config-colors',
			'content'   => $this->get_colors_sidebar_form(),
			'hidden'    => ''
		));
		$this->sidebar_menu_item( array(
			'menu-name'     => 'Text',
			'header-name'   => 'Main Page',
			'id'        => 'epkb-config-text',
			'content'   => $this->get_text_sidebar_form(),
			'hidden'    => ''
		));
	}

	/**
	 * Generate form fields for the side bar
	 */
	private function get_main_page_layout_sidebar_form() {
		ob_start();	    ?>

		<div class="epkb-config-sidebar" id="epkb-config-layout-sidebar">
			<div class="epkb-config-sidebar-options">
				<div class="epkb-config-sidebar-accordion">
					<div class="epkb-config-sidebar-accordion-header epkb-kb-active-accordion">
						<h4><span class="epkb-accordion-icon ep_icon_down_arrow"></span> <?php esc_html_e( 'Information', 'echo-knowledge-base' ); ?></h4>
					</div>
					<div class="epkb-config-sidebar-accordion-body">
						<ul>
							<li><strong>Basic Layout</strong> – displays categories in rows and columns.</li>
							<li><strong>Tabs Layout</strong> – same as the Basic Layout with additional top-level categories listed in tabs at the top of the page. Each tab lists related sub-categories.</li>    <?php
							echo apply_filters( 'epkb_layout_info_message', '' );    ?>
						</ul>

						<p>All combinations of core and add-on layouts are listed in our
							<a href="https://www.echoknowledgebase.com/catalogue-knowledge-base-layouts/" target="_blank"><?php esc_html_e( 'Catalogue of Knowledge Base Layouts', 'echo-knowledge-base' ); ?>.</a>
						</p>
					</div>
				</div>
				<div class="epkb-config-sidebar-accordion">
					<div class="epkb-config-sidebar-accordion-header epkb-kb-active-accordion">
						<h4><span class="epkb-accordion-icon ep_icon_down_arrow"></span> <?php esc_html_e( 'Layout Setup', 'echo-knowledge-base' ); ?></h4>
					</div>
					<div class="epkb-config-sidebar-accordion-body" style="display: block">					<?php

						if ( ! in_array($this->kb_config['kb_main_page_layout'], EPKB_KB_Config_Layouts::get_main_page_layout_names()) ) {
							$this->kb_config['kb_main_page_layout'] = EPKB_KB_Config_Layout_Basic::LAYOUT_NAME;
						}
						
						$this->form->option_group( $this->feature_specs, array(
							'option-heading'    => 'KB Main Page Layout',
							'info'              => '<p>Choose the main page layout this will change some functionality like how many categories are displayed and if articles are displayed.</p>',
							'inputs'            => array(
								'0' => $this->form->radio_buttons_vertical( $this->feature_specs['kb_main_page_layout'] + array(
										'id'                => 'epkb_kb_main_page_layout',
										'current'           => $this->kb_config['kb_main_page_layout'],
										'input_group_class' => 'config-col-12',
										'main_label_class'  => 'config-col-4',
										'input_class'       => 'config-col-6',
										'radio_class'       => 'config-col-12' ) )
							)
						));			?>

					</div>
				</div>
				<div class="epkb-config-sidebar-accordion">
					<div class="epkb-config-sidebar-accordion-header epkb-kb-active-accordion">
						<h4><span class="epkb-accordion-icon ep_icon_down_arrow"></span><?php esc_html_e( 'Advanced Configuration', 'echo-knowledge-base' ); ?></h4>
					</div>
					<div class="epkb-config-sidebar-accordion-body">

						<!-- ARTICLE COMMON PATH ( URL ) -->
						<div class="config-option-group  kb_articles_common_path_group" id="kb_articles_common_path_group">			   <?php
							$common_path = isset($this->kb_config['kb_articles_common_path']) ? $this->kb_config['kb_articles_common_path'] : '';  // TODO remove isset() after 1.0.1.
							$this->display_articles_common_path( $this->kb_config['kb_main_page_layout'], $common_path );     ?>
						</div>

					</div>
				</div>
			</div>
		</div>      <?php

		return ob_get_clean();
	}

	/**
	 * Generate form fields for the side bar
	 */
	public function get_order_sidebar_form() {
		ob_start();	    ?>

		<div class="epkb-config-sidebar" id="epkb-config-ordering-sidebar">
			<div class="epkb-config-sidebar-options">
				<div class="epkb-config-sidebar-accordion">
					<div class="epkb-config-sidebar-accordion-header epkb-kb-active-accordion">
						<h4><span class="epkb-accordion-icon ep_icon_down_arrow"></span><?php esc_html_e( 'Sequence', 'echo-knowledge-base' ); ?></h4>
					</div>
					<div class="epkb-config-sidebar-accordion-body"  style="display: block">					<?php

						$sequence_widets = array(
							'0' => $this->form->radio_buttons_vertical(
								$this->feature_specs['categories_display_sequence'] +
								array(
									'id'        => 'front-end-columns',
									'value'     => $this->kb_config['categories_display_sequence'],
									'current'   => $this->kb_config['categories_display_sequence'],
									'input_group_class' => 'config-col-12',
									'main_label_class'  => 'config-col-12',
									'input_class'       => 'config-col-12',
									'radio_class'       => 'config-col-12'
								)
							)
						);

						// Grid Layout does not show articles
						if ( $this->kb_main_page_layout != 'Grid' ) {
							$sequence_widets[1] = $this->form->radio_buttons_vertical(
								$this->feature_specs['articles_display_sequence'] +
								array(
									'id'        => 'front-end-columns',
									'value'     => $this->kb_config['articles_display_sequence'],
									'current'   => $this->kb_config['articles_display_sequence'],
									'input_group_class' => 'config-col-12',
									'main_label_class'  => 'config-col-12',
									'input_class'       => 'config-col-12',
									'radio_class'       => 'config-col-12'
								)
							);
						}

						$this->form->option_group( $this->feature_specs, array(
							'option-heading' => 'Sequence Order',
							'info' => array( 'categories_display_sequence', 'articles_display_sequence' ),
							'inputs' => $sequence_widets
						));					?>

					</div>
				</div>
			</div>
		</div>      <?php

		return ob_get_clean();
	}

	/**
	 * Generate form fields for the side bar
	 */
	public function get_styles_sidebar_form() {
		ob_start();	    ?>

		<div class="epkb-config-sidebar" id="epkb-config-styles-sidebar">
			<div class="epkb-config-sidebar-options" id="epkb_style_sidebar_options">

				<div class="epkb-config-sidebar-accordion" id="epkb_style_reset_accordion">
					<div class="epkb-config-sidebar-accordion-header epkb-kb-active-accordion">
					<h4><span class="epkb-accordion-icon ep_icon_down_arrow"></span><?php esc_html_e( 'Set Style to', 'echo-knowledge-base' ); ?></h4>
					</div>
						<div class="epkb-config-sidebar-accordion-body"  style="display: block;" id="epkb_reset_style_widget">					<?php

							//	'info' => 'Control certain look of the knowledge base, such as borders and font sizes.',
							echo $this->form->radio_buttons_vertical( array(
									'id' => 'main_page_reset_style',
									'name' => 'main_page_reset_style',
									'label' => 'Reset To',
									'options' => EPKB_KB_Config_Layouts::get_main_page_style_names( $this->kb_config ),
									'input_group_class' => 'config-col-12',
									'main_label_class'  => 'config-col-3',
									'input_class'       => 'config-col-9 radio_buttons_resets',
									'radio_class'       => 'config-col-6'
								));					?>

					</div>
				</div>				<?php

				apply_filters( 'epkb_kb_main_page_style_settings', $this->kb_main_page_layout, $this->kb_config ); ?>

			</div>
		</div>      <?php

		return ob_get_clean();
	}

	/**
	 * Generate form fields for the side bar
	 */
	public function get_colors_sidebar_form() {
		ob_start();	    ?>

		<div class="epkb-config-sidebar" id="epkb-config-colors-sidebar">
			<div class="epkb-config-sidebar-options">

				<div class="epkb-config-sidebar-accordion">
					<div class="epkb-config-sidebar-accordion-header epkb-kb-active-accordion">
						<h4><span class="epkb-accordion-icon ep_icon_down_arrow"></span><?php esc_html_e( 'Reset Color Theme', 'echo-knowledge-base' ); ?></h4>
					</div>
					<div class="epkb-config-sidebar-accordion-body"  style="display: block">
	                    <div class="reset_colors" id="main_page_reset_colors">
	                        <ul>
	                            <li class="config-col-12">Black / White</li>
	                            <li class="config-col-3">
	                                <div class="color_palette black-white">
	                                    <span></span>
	                                    <span></span>
	                                    <span></span>
	                                </div>
	                            </li>
		                        <li class="config-col-9">
                                    <ul class="epkb_rest_buttons">
                                        <li><button type="button" value="black-white1">1</button></li>
                                        <li><button type="button" value="black-white2">2</button></li>
                                        <li><button type="button" value="black-white3">3</button></li>
                                        <li><button type="button" value="black-white4">4</button></li>
                                    </ul>
                                </li>
	                        </ul>
	                        <ul>
	                            <li class="config-col-12">Red</li>
	                            <li class="config-col-3">
	                                <div class="color_palette red">
	                                    <span></span>
	                                    <span></span>
	                                    <span></span>
	                                </div>
	                            </li>
		                        <li class="config-col-9">
	                                <ul class="epkb_rest_buttons">
	                                    <li><button type="button" value="red1">1</button></li>
	                                    <li><button type="button" value="red2">2</button></li>
	                                    <li><button type="button" value="red3">3</button></li>
	                                    <li><button type="button" value="red4">4</button></li>
	                                </ul>
	                            </li>
	                        </ul>
	                        <ul>
	                            <li class="config-col-12">Blue</li>
	                            <li class="config-col-3">
	                                <div class="color_palette blue">
	                                    <span></span>
	                                    <span></span>
	                                    <span></span>
	                                </div>
	                            </li>
		                        <li class="config-col-9">
	                                <ul class="epkb_rest_buttons">
	                                    <li><button type="button" value="blue1"> 1 </button></li>
	                                    <li><button type="button" value="blue2"> 2 </button></li>
	                                    <li><button type="button" value="blue3"> 3 </button></li>
	                                    <li><button type="button" value="blue4"> 4 </button></li>
	                                </ul>
	                            </li>
	                        </ul>
	                        <ul>
	                            <li class="config-col-12">Green</li>
	                            <li class="config-col-3">
	                                <div class="color_palette green">
	                                    <span></span>
	                                    <span></span>
	                                    <span></span>
	                                </div>
	                            </li>
		                        <li class="config-col-9">
	                                <ul class="epkb_rest_buttons">
	                                    <li><button type="button" value="green1">1</button></li>
	                                    <li><button type="button" value="green2">2</button></li>
	                                    <li><button type="button" value="green3">3</button></li>
	                                    <li><button type="button" value="green4">4</button></li>
	                                </ul>
	                            </li>
	                        </ul>

	                    </div>

					</div>
				</div>

				<?php apply_filters( 'epkb_kb_main_page_colors_settings', $this->kb_main_page_layout, $this->kb_config ); ?>

			</div>
		</div>			         <?php

		return ob_get_clean();
	}

	/**
	 * Generate form fields for the side bar
	 */
	public function get_text_sidebar_form() {
		ob_start();	    ?>

		<div class="epkb-config-sidebar" id="epkb-config-text-sidebar">
			<div class="epkb-config-sidebar-options">
				<?php apply_filters( 'epkb_kb_main_page_text_settings', $this->kb_main_page_layout, $this->kb_config ); ?>
			</div>
		</div>			     <?php

		return ob_get_clean();
	}


	/**************************************************************************************
	 *
	 *                   SIDEBARS: ARTICLE PAGE
	 *
	 *************************************************************************************/

	private function display_article_page_sections() {

		$layoutName = $this->kb_config['kb_main_page_layout'];
		$hidden = '';
		if ( $this->kb_article_page_layout == EPKB_KB_Config_Layouts::KB_ARTICLE_PAGE_NO_LAYOUT ) {
			$hidden = 'style="display: none;"';
		}

		$this->sidebar_menu_item( array(
			'menu-name'     => 'Layout',
			'header-name'   => 'Article Page',
			'id'        => 'epkb-config-article-layout',
			'content'   => $this->get_article_page_layout_sidebar_form(),
			'hidden'    => ''
		));
		$this->sidebar_menu_item( array(
			'menu-name'     => 'Styles',
			'header-name'   => 'Article Page',
			'id'        => 'epkb-config-article-styles',
			'content'   => $this->get_article_styles_sidebar_form(),
			'hidden'    => $hidden
		));
		$this->sidebar_menu_item( array(
			'menu-name'     => 'Colors',
			'header-name'   => 'Article Page',
			'id'        => 'epkb-config-article-colors',
			'content'   => $this->get_article_colors_sidebar_form(),
			'hidden'    => $hidden
		));
		$this->sidebar_menu_item( array(
			'menu-name'     => 'Text',
			'header-name'   => 'Article Page',
			'id'        => 'epkb-config-article-text',
			'content'   => $this->get_article_text_sidebar_form(),
			'hidden'    => $hidden
		));
	}

	public function get_article_page_layout_sidebar_form() {
		ob_start();	    ?>

		<div class="epkb-config-sidebar" id="epkb-config-article-layout-sidebar">
			<div class="epkb-config-sidebar-options">
				<!-- <div class="epkb-config-sidebar-accordion">
					<div class="epkb-config-sidebar-accordion-header epkb-kb-active-accordion">
						<h4><span class="epkb-accordion-icon ep_icon_down_arrow"></span> <?php esc_html_e( 'Information', 'echo-knowledge-base' ); ?></h4>
					</div>
					<div class="epkb-config-sidebar-accordion-body">
						<p>This is the decription and explanation of this section.</p>
					</div>
				</div> -->
				<div class="epkb-config-sidebar-accordion">
					<div class="epkb-config-sidebar-accordion-header epkb-kb-active-accordion">
						<h4><span class="epkb-accordion-icon ep_icon_down_arrow"></span> <?php esc_html_e( 'Layout Setup', 'echo-knowledge-base' ); ?></h4>
					</div>
					<div class="epkb-config-sidebar-accordion-body" style="display: block">         <?php

						$article_page_layouts = EPKB_KB_Config_Layouts::get_article_page_layouts( $this->kb_main_page_layout );
						if ( ! in_array($this->kb_config['kb_article_page_layout'], $article_page_layouts) ) {
							$this->kb_config['kb_article_page_layout'] = EPKB_KB_Config_Layouts::KB_ARTICLE_PAGE_NO_LAYOUT;
						}

						$this->form->option_group( $this->feature_specs, array(
							'info' => array('kb_article_page_layout'),
							'inputs' => array(
								'0' => $this->form->radio_buttons_vertical( array('options' => $article_page_layouts) + $this->feature_specs['kb_article_page_layout'] + array(
										'id'                => 'epkb_kb_article_page_layout',
										'current'           => $this->kb_config['kb_article_page_layout'],
										'input_group_class' => 'config-col-12',
										'label_class'       => 'config-col-12',
										'input_class'       => 'config-col-12',
										'radio_class'       => 'config-col-12' ) )
							)
						));					?>

					</div>
				</div>
			</div>
		</div>				<?php

		return ob_get_clean();
	}

	/**
	 * Generate form fields for the ARTICLE PAGE side bar
	 */
	public function get_article_styles_sidebar_form() {
		ob_start();		?>

		<div class="epkb-config-sidebar" id="epkb-config-article-styles-sidebar">
			<div class="epkb-config-sidebar-options" id="epkb_article_style_sidebar_options">
				<div class="epkb-config-sidebar-accordion" id="epkb_article_style_reset_accordion">
					<div class="epkb-config-sidebar-accordion-header epkb-kb-active-accordion">
					<h4><span class="epkb-accordion-icon ep_icon_down_arrow"></span><?php esc_html_e( 'Set Style to', 'echo-knowledge-base' ); ?></h4>
					</div>
						<div class="epkb-config-sidebar-accordion-body"  style="display: block;" id="epkb_reset_style_widget">					<?php

						$this->form->option_group( $this->feature_specs, array(
								'option-heading' => 'Set Style to',
								'info' => 'Control certain look of the knowledge base, such as borders and font sizes.',
								'inputs' => array(
								'0' => $this->form->radio_buttons_vertical( array(
									'id' => 'article_page_reset_style',
									'name' => 'article_page_reset_style',
									'label' => 'Reset To',
									'options' => EPKB_KB_Config_Layouts::get_article_page_style_names( $this->kb_config ),
									'input_group_class' => 'config-col-12',
									'main_label_class'  => 'config-col-3',
									'input_class'       => 'config-col-9 radio_buttons_resets',
									'radio_class'       => 'config-col-6'
									) )
							)
						));					?>

					</div>
				</div>
			</div>			<?php
			apply_filters( 'epkb_article_page_style_settings', $this->kb_article_page_layout, $this->kb_config );  ?>
		</div>      <?php

		return ob_get_clean();
	}

	/**
	 * Generate form fields for the ARTICLE PAGE side bar
	 */
	public function get_article_colors_sidebar_form() {
		ob_start();		?>

		<div class="epkb-config-sidebar" id="epkb-config-article-colors-sidebar">
			<div class="epkb-config-sidebar-options">

				<div class="epkb-config-sidebar-accordion">
					<div class="epkb-config-sidebar-accordion-header epkb-kb-active-accordion">
						<h4><span class="epkb-accordion-icon ep_icon_down_arrow"></span><?php esc_html_e( 'Reset Color Theme', 'echo-knowledge-base' ); ?></h4>
					</div>
					<div class="epkb-config-sidebar-accordion-body"  style="display: block">
						<div class="reset_colors" id="article_page_reset_colors">
                            <ul>
                                <li class="config-col-12">Black / White</li>
                                <li class="config-col-3">
                                    <div class="color_palette black-white">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </li>
                                <li class="config-col-9">
                                    <ul class="epkb_rest_buttons">
                                        <li><button type="button" value="black-white1">1</button></li>
                                        <li><button type="button" value="black-white2">2</button></li>
                                        <li><button type="button" value="black-white3">3</button></li>
                                        <li><button type="button" value="black-white4">4</button></li>
                                    </ul>

                                </li>
                            </ul>
                            <ul>
                                <li class="config-col-12">Red</li>
                                <li class="config-col-3">
                                    <div class="color_palette red">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </li>
                                <li class="config-col-9">
                                    <ul class="epkb_rest_buttons">
                                        <li><button type="button" value="red1">1</button></li>
                                        <li><button type="button" value="red2">2</button></li>
                                        <li><button type="button" value="red3">3</button></li>
                                        <li><button type="button" value="red4">4</button></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul>
                                <li class="config-col-12">Blue</li>
                                <li class="config-col-3">
                                    <div class="color_palette blue">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </li>
                                <li class="config-col-9">
                                    <ul class="epkb_rest_buttons">
                                        <li><button type="button" value="blue1"> 1 </button></li>
                                        <li><button type="button" value="blue2"> 2 </button></li>
                                        <li><button type="button" value="blue3"> 3 </button></li>
                                        <li><button type="button" value="blue4"> 4 </button></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul>
                                <li class="config-col-12">Green</li>
                                <li class="config-col-3">
                                    <div class="color_palette green">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </li>
                                <li class="config-col-9">
                                    <ul class="epkb_rest_buttons">
                                        <li><button type="button" value="green1">1</button></li>
                                        <li><button type="button" value="green2">2</button></li>
                                        <li><button type="button" value="green3">3</button></li>
                                        <li><button type="button" value="green4">4</button></li>
                                    </ul>
                                </li>
                            </ul>

						</div>

					</div>
				</div>

				<?php apply_filters( 'epkb_article_page_colors_settings', $this->kb_article_page_layout, $this->kb_config ); ?>

			</div>
		</div>      <?php

		return ob_get_clean();
	}

	/**
	 * Generate form fields for the ARTICLE PAGE side bar
	 */
	public function get_article_text_sidebar_form() {

		ob_start();     ?>

		<div class="epkb-config-sidebar" id="epkb-config-article-text-sidebar">    <?php

		if ( $this->kb_article_page_layout != EPKB_KB_Config_Layouts::KB_ARTICLE_PAGE_NO_LAYOUT ) {       ?>
			<div class="epkb-config-sidebar-options">   <?php
				// for now always generate Text for Sidebar; once we have more article layouts pass in the actual article layout (an update config controller for Ajax)
				apply_filters( 'epkb_article_page_text_settings', EPKB_KB_Config_Layouts::SIDEBAR_LAYOUT, $this->kb_config ); ?>
			</div>   <?php
		}    ?>

		</div>      <?php

		return ob_get_clean();
	}


	/**************************************************************************************
	 *
	 *                   OTHERS / SUPPORT FUNCTIONS
	 *
	 *************************************************************************************/

	private function display_list_of_kbs() {

		// TODO active from other tabs and the other way around

		if ( ! defined('EM' . 'KB_PLUGIN_NAME') ) {
			$kb_name = isset($this->kb_config[ 'name' ]) ? $this->kb_config[ 'name' ] : $this->kb_config[ 'kb_name' ];  // TODO remove isset()
			echo '<h1 class="epkb-kb-name">' . esc_html( $kb_name ) . '</h1>';
			return;
		}

		// output the list
		$list_output = '<select class="epkb-kb-name" id="epkb-list-of-kbs">';
		$all_kb_configs = epkb_get_instance()->kb_config_ojb->get_kb_configs();
		foreach ( $all_kb_configs as $one_kb_config ) {

			if ( $one_kb_config['status'] == EPKB_KB_Status::ARCHIVED ) {
				continue;
			}

			$kb_name = isset($one_kb_config[ 'name' ]) ? $one_kb_config[ 'name' ] : $one_kb_config[ 'kb_name' ];  // TODO remove isset()
			$active = ( $this->kb_config['id'] == $one_kb_config['id'] ? 'selected' : '' );
			$tab_url = 'edit.php?post_type=epkb_post_type_' . $one_kb_config['id'] . '&page=epkb-kb-configuration';

			$list_output .= '<option value="' . $one_kb_config['id'] . '" ' . $active . ' data-kb-admin-url=' . esc_url($tab_url) . '>' . esc_html( $kb_name ) . '</option>';
			$list_output .= '</a>';
		}


		$list_output .= '</select>';

		echo $list_output;
	}

	/**
	 * Show list of commmon paths for articles
	 *
	 * @param $kb_main_page_layout
	 * @param $common_path
	 * @return string
	 */
	public function display_articles_common_path( $kb_main_page_layout, $common_path ) {
		$this->form->option_group( $this->feature_specs, array(
			'option-heading'    => 'Article Path ( URL )',
			'info'              => '<p>This is recommended for advanced users, support will be at a minimum for more information about
			                                       this feature read more information <a href="https://codex.wordpress.org/Glossary#Slug" target="_blank">here
													on wordpress.org</a></p>',
			'inputs'            => array(
				'0'         => $this->common_path_kb_main_page_slug( $kb_main_page_layout, $common_path ),
				'1'         => $this->common_path_custom_slug( $kb_main_page_layout, $common_path )
			)
		));
	}

	/**
	 * Show list of commmon paths for articles
	 *
	 * @param $kb_main_page_layout
	 * @param $common_path
	 * @return string
	 */
	public function common_path_kb_main_page_slug( $kb_main_page_layout, $common_path ) {

		$is_layout_with_article = EPKB_KB_Config_Layouts::is_main_page_displaying_sidebar( $kb_main_page_layout );

		ob_start();	    ?>

		<div class="option-heading config-col-12">
			<p> KB Article URL: &nbsp;&nbsp;&nbsp;website address / common path / KB article slug</p>
		</div>

		<h4 class="main_label config-col-12">Common path set to KB Main Page slug:</h4>
		<div class="radio-buttons-vertical config-col-12" id="">
			<ul>  				<?php

				// find if one of the KB Main Pages is selected; if not and we don't have custom path, select first one
				$selected_post_id = 0;
				$first_post_id = 0;
				$kb_main_pages_info = EPKB_KB_Handler::get_kb_main_pages( $this->kb_config );
				foreach ( $kb_main_pages_info as $post_id => $post_info ) {
					$first_post_id = empty($first_post_id) ? $post_id : $first_post_id;
					if ( $post_info['post_slug'] == $common_path ) {
						$selected_post_id = $post_id;
					}
				}

				if ( $is_layout_with_article & empty($selected_post_id) ) {
					$selected_post_id = $first_post_id;
				}

				$ix = 0;
				foreach( $kb_main_pages_info as $post_id => $post_info ) {

					$kb_home_slug = $post_info['post_slug'];

					$checked1 = $post_id == $selected_post_id ? 'checked="checked" ' : '';
					$label = site_url() . '/<strong><a href="' . get_edit_post_link( $post_id ) . '" target="_blank">' . esc_attr($kb_home_slug) . "</a></strong>/" .
					         '<span style="font-style:italic;">KB-article-slug</span>';    			?>

					<li class="config-col-12">
						<div class="input_container config-col-1">
							<input type="radio" name="kb_articles_common_path_rbtn"
							       id="<?php echo 'path_'.$ix; ?>"
							       value="<?php echo esc_attr($kb_home_slug); ?>"
								<?php echo $checked1; ?>  />
						</div>
						<label class="config-col-10" for="<?php echo 'path_'.$ix ?>">
							<?php echo $label ?>
						</label>
					</li>  		<?php

					$ix++;
				}

				if ( $ix == 0 ) {   ?>
					<li class="config-col-12">No KB Main Page found.</li>      <?php
				}     ?>

			</ul>
		</div>		<?php

		return ob_get_clean();
	}

	/**
	 * Show custom path for articles common path
	 *
	 * @param $kb_main_page_layout
	 * @param $common_path
	 * @return string
	 */
	private function common_path_custom_slug( $kb_main_page_layout, $common_path ) {

		// if either Main Page or Article Page has Sidebar layout then don't enable custom common path
		$is_layout_with_article = EPKB_KB_Config_Layouts::is_main_page_displaying_sidebar( $kb_main_page_layout )
									|| EPKB_KB_Config_Layouts::is_article_page_displaying_sidebar( $this->kb_config['kb_article_page_layout'] );

		ob_start();		?>

		<div class="config-option-group kb_custom_slug kb_articles_common_path_group" id="kb_articles_common_path_group">
			<h4 class="main_label config-col-12">Common path set to custom slug:</h4>
			<div class="radio-buttons-vertical config-col-12" id="">
				<ul>   			<?php
					$ix = 0;

					if ( $is_layout_with_article ) {   ?>
						<li class="config-col-12">You cannot choose custom path if Sidebar Layout is selected as either Main or Article Page Layout .</li>     <?php
					} else {
						$shared_path_input = empty($selected_post_id) ? $common_path : '';
						$checked2 = empty($selected_post_id) ? 'checked="checked" ' : '';
						$label = site_url() . '/' . ' <input type="text" name="kb_articles_common_path" id="kb_articles_common_path" autocomplete="off"
																	       value="' . esc_attr( $shared_path_input ) . '" placeholder="Enter slug here" maxlength="50"
																	        style="width: 250px;">/<span style="font-style:italic;">KB-article-slug</span>'; ?>

						<li class="config-col-12">
							<div class="input_container config-col-1">
								<input type="radio" name="kb_articles_common_path_rbtn"
								       id="<?php echo 'path_' . $ix; ?>"
								       value="path_custom_slug"
									<?php echo $checked2; ?> />
							</div>
							<label class="config-col-10" for="<?php echo 'path_' . $ix ?>">
								<?php echo $label ?>
							</label>
						</li>    <?php

					}   ?>

				</ul>
			</div>
		</div>		<?php

		return ob_get_clean();
	}

	private function display_upgrade_message() {

		// determine if to show upgrade message
		$last_plugin_version = get_option( 'epkb_version' );
		$show_upgrade_msg = get_option( 'epkb_show_upgrade_message' );

		// nothing changed
		if ( version_compare( Echo_Knowledge_Base::$version, $last_plugin_version, '=' ) ) {
			return ! empty($show_upgrade_msg);
		}

		update_option( 'epkb_version', Echo_Knowledge_Base::$version );

		// handle atypical state
		if ( empty($last_plugin_version) || version_compare( Echo_Knowledge_Base::$version, $last_plugin_version, '<' ) ) {
			update_option( 'epkb_show_upgrade_message', false );
			return false;
		}

		// only after version increased show upgrade message
		update_option('epkb_show_upgrade_message', true);

		return true;
	}

	/**
	 * Show SECOND LEVEL sidebar item
	 *
	 * @param array()
	 */
	function sidebar_menu_item( $args = array() ) {

		$defaults = array(
            'menu-name'     => '',
            'header-name'   => '',
            'id'            => '',
            'content'       => '',
            'hidden'        => ''
        );
		$args = wp_parse_args( $args, $defaults );
	    ?>
		<li class="epkb-menu-container">

			<div class="epkb-menu-item" <?php echo 'id="' . $args['id'] . '" ' . $args['hidden']; ?>>
				<div class="ep_icon_arrow_carrot_left epkb-menu-icon"></div>
				<div class="epkb-menu-name"><?php echo $args['menu-name']; ?></div>
			</div>

			<div class="epkb-menu-content">

				<div class="epkb-menu-header">
					<div class="epkb-header-name">
                        <h2><?php echo $args['menu-name']; ?></h2>
                        <div class="icon_cog epkb-header-icon"></div>
					</div>
				</div>

				<div class="epkb-menu-back"><div class="ep_icon_arrow_carrot_left epkb-menu-icon"></div>back</div>
				<div class="epkb-menu-body">
					<?php echo $args['content']; ?>
				</div>

			</div>

		</li>	<?php
	}
}
