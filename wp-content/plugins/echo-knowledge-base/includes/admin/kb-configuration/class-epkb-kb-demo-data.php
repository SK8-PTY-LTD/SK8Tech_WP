<?php  if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Holds demo data for KB
 *
 * @copyright   Copyright (C) 2017, Echo Plugins
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class EPKB_KB_Demo_Data {

	public static function get_category_demo_data( $layout, $kb_config ) {

		$articles_sequence_new_value = isset($kb_config['articles_display_sequence']) ? $kb_config['articles_display_sequence'] : '';
		$categories_sequence_new_value = isset($kb_config['categories_display_sequence']) ? $kb_config['categories_display_sequence'] : '';

		if ( $categories_sequence_new_value == 'alphabetical-title' ) {
			$category_seq = array(
				'11' => array(), //'111' => array('1111' => array())),
				'22' => array( '222' => array( '2222' => array() ) ),
				'33' => array(), //'333' => array('3333' => array())),
				'66' => array(),
				'55' => array(), //'555' => array('5555' => array())),
				'44' => array( '444' => array( '4444' => array() ) )
			);
		} else {
			$category_seq = array(
				'11' => array(), //'111' => array('1111' => array())),
				'22' => array( '222' => array( '2222' => array() ) ),
				'33' => array(), //'333' => array('3333' => array())),
				'44' => array( '444' => array( '4444' => array() ) ),
				'55' => array(), //'555' => array('5555' => array())),
				'66' => array()
			);
		}

		if ( $layout == EPKB_KB_Config_Layout_Tabs::LAYOUT_NAME ) {
			if ( $categories_sequence_new_value == 'alphabetical-title' ) {
				$category_seq['11'] += array( '112' => array() );
				$category_seq['11'] += array( '115' => array() );
				$category_seq['11'] += array( '113' => array() );
				$category_seq['11'] += array( '116' => array() );
				$category_seq['11'] += array( '114' => array() );
				$category_seq['11'] += array( '111' => array() );
			} else {
				$category_seq['11'] += array( '111' => array() );
				$category_seq['11'] += array( '112' => array() );
				$category_seq['11'] += array( '113' => array() );
				$category_seq['11'] += array( '114' => array() );
				$category_seq['11'] += array( '115' => array() );
				$category_seq['11'] += array( '116' => array() );
			}
		}
		
		$cat_11_descr = $layout == EPKB_KB_Config_Layouts::GRID_LAYOUT ? 'Where to find your account information' : '';
		$cat_22_descr = $layout == EPKB_KB_Config_Layouts::GRID_LAYOUT ? 'Details about placing and managing order' : '';
		$cat_33_descr = $layout == EPKB_KB_Config_Layouts::GRID_LAYOUT ? 'Includes information about payment methods, gift cards and fees' : '';
		$cat_44_descr = $layout == EPKB_KB_Config_Layouts::GRID_LAYOUT ? 'Shipping carriers  and shipping rates' : '';
		$cat_55_descr = $layout == EPKB_KB_Config_Layouts::GRID_LAYOUT ? 'Refund conditions and how to initiate refund' : '';
		$cat_66_descr = $layout == EPKB_KB_Config_Layouts::GRID_LAYOUT ? 'Learn about our promotions and special pricing' : '';

		if ( $articles_sequence_new_value == 'alphabetical-title' ) {
			$article_seq = array(
				'11' => array(0 => 'Account', 1 => $cat_11_descr, 2 => 'Create Account', 3 => 'Order History', 4 => 'Login issues'),
				'22' => array(0 => 'Ordering', 1 => $cat_22_descr, 2 => 'Editing an order', 3 => 'Placing an order', 4 => 'Pre/back-orders'),
				'222' => array(0 => 'Order processing', 1 => '', 2 => 'Canceling an order', 3 => 'Order verification', 4 => 'Un-canceling an order'),
				'2222' => array(0 => 'Order processing time', 1 => '', 2 => 'How will I know if you have received my order?', 3 => 'When is my order processed?', 4 => 'When will I receive my order?'),
				'33' => array(0 => 'Payment', 1 => $cat_33_descr, 2 => 'Gift Cards', 3 => 'Payment methods', 4 => 'Taxes and fees'),
				'44' => array(0 => 'Shipping', 1 => $cat_44_descr, 2 => 'Shipping issues', 3 => 'Shipping options', 4 => 'Tracking an order'),
				'444' => array(0 => 'Shipping options', 1 => '', 2 => 'Calculating the shipping cost', 3 => 'Free shipping', 4 => 'PO Boxes'),
				'4444' => array(0 => 'Shipping Rates', 1 => '', 2 => 'Australia', 3 => 'Canada', 4 => 'France', 5 => 'Germany', 6 => 'Spain', 7 => 'Russia', 8 => 'China', 9 => 'US'),
				'55' => array(0 => 'Returns & Refunds', 1 => $cat_55_descr, 2 => 'Creating a return', 3 => 'Return guidelines', 4 => 'Return shipping'),
				'66' => array(0 => 'Pricing/Promos', 1 => $cat_66_descr, 2 => 'Newsletter', 3 => 'Pricing guidelines', 4 => 'Promotions'),
			);
		} else {
			$article_seq = array(
				'11' => array(0 => 'Account', 1 => $cat_11_descr, 2 => 'Create Account', 3 => 'Login issues', 4 => 'Order History'),
				'22' => array(0 => 'Ordering', 1 => $cat_22_descr, 2 => 'Placing an order', 3 => 'Editing an order', 4 => 'Pre/back-orders'),
				'222' => array(0 => 'Order processing', 1 => '', 2 => 'Order verification', 3 => 'Canceling an order', 4 => 'Un-canceling an order'),
				'2222' => array(0 => 'Order processing time', 1 => '', 2 => 'When is my order processed?', 3 => 'How will I know if you have received my order?', 4 => 'When will I receive my order?'),
				'33' => array(0 => 'Payment', 1 => $cat_33_descr, 2 => 'Payment methods', 3 => 'Taxes and fees', 4 => 'Gift Cards'),
				'44' => array(0 => 'Shipping', 1 => $cat_44_descr, 2 => 'Shipping options', 3 => 'Tracking an order', 4 => 'Shipping issues'),
				'444' => array(0 => 'Shipping options', 1 => '', 2 => 'Calculating the shipping cost', 3 => 'Free shipping', 4 => 'PO Boxes'),
				'4444' => array(0 => 'Shipping Rates', 1 => '', 2 => 'US', 3 => 'Canada', 4 => 'Germany', 5 => 'France', 6 => 'Spain', 7 => 'Russia', 8 => 'Hong Kong', 9 => 'Australia'),
				'55' => array(0 => 'Returns & Refunds', 1 => $cat_55_descr, 2 => 'Creating a return', 3 => 'Return guidelines', 4 => 'Return shipping'),
				'66' => array(0 => 'Pricing/Promos', 1 => $cat_66_descr, 2 => 'Pricing guidelines', 3 => 'Promotions', 4 => 'Newsletter'),
			);
		}

		if ( $layout == EPKB_KB_Config_Layout_Tabs::LAYOUT_NAME ) {
			$article_seq['111'] = array( 0 => 'Login issues', 1 => '', 2 => 'Problems logging in', 3 => 'Too many login attempts' );
			$article_seq['112'] = array( 0 => 'Account settings', 1 => '', 2 => 'Changing your password', 3 => 'Recover Password' );
			$article_seq['113'] = array( 0 => 'History', 1 => '', 2 => 'Download account history', 3 => 'Your browsing history' );
			$article_seq['114'] = array( 0 => 'Premium Account', 1 => '', 2 => 'Different Types', 3 => 'How do I upgrade to a Premium account', 4 => 'How do I manage my Premium account' );
			$article_seq['115'] = array( 0 => 'Additional Services', 1 => '', 2 => 'What is Open Profile', 3 => 'What currencies are supported' );
			$article_seq['116'] = array( 0 => 'Other', 1 => '', 2 => 'Account Overview', 3 => 'Create Account' );
		}

		return array( 'category_seq' => $category_seq, 'article_seq' => $article_seq );
	}

	public static function get_demo_article() {
		return "
			<h1>Demo Article</h1>
			<strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.
			 Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi,
			  condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. 
			<h2>Header Level 2</h2>
			<ol>
	            <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
	            <li>Aliquam tincidunt mauris eu risus.</li>
			</ol>
			<blockquote>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend,
			 libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</blockquote>
			
			<h3>Header Level 3</h3>
			<ul>
	            <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
	            <li>Aliquam tincidunt mauris eu risus.</li>
			</ul>	
			";
	}
}
