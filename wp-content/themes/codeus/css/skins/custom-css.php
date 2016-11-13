<style type="text/css">

/* ELEMENTS */

body {
	<?php if(codeus_get_option('body_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('body_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('body_font_size')) : ?>
		font-size: <?php echo codeus_get_option('body_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('body_line_height')) : ?>
		line-height: <?php echo codeus_get_option('body_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('body_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('body_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('body_font_style') && strpos(codeus_get_option('body_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('basic_outer_background_color')) : ?>
		background-color: <?php echo codeus_get_option('basic_outer_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('basic_outer_background_image')) : ?>
		background-image: url("<?php echo codeus_get_option('basic_outer_background_image'); ?>");
	<?php endif; ?>
	<?php if(codeus_get_option('basic_outer_background_size')) : ?>
		background-size: cover;
		-webkit-background-size: cover;
		-o-background-size: cover;
		-moz-background-size: cover;
	<?php endif; ?>
}
a {
	<?php if(codeus_get_option('link_color')) : ?>
		color: <?php echo codeus_get_option('link_color'); ?>;
	<?php endif; ?>
}
a:hover {
	<?php if(codeus_get_option('hover_link_color')) : ?>
		color: <?php echo codeus_get_option('hover_link_color'); ?>;
	<?php endif; ?>
}
a:active {
	<?php if(codeus_get_option('active_link_color')) : ?>
		color: <?php echo codeus_get_option('active_link_color'); ?>;
	<?php endif; ?>
}
h1,
.woocommerce.single-product .product .price {
	<?php if(codeus_get_option('h1_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h1_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h1_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h1_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h1_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h1_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h1_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h1_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h1_font_style') && strpos(codeus_get_option('h1_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('h1_color')) : ?>
		color: <?php echo codeus_get_option('h1_color'); ?>;
	<?php endif; ?>
}
h2,
body.home-constructor h3.widget-title,
.shop_table.cart .cart_totals,
.shop_table.cart .cart_totals .order-total strong {
	<?php if(codeus_get_option('h2_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h2_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h2_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h2_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h2_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h2_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h2_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h2_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h2_font_style') && strpos(codeus_get_option('h2_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('h2_color')) : ?>
		color: <?php echo codeus_get_option('h2_color'); ?>;
	<?php endif; ?>
}
h3,
.shop_table.cart td.product-subtotal,
.woocommerce table.shop_table.order-details tr.cart_item td.product-total,
.woocommerce table.shop_table.order-details tr.order_item td.product-total,
ul.products .price,
.related-products.block.portfolio ul.thumbs li .price {
	<?php if(codeus_get_option('h3_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h3_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h3_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h3_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h3_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h3_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h3_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h3_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h3_font_style') && strpos(codeus_get_option('h3_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('h3_color')) : ?>
		color: <?php echo codeus_get_option('h3_color'); ?>;
	<?php endif; ?>
}
h4,
table thead th,
.widget_shopping_cart .mini-cart-bottom .total .amount,
ul.product_list_widget li .price {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h4_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h4_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h4_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style') && strpos(codeus_get_option('h4_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_color')) : ?>
		color: <?php echo codeus_get_option('h4_color'); ?>;
	<?php endif; ?>
}
.quantity.buttons_added input[type="button"] {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php endif; ?>
}
h5,
.product-left-block .stock,
h3.comment-reply-title {
	<?php if(codeus_get_option('h5_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h5_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h5_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h5_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h5_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h5_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h5_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h5_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h5_font_style') && strpos(codeus_get_option('h5_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('h5_color')) : ?>
		color: <?php echo codeus_get_option('h5_color'); ?>;
	<?php endif; ?>
}
ul.product_list_widget li .price {
	<?php if(codeus_get_option('h5_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h5_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h5_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h5_line_height'); ?>px;
	<?php endif; ?>
}
h6 {
	<?php if(codeus_get_option('h6_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h6_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h6_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h6_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h6_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h6_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h6_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h6_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h6_font_style') && strpos(codeus_get_option('h6_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('h6_color')) : ?>
		color: <?php echo codeus_get_option('h6_color'); ?>;
	<?php endif; ?>
}
.page-links-title {
	<?php if(codeus_get_option('h6_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h6_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h6_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h6_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h6_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h6_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h6_font_style') && strpos(codeus_get_option('h6_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('h6_color')) : ?>
		color: <?php echo codeus_get_option('h6_color'); ?>;
	<?php endif; ?>
}
.bar-title {
	<?php if(codeus_get_option('portfolio_clients_bar_title_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_clients_bar_title_color'); ?>;
	<?php endif; ?>
}
#footer #contacts .bar-title,
#footer #contacts a {
	<?php if(codeus_get_option('contact_bar_title_color')) : ?>
		color: <?php echo codeus_get_option('contact_bar_title_color'); ?>;
	<?php endif; ?>
}
input[type="submit"],
button,
a.button,
.widget input[type="submit"],
.widget button,
.widget a.button {
	<?php if(codeus_get_option('button_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('button_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('button_font_size')) : ?>
		font-size: <?php echo codeus_get_option('button_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('button_line_height')) : ?>
		line-height: <?php echo codeus_get_option('button_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('button_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('button_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('button_font_style') && strpos(codeus_get_option('button_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('button_background_basic_color')) : ?>
		background-color: <?php echo codeus_get_option('button_background_basic_color'); ?>;
	<?php endif; ?>
}
input[type="submit"]:before,
button:before,
a.button:before,
.widget input[type="submit"]:before,
.widget button:before,
.widget a.button:before {
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
		border-color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
}
input[type="submit"]:hover,
button:hover,
a.button:hover,
.widget input[type="submit"]:hover,
.widget button:hover,
.widget a.button:hover {
	<?php if(codeus_get_option('button_text_hover_color')) : ?>
		color: <?php echo codeus_get_option('button_text_hover_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('button_background_hover_color')) : ?>
		background-color: <?php echo codeus_get_option('button_background_hover_color'); ?>;
	<?php endif; ?>
}
input[type="submit"]:hover:before,
input[type="submit"]:hover:before,
input[type="submit"]:hover:before {
	<?php if(codeus_get_option('button_text_hover_color')) : ?>
		color: <?php echo codeus_get_option('button_text_hover_color'); ?>;
		border-color: <?php echo codeus_get_option('button_text_hover_color'); ?>;
	<?php endif; ?>
}
input[type="submit"]:active,
button:active,
a.button:active {
	<?php if(codeus_get_option('button_text_active_color')) : ?>
		color: <?php echo codeus_get_option('button_text_active_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('button_background_active_color')) : ?>
		background-color: <?php echo codeus_get_option('button_background_active_color'); ?>;
	<?php endif; ?>
}
input[type="submit"]:active:before,
input[type="submit"]:active:before,
input[type="submit"]:active:before {
	<?php if(codeus_get_option('button_text_active_color')) : ?>
		color: <?php echo codeus_get_option('button_text_active_color'); ?>;
		border-color: <?php echo codeus_get_option('button_text_active_color'); ?>;
	<?php endif; ?>
}
.icon {
	<?php if(codeus_get_option('icons_background_color')) : ?>
		background-color: <?php echo codeus_get_option('icons_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('icons_symbol_color')) : ?>
		color: <?php echo codeus_get_option('icons_symbol_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('icons_border_color')) : ?>
		border-color: <?php echo codeus_get_option('icons_border_color'); ?>;
	<?php endif; ?>
}
.icon.active {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
input[type="text"], input[type="password"], textarea,
input[type="color"], input[type="date"], input[type="datetime"],
input[type="datetime-local"], input[type="email"], input[type="number"],
input[type="range"], input[type="search"], input[type="tel"],
input[type="time"], input[type="url"], input[type="month"], input[type="week"] {
	<?php if(codeus_get_option('form_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('form_elements_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('form_elements_text_color')) : ?>
		color: <?php echo codeus_get_option('form_elements_text_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}
.pagination > a,
.pagination > span {
	<?php if(codeus_get_option('h3_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h3_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h3_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h3_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h3_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h3_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h3_font_style') && strpos(codeus_get_option('h3_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('pager_text_color')) : ?>
		color: <?php echo codeus_get_option('pager_text_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('pager_border_color')) : ?>
		border-color: <?php echo codeus_get_option('pager_border_color'); ?>;
	<?php endif; ?>
}
.pagination .current,
.pagination > span,
.pagination a:hover {
	<?php if(codeus_get_option('pager_border_color')) : ?>
		background-color: <?php echo codeus_get_option('pager_border_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('pager_active_text_color')) : ?>
		color: <?php echo codeus_get_option('pager_active_text_color'); ?>;
	<?php endif; ?>
}
body span.styled-subtitle,
.portfolio ul.thumbs.products li .small-title a,
.related-products.block.portfolio ul.thumbs li .small-title a,
.shop_table.cart .cart_totals th,
.shop_table.cart th,
.before-cart-table {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php else: ?>
		font-family: '<?php echo codeus_get_option('body_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('widgets_custom_field_color')) : ?>
		color: <?php echo codeus_get_option('widgets_custom_field_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h4_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h4_line_height'); ?>px;
	<?php endif; ?>
}
.woocommerce.single-product .product .price {
	<?php if(codeus_get_option('widgets_custom_field_color')) : ?>
		color: <?php echo codeus_get_option('widgets_custom_field_color'); ?>;
	<?php endif; ?>
}
.woocommerce #customer_login .col .login-box .form-row label,
.woocommerce #customer_login .col .login-box .form-row .input-text {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php else: ?>
		font-family: '<?php echo codeus_get_option('body_font_family'); ?>';
	<?php endif; ?>
}
.socials li a:hover:after {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		background-color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('button_text_hover_color')) : ?>
		color: <?php echo codeus_get_option('button_text_hover_color'); ?>;
	<?php endif; ?>
}

/* LAYOUT */

#page {
	<?php if(codeus_get_option('basic_inner_background_color')) : ?>
		background-color: <?php echo codeus_get_option('basic_inner_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('basic_inner_background_image')) : ?>
		background-image: url("<?php echo codeus_get_option('basic_inner_background_image'); ?>");
	<?php endif; ?>
	<?php if(codeus_get_option('header_pattern_image')) : ?>
		background-image: url("<?php echo codeus_get_option('header_pattern_image'); ?>");
	<?php endif; ?>
	<?php if(codeus_get_option('basic_inner_background_image') && codeus_get_option('header_pattern_image')) : ?>
		background-image: url("<?php echo codeus_get_option('header_pattern_image'); ?>"), url("<?php echo codeus_get_option('basic_inner_background_image'); ?>");
	<?php endif; ?>
}

/* HEADER */

.page-title-block .page-title-block-header {
	<?php if(codeus_get_option('h1_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h1_font_size'); ?>px;
	<?php endif; ?>
}

#header {
	<?php if(codeus_get_option('top_background_color')) : ?>
		background-color: <?php echo codeus_get_option('top_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('top_background_image')) : ?>
		background-image: url("<?php echo codeus_get_option('top_background_image'); ?>");
	<?php endif; ?>
}
#header.header-fixed {
	<?php if(codeus_get_option('top_background_color')) : ?>
		background-color: <?php echo codeus_get_option('top_background_color'); ?>;
	<?php endif; ?>
}
#header #site-navigation li.current-menu-item,
#header #site-navigation li.current-menu-ancestor {
	<?php if(codeus_get_option('main_menu_active_background_color')) : ?>
		background-color: <?php echo codeus_get_option('main_menu_active_background_color'); ?>;
	<?php endif; ?>
}
#header #site-navigation li a {
	<?php if(codeus_get_option('main_menu_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('main_menu_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_font_size')) : ?>
		font-size: <?php echo codeus_get_option('main_menu_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_line_height')) : ?>
		line-height: <?php echo codeus_get_option('main_menu_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('main_menu_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_font_style') && strpos(codeus_get_option('main_menu_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_text_color'); ?>;
	<?php endif; ?>
}
#header #site-navigation li a:hover {
	<?php if(codeus_get_option('main_menu_hover_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_hover_text_color'); ?>;
	<?php endif; ?>
}
#header #site-navigation li.current-menu-item > a,
#header #site-navigation li.current-menu-ancestor > a {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
#header #site-navigation li li,
#header #site-navigation ul.minicart .cart_list_item {
	<?php if(codeus_get_option('submenu_background_color')) : ?>
		background-color: <?php echo codeus_get_option('submenu_background_color'); ?>;
	<?php endif; ?>
}
#header #site-navigation li li + li {
	<?php if(codeus_get_option('submenu_background_color')) : ?>
		background-color: <?php echo codeus_get_option('submenu_background_color'); ?>;
	<?php endif; ?>
}
#header #site-navigation li li:hover a,
#header #site-navigation li li.current-menu-item a,
#header #site-navigation li li.current-menu-ancestor a,
#header #site-navigation li li li a {
	<?php if(codeus_get_option('submenu_hover_background_color')) : ?>
		background-color: <?php echo codeus_get_option('submenu_hover_background_color'); ?>;
	<?php endif; ?>
}
#header #site-navigation li li a {
	<?php if(codeus_get_option('submenu_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('submenu_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_font_size')) : ?>
		font-size: <?php echo codeus_get_option('submenu_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_line_height')) : ?>
		line-height: <?php echo codeus_get_option('submenu_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('submenu_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_font_style') && strpos(codeus_get_option('submenu_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_text_color')) : ?>
		color: <?php echo codeus_get_option('submenu_text_color'); ?>;
	<?php endif; ?>
}
#header #site-navigation li li:hover a,
#header #site-navigation li li.current-menu-item a,
#header #site-navigation li li.current-menu-ancestor a {
	<?php if(codeus_get_option('submenu_hover_text_color')) : ?>
		color: <?php echo codeus_get_option('submenu_hover_text_color'); ?>;
	<?php endif; ?>
}
#header #site-navigation li li.menu-parent-item > a:before {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
#header #site-navigation li li.menu-parent-item:hover > a:before,
#header #site-navigation li li.current-menu-item > a:before,
#header #site-navigation li li.current-menu-ancestor > a:before {
	<?php if(codeus_get_option('submenu_hover_text_color')) : ?>
		color: <?php echo codeus_get_option('submenu_hover_text_color'); ?>;
	<?php endif; ?>
}
#header #site-navigation li li li:hover a,
#header #site-navigation li li li.current-menu-item a,
#header #site-navigation li li li.current-menu-ancestor a {
	<?php if(codeus_get_option('main_menu_hover_text_color')) : ?>
		background-color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
@media only screen and (max-width:799px) {
	#header #site-navigation li {
		<?php if(codeus_get_option('submenu_background_color')) : ?>
			background-color: <?php echo codeus_get_option('submenu_background_color'); ?>;
		<?php endif; ?>
	}
	#header #site-navigation li.current-menu-item,
	#header #site-navigation li.current-menu-ancestor {
		<?php if(codeus_get_option('main_menu_active_background_color')) : ?>
			background-color: <?php echo codeus_get_option('main_menu_active_background_color'); ?>;
		<?php endif; ?>
	}
	#header #site-navigation li a {
		<?php if(codeus_get_option('submenu_font_family')) : ?>
			font-family: '<?php echo codeus_get_option('submenu_font_family'); ?>';
		<?php endif; ?>
		<?php if(codeus_get_option('submenu_font_size')) : ?>
			font-size: <?php echo codeus_get_option('submenu_font_size'); ?>px;
		<?php endif; ?>
		<?php if(codeus_get_option('submenu_line_height')) : ?>
			line-height: <?php echo codeus_get_option('submenu_line_height'); ?>px;
		<?php endif; ?>
		<?php if(codeus_get_option('submenu_font_style')) : ?>
			font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('submenu_font_style')); ?>;
		<?php endif; ?>
		<?php if(codeus_get_option('submenu_font_style') && strpos(codeus_get_option('submenu_font_style'), 'italic') !== false) : ?>
			font-style: italic;
		<?php else : ?>
			font-style: normal;
		<?php endif; ?>
		<?php if(codeus_get_option('submenu_text_color')) : ?>
			color: <?php echo codeus_get_option('submenu_text_color'); ?>;
		<?php endif; ?>
	}
	#header #site-navigation li a:hover {
		<?php if(codeus_get_option('submenu_hover_text_color')) : ?>
			color: <?php echo codeus_get_option('submenu_hover_text_color'); ?>;
		<?php endif; ?>
	}
	#header #site-navigation li.current-menu-item > a,
	#header #site-navigation li.current-menu-ancestor > a {
		<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
			color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
		<?php endif; ?>
	}
}

/* MAIN */

.content-wrap {
	<?php if(codeus_get_option('main_background_color')) : ?>
		background-color: <?php echo codeus_get_option('main_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('main_background_image')) : ?>
		background-image: url("<?php echo codeus_get_option('main_background_image'); ?>");
	<?php endif; ?>
}

/* SIDEBAR */

.sidebar .widget + .widget {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-top-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}

/* FOOTER */

#footer #contacts {
	<?php if(codeus_get_option('contact_background_color')) : ?>
		background-color: <?php echo codeus_get_option('contact_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('contact_background_image')) : ?>
		background-image: url("<?php echo codeus_get_option('contact_background_image'); ?>");
	<?php endif; ?>
	<?php if(codeus_get_option('contact_bar_text_color')) : ?>
		color: <?php echo codeus_get_option('contact_bar_text_color'); ?>;
	<?php endif; ?>
}
#footer .socials-icons li a:after {
	<?php if(codeus_get_option('contact_background_color')) : ?>
		color: <?php echo codeus_get_option('contact_background_color'); ?>;
	<?php endif; ?>
}
#footer .socials-icons li a:hover:after {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		background-color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
#bottom-line {
	<?php if(codeus_get_option('footer_background_color')) : ?>
		background-color: <?php echo codeus_get_option('footer_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('footer_text_color')) : ?>
		color: <?php echo codeus_get_option('footer_text_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('footer_background_image')) : ?>
		background-image: url("<?php echo codeus_get_option('footer_background_image'); ?>");
	<?php endif; ?>
}
#bottom-line .footer-nav li a {
	<?php if(codeus_get_option('footer_text_color')) : ?>
		color: <?php echo codeus_get_option('footer_text_color'); ?>;
	<?php endif; ?>
}
#bottom-line .footer-nav li:before {
	<?php if(codeus_get_option('bullets_symbol_color')) : ?>
		color: <?php echo codeus_get_option('bullets_symbol_color'); ?>;
	<?php endif; ?>
}
#bottom-line .site-info {
	<?php if(codeus_get_option('copyright_text_color')) : ?>
		color: <?php echo codeus_get_option('copyright_text_color'); ?>;
	<?php endif; ?>
}
#bottom-line .site-info a {
	<?php if(codeus_get_option('copyright_link_color')) : ?>
		color: <?php echo codeus_get_option('copyright_link_color'); ?>;
	<?php endif; ?>
}

/* SLIDESHOW */

.slideshow .nivo-caption .title {
	<?php if(codeus_get_option('slideshow_title_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('slideshow_title_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('slideshow_title_font_size')) : ?>
		font-size: <?php echo codeus_get_option('slideshow_title_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('slideshow_title_line_height')) : ?>
		line-height: <?php echo codeus_get_option('slideshow_title_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('slideshow_title_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('slideshow_title_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('slideshow_title_font_style') && strpos(codeus_get_option('slideshow_title_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
}
.slideshow .nivo-caption .description {
	<?php if(codeus_get_option('slideshow_description_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('slideshow_description_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('slideshow_description_font_size')) : ?>
		font-size: <?php echo codeus_get_option('slideshow_description_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('slideshow_description_line_height')) : ?>
		line-height: <?php echo codeus_get_option('slideshow_description_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('slideshow_description_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('slideshow_description_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('slideshow_description_font_style') && strpos(codeus_get_option('slideshow_description_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
}

/* QUICKFINDER */

.quickfinder.block,
.slideshow.block {
	<?php if(codeus_get_option('quickfinder_bar_background_color')) : ?>
		background-color: <?php echo codeus_get_option('quickfinder_bar_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('quickfinder_bar_background_image')) : ?>
		background-image: url("<?php echo codeus_get_option('quickfinder_bar_background_image'); ?>");
	<?php endif; ?>
}
.quickfinder ul li .title {
	<?php if(codeus_get_option('quickfinder_title_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('quickfinder_title_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('quickfinder_title_font_size')) : ?>
		font-size: <?php echo codeus_get_option('quickfinder_title_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('quickfinder_title_line_height')) : ?>
		line-height: <?php echo codeus_get_option('quickfinder_title_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('quickfinder_title_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('quickfinder_title_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('quickfinder_title_font_style') && strpos(codeus_get_option('quickfinder_title_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('quickfinder_title_color')) : ?>
		color: <?php echo codeus_get_option('quickfinder_title_color'); ?>;
	<?php endif; ?>
}
.quickfinder ul li .description {
	<?php if(codeus_get_option('quickfinder_description_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('quickfinder_description_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('quickfinder_description_font_size')) : ?>
		font-size: <?php echo codeus_get_option('quickfinder_description_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('quickfinder_description_line_height')) : ?>
		line-height: <?php echo codeus_get_option('quickfinder_description_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('quickfinder_description_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('quickfinder_description_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('quickfinder_description_font_style') && strpos(codeus_get_option('quickfinder_description_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('quickfinder_description_color')) : ?>
		color: <?php echo codeus_get_option('quickfinder_description_color'); ?>;
	<?php endif; ?>
}
.quickfinder.block ul li .title {
	<?php if(codeus_get_option('quickfinder_bar_title_color')) : ?>
		color: <?php echo codeus_get_option('quickfinder_bar_title_color'); ?>;
	<?php endif; ?>
}
.quickfinder.block ul li .description {
	<?php if(codeus_get_option('quickfinder_bar_description_color')) : ?>
		color: <?php echo codeus_get_option('quickfinder_bar_description_color'); ?>;
	<?php endif; ?>
}
.quickfinder ul li .image {
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('button_background_basic_color')) : ?>
		background-color: <?php echo codeus_get_option('button_background_basic_color'); ?>;
	<?php endif; ?>
}

/* PORTFOLIO */

/* ARROWS */

html * .ls-container .ls-nav-prev:before,
html * .ls-container .ls-nav-next:before,
.block.clients .prev:before,
.block.clients .next:before,
.block.portfolio .prev:before,
.block.portfolio .next:before {
	<?php if(codeus_get_option('portfolio_slider_arrow_border_color')) : ?>
		border-color: <?php echo codeus_get_option('portfolio_slider_arrow_border_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_slider_arrow_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_slider_arrow_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs li .title,
.block.portfolio ul.thumbs li .title {
	<?php if(codeus_get_option('portfolio_title_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('portfolio_title_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_title_font_size')) : ?>
		font-size: <?php echo codeus_get_option('portfolio_title_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_title_line_height')) : ?>
		line-height: <?php echo codeus_get_option('portfolio_title_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_title_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('portfolio_title_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_title_font_style') && strpos(codeus_get_option('portfolio_title_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_title_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_title_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs li .small-title {
	<?php if(codeus_get_option('portfolio_title_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('portfolio_title_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_title_font_size')) : ?>
		font-size: <?php echo codeus_get_option('portfolio_title_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_title_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('portfolio_title_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_title_font_style') && strpos(codeus_get_option('portfolio_title_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_description_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_description_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs li .description {
	<?php if(codeus_get_option('portfolio_description_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('portfolio_description_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_description_font_size')) : ?>
		font-size: <?php echo codeus_get_option('portfolio_description_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_description_line_height')) : ?>
		line-height: <?php echo codeus_get_option('portfolio_description_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_description_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('portfolio_description_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_description_font_style') && strpos(codeus_get_option('portfolio_description_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_description_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_description_color'); ?>;
	<?php endif; ?>
}
.portfolio.block {
	<?php if(codeus_get_option('portfolio_slider_bar_background_color')) : ?>
		background-color: <?php echo codeus_get_option('portfolio_slider_bar_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_bar_background_image')) : ?>
		background-image: url("<?php echo codeus_get_option('portfolio_bar_background_image'); ?>");
	<?php endif; ?>
}
.portfolio.block ul.thumbs li .title {
	<?php if(codeus_get_option('portfolio_slider_title_background_color')) : ?>
		background-color: <?php echo codeus_get_option('portfolio_slider_title_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_slider_title_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_slider_title_color'); ?>;
	<?php endif; ?>
}
.portfolio.block ul.thumbs li .description {
	<?php if(codeus_get_option('portfolio_slider_description_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_slider_description_color'); ?>;
	<?php endif; ?>
}
.portfolio.block ul.thumbs li .small-title {
	<?php if(codeus_get_option('portfolio_slider_description_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_slider_description_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs li .title {
	<?php if(codeus_get_option('portfolio_title_background_color')) : ?>
		background-color: <?php echo codeus_get_option('portfolio_title_background_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs li .title .title-hover-color {
	<?php if(codeus_get_option('button_background_basic_color')) : ?>
		background-color: <?php echo codeus_get_option('button_background_basic_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs li .title .title-inner-content.hover {
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs li .share-block-toggle {
	<?php if(codeus_get_option('portfolio_sharing_button_background_color')) : ?>
		background-color: <?php echo codeus_get_option('portfolio_sharing_button_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs li .share-block-toggle.active {
	<?php if(codeus_get_option('button_background_basic_color')) : ?>
		background-color: <?php echo codeus_get_option('button_background_basic_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs li .share-block {
	<?php if(codeus_get_option('button_background_hover_color')) : ?>
		background-color: <?php echo codeus_get_option('button_background_hover_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs li .share-block a,
.portfolio ul.thumbs li .share-block a:hover {
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs li .share-block a:hover {
	<?php if(codeus_get_option('portfolio_sharing_button_background_color')) : ?>
		background-color: <?php echo codeus_get_option('portfolio_sharing_button_background_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs li .info {
	<?php if(codeus_get_option('body_font_size')) : ?>
		font-size: <?php echo codeus_get_option('body_font_size'); ?>px;
	<?php endif; ?>
}
.portfolio ul.thumbs li .info {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.filter li a {
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.filter li a:hover,
.portfolio ul.filter li.active a {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.filter li .icon {
	<?php if(codeus_get_option('icons_symbol_color')) : ?>
		color: <?php echo codeus_get_option('icons_symbol_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.filter li a:hover .icon,
.portfolio ul.filter li.active a .icon {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}

/* NEWS & BLOG */

.blog_list li .date-day {
	<?php if(codeus_get_option('h2_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h2_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h2_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h2_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h2_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h2_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h2_font_style') && strpos(codeus_get_option('h2_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('button_background_basic_color')) : ?>
		background-color: <?php echo codeus_get_option('button_background_basic_color'); ?>;
	<?php endif; ?>
}
.blog_list li .date-day span {
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
}
.news_list .news_item .image {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.news_list .news_item .date {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.news_list .all-news a:before {
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
}
.blog_list li .comment-count {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.blog_list li .post-info {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}
.blog_list li .post-info-bottom .more-link b:before {
	<?php if(codeus_get_option('bullets_symbol_color')) : ?>
		color: <?php echo codeus_get_option('bullets_symbol_color'); ?>;
	<?php endif; ?>
}
.newslist:before,
.newslist:after {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.newslist > li .datetime .day {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.newslist > li .datetime .time {
	<?php if(codeus_get_option('h2_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h2_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h2_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h2_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h2_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h2_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h2_font_style') && strpos(codeus_get_option('h2_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('h2_color')) : ?>
		color: <?php echo codeus_get_option('h2_color'); ?>;
	<?php endif; ?>
}
.newslist > li .thumbnail img {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		border-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.newslist > li .thumbnail .empty {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
		border-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.newslist > li .thumbnail .empty:after {
	<?php if(codeus_get_option('icons_symbol_color')) : ?>
		color: <?php echo codeus_get_option('icons_symbol_color'); ?>;
	<?php endif; ?>
}
.newslist > li .text {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.newslist > li .text:after {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		border-color: transparent <?php echo codeus_get_option('styled_elements_background_color'); ?> transparent transparent;
	<?php endif; ?>
}
@media only screen and (max-width:999px) {
	.panel .newslist > li .text:after {
		<?php if(codeus_get_option('styled_elements_background_color')) : ?>
			border-color: transparent transparent <?php echo codeus_get_option('styled_elements_background_color'); ?> transparent;
		<?php endif; ?>
	}
}
@media only screen and (max-width:799px) {
	#page .newslist > li .text:after {
		<?php if(codeus_get_option('styled_elements_background_color')) : ?>
			border-color:  transparent<?php echo codeus_get_option('styled_elements_background_color'); ?> transparent transparent;
		<?php endif; ?>
	}
}
@media only screen and (max-width:599px) {
	#page .newslist > li .text:after {
		<?php if(codeus_get_option('styled_elements_background_color')) : ?>
			border-color: transparent transparent <?php echo codeus_get_option('styled_elements_background_color'); ?> transparent;
		<?php endif; ?>
	}
}
.post-tags-block {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}
.post-tags {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.post-author-block {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.post-author-avatar img {
	<?php if(codeus_get_option('main_background_color')) : ?>
		background-color: <?php echo codeus_get_option('main_background_color'); ?>;
	<?php endif; ?>
}
.post-author-info .name {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h4_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h4_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h4_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style') && strpos(codeus_get_option('h4_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
}
.post-author-info .date-info {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.post-related-posts-line {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}
.post-posts-links a {
	<?php if(codeus_get_option('submenu_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('submenu_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_font_size')) : ?>
		font-size: <?php echo codeus_get_option('submenu_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_line_height')) : ?>
		line-height: <?php echo codeus_get_option('submenu_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('submenu_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_font_style') && strpos(codeus_get_option('submenu_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_text_color')) : ?>
		color: <?php echo codeus_get_option('submenu_text_color'); ?>;
	<?php endif; ?>
}
.post-posts-links a:hover {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.post-posts-links .left a:before,
.post-posts-links .right a:before {
	<?php if(codeus_get_option('dropcap_border_color')) : ?>
		border-color: <?php echo codeus_get_option('dropcap_border_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcap_background_color')) : ?>
		background-color: <?php echo codeus_get_option('dropcap_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcaps_symbol_color')) : ?>
		color: <?php echo codeus_get_option('dropcaps_symbol_color'); ?>;
	<?php endif; ?>
}

.related-element img {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		border-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.related-element.without-image > a {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
ol.commentlist .comment-content .comment-author {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h4_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h4_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h4_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style') && strpos(codeus_get_option('h4_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
}
ol.commentlist .comment-content .comment-date {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
ol.commentlist ul.children li {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}

/* COMMENTS */

ol.commentlist li.comment {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}
ol.commentlist{
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}

/* GALLERY */

.gallery .slide-info,
.slideinfo .fancybox-title {
	<?php if(codeus_get_option('gallery_caption_background_color')) : ?>
		background-color: <?php echo codeus_get_option('gallery_caption_background_color'); ?>;
	<?php endif; ?>
}
.gallery ul.thumbs li.selected a {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		border-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.gallery ul.thumbs li.selected a:before {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		border-color: transparent transparent <?php echo codeus_get_option('styled_elements_background_color'); ?> transparent;
	<?php endif; ?>
}
.gallery .navigation .prev:before,
.gallery .navigation .next:before {
	<?php if(codeus_get_option('portfolio_slider_arrow_border_color')) : ?>
		border-color: <?php echo codeus_get_option('portfolio_slider_arrow_border_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_slider_arrow_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_slider_arrow_color'); ?>;
	<?php endif; ?>
}
.gallery .slide-info .slide-caption,
.slideinfo .fancybox-title .slide-caption {
	<?php if(codeus_get_option('gallery_title_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('gallery_title_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('gallery_title_font_size')) : ?>
		font-size: <?php echo codeus_get_option('gallery_title_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('gallery_title_line_height')) : ?>
		line-height: <?php echo codeus_get_option('gallery_title_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('gallery_title_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('gallery_title_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('gallery_title_font_style') && strpos(codeus_get_option('gallery_title_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('gallery_title_color')) : ?>
		color: <?php echo codeus_get_option('gallery_title_color'); ?>;
	<?php endif; ?>
}
.gallery .slide-info .slide-description,
.slideinfo .fancybox-title .slide-description {
	<?php if(codeus_get_option('gallery_description_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('gallery_description_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('gallery_description_font_size')) : ?>
		font-size: <?php echo codeus_get_option('gallery_description_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('gallery_description_line_height')) : ?>
		line-height: <?php echo codeus_get_option('gallery_description_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('gallery_description_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('gallery_description_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('gallery_description_font_style') && strpos(codeus_get_option('gallery_description_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('gallery_description_color')) : ?>
		color: <?php echo codeus_get_option('gallery_description_color'); ?>;
	<?php endif; ?>
}

/* SHORTCODES */

.divider,
.divider.double,
.divider.dashed {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}
.text_box {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.wrap-box.style-1 .wrap-box-inner,
.wrap-box.style-2 .wrap-box-inner,
.wrap-box.style-6 .wrap-box-inner {
	<?php if(codeus_get_option('images_border_color')) : ?>
		border-color: <?php echo codeus_get_option('images_border_color'); ?>;
	<?php endif; ?>
}
.wrap-box.style-3 .wrap-box-inner {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		border-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.accordion {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}
.accordion h5:before,
.shipping-calculator-button:before {
	<?php if(codeus_get_option('dropcap_border_color')) : ?>
		border-color: <?php echo codeus_get_option('dropcap_border_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcap_background_color')) : ?>
		background-color: <?php echo codeus_get_option('dropcap_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcaps_symbol_color')) : ?>
		color: <?php echo codeus_get_option('dropcaps_symbol_color'); ?>;
	<?php endif; ?>
}
.tabs {
	<?php if(codeus_get_option('images_border_color')) : ?>
		background-color: <?php echo codeus_get_option('images_border_color'); ?>;
	<?php endif; ?>
}
.tabs > ul.tabs-nav li a {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
}
.tabs > ul.tabs-nav li.ui-tabs-active a {
	<?php if(codeus_get_option('main_background_color')) : ?>
		background-color: <?php echo codeus_get_option('main_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('main_background_image')) : ?>
		background-image: url("<?php echo codeus_get_option('main_background_image'); ?>");
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.tabs .tab_wrapper {
	<?php if(codeus_get_option('main_background_color')) : ?>
		background-color: <?php echo codeus_get_option('main_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('main_background_image')) : ?>
		background-image: url("<?php echo codeus_get_option('main_background_image'); ?>");
	<?php endif; ?>
}
.dropcap span {
	<?php if(codeus_get_option('h3_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h3_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h3_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h3_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h3_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h3_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h3_font_style') && strpos(codeus_get_option('h3_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcap_border_color')) : ?>
		border-color: <?php echo codeus_get_option('dropcap_border_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcap_background_color')) : ?>
		background-color: <?php echo codeus_get_option('dropcap_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcaps_symbol_color')) : ?>
		color: <?php echo codeus_get_option('dropcaps_symbol_color'); ?>;
	<?php endif; ?>
}
.simple-icon {
	<?php if(codeus_get_option('dropcap_border_color')) : ?>
		border-color: <?php echo codeus_get_option('dropcap_border_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcap_background_color')) : ?>
		background-color: <?php echo codeus_get_option('dropcap_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcaps_symbol_color')) : ?>
		color: <?php echo codeus_get_option('dropcaps_symbol_color'); ?>;
	<?php endif; ?>
}
.list ul li:before {
	<?php if(codeus_get_option('bullets_symbol_color')) : ?>
		color: <?php echo codeus_get_option('bullets_symbol_color'); ?>;
	<?php endif; ?>
}
table {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		border-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
table thead tr {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
table tr:nth-child(even) {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.alert-box > div {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.alert-box .alert-icon {
	<?php if(codeus_get_option('dropcap_border_color')) : ?>
		border-color: <?php echo codeus_get_option('dropcap_border_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcap_background_color')) : ?>
		background-color: <?php echo codeus_get_option('dropcap_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcaps_symbol_color')) : ?>
		color: <?php echo codeus_get_option('dropcaps_symbol_color'); ?>;
	<?php endif; ?>
}
.iconed-title .icon,
.iconed-text .icon {
	<?php if(codeus_get_option('dropcap_border_color')) : ?>
		border-color: <?php echo codeus_get_option('dropcap_border_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcap_background_color')) : ?>
		background-color: <?php echo codeus_get_option('dropcap_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcaps_symbol_color')) : ?>
		color: <?php echo codeus_get_option('dropcaps_symbol_color'); ?>;
	<?php endif; ?>
}
.iconed-title .icon.active,
.iconed-text .icon.active {
	<?php if(codeus_get_option('dropcap_border_color')) : ?>
		background-color: <?php echo codeus_get_option('dropcap_border_color'); ?>;
	<?php endif; ?>
}

/* WIDGETS */

h3.widget-title {
	<?php if(codeus_get_option('widget_title_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('widget_title_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('widget_title_font_size')) : ?>
		font-size: <?php echo codeus_get_option('widget_title_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('widget_title_line_height')) : ?>
		line-height: <?php echo codeus_get_option('widget_title_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('widget_title_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('widget_title_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('widget_title_font_style') && strpos(codeus_get_option('widget_title_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('widget_title_color')) : ?>
		color: <?php echo codeus_get_option('widget_title_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('widget_title_background_color')) : ?>
		background-color: <?php echo codeus_get_option('widget_title_background_color'); ?>;
	<?php endif; ?>
}
h3.widget-title + * {
	<?php if(codeus_get_option('widget_background_color')) : ?>
		background-color: <?php echo codeus_get_option('widget_background_color'); ?>;
	<?php endif; ?>
}
.widget a {
	<?php if(codeus_get_option('widget_link_color')) : ?>
		color: <?php echo codeus_get_option('widget_link_color'); ?>;
	<?php endif; ?>
}
.widget a:hover {
	<?php if(codeus_get_option('widget_hover_link_color')) : ?>
		color: <?php echo codeus_get_option('widget_hover_link_color'); ?>;
	<?php endif; ?>
}
.widget a:active {
	<?php if(codeus_get_option('widget_active_link_color')) : ?>
		color: <?php echo codeus_get_option('widget_active_link_color'); ?>;
	<?php endif; ?>
}

/* Projects & Contact Info */
.project_info-item .title,
.contact_info-item .title {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h4_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h4_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h4_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style') && strpos(codeus_get_option('h4_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('widgets_custom_field_color')) : ?>
		color: <?php echo codeus_get_option('widgets_custom_field_color'); ?>;
	<?php endif; ?>
}
.project_info-item + .project_info-item,
.contact_info-item + .contact_info-item {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}

/* Testimonials */
.testimonial_item td {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.testimonial_item td.image div {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.testimonial_item td.info .name {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h4_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h4_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h4_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style') && strpos(codeus_get_option('h4_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
}

/* Categories */
.widget.widget_categories ul li,
.widget.widget_meta ul li {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}
.widget.widget_categories ul li a,
.widget.widget_meta ul li a {
	<?php if(codeus_get_option('submenu_text_color')) : ?>
		color: <?php echo codeus_get_option('submenu_text_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_font_size')) : ?>
		font-size: <?php echo codeus_get_option('submenu_font_size'); ?>px;
	<?php endif; ?>
}
.widget.widget_categories ul li a:hover,
.widget.widget_meta ul li a:hover {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.widget.widget_categories ul li a:before,
.widget.widget_meta ul li a:before {
	<?php if(codeus_get_option('bullets_symbol_color')) : ?>
		color: <?php echo codeus_get_option('bullets_symbol_color'); ?>;
	<?php endif; ?>
}

/* Custom Recent/Popular Posts */
.widget.Custom_Recent_Posts a,
.widget.Custom_Popular_Posts a,
.widget.widget_recent_entries a,
.widget.widget_rss a,
.twitter-box a,
.widget.widget_recent_comments a, {
	<?php if(codeus_get_option('link_color')) : ?>
		color: <?php echo codeus_get_option('link_color'); ?>;
	<?php endif; ?>
}
.widget.Custom_Recent_Posts .image,
.widget.Custom_Popular_Posts .image {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.widget.widget_recent_comments ul li:before {
	<?php if(codeus_get_option('icons_symbol_color')) : ?>
		color: <?php echo codeus_get_option('icons_symbol_color'); ?>;
	<?php endif; ?>
}

.widget_tag_cloud a {
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
}

.widget.widget_archive a {
	<?php if(codeus_get_option('link_color')) : ?>
		color: <?php echo codeus_get_option('link_color'); ?>;
	<?php endif; ?>
}
.widget.widget_archive ul li a:before {
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
}


/* Menu Widgets */
.widget.widget_nav_menu li,
.widget.widget_submenu li {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}
.widget.widget_nav_menu li a,
.widget.widget_submenu li a {
	<?php if(codeus_get_option('submenu_text_color')) : ?>
		color: <?php echo codeus_get_option('submenu_text_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_font_size')) : ?>
		font-size: <?php echo codeus_get_option('submenu_font_size'); ?>px;
	<?php endif; ?>
}
.widget.widget_nav_menu li a:hover,
.widget.widget_submenu li a:hover {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.widget.widget_nav_menu li.menu-item a:before,
.widget.widget_submenu li.menu-item a:before {
	<?php if(codeus_get_option('bullets_symbol_color')) : ?>
		color: <?php echo codeus_get_option('bullets_symbol_color'); ?>;
	<?php endif; ?>
}
.widget.widget_nav_menu li.menu-parent-item a:before,
.widget.widget_submenu li.menu-parent-item a:before {
	<?php if(codeus_get_option('dropcap_border_color')) : ?>
		border-color: <?php echo codeus_get_option('dropcap_border_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcaps_symbol_color')) : ?>
		color: <?php echo codeus_get_option('dropcaps_symbol_color'); ?>;
	<?php endif; ?>
}
.widget.widget_nav_menu li.current-menu-item a,
.widget.widget_nav_menu li.current-menu-ancestor a,
.widget.widget_submenu li.current-menu-item a,
.widget.widget_submenu li.current-menu-ancestor a {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.widget.widget_nav_menu li.current-menu-item ul,
.widget.widget_nav_menu li.current-menu-ancestor ul,
.widget.widget_submenu li.current-menu-item ul,
.widget.widget_submenu li.current-menu-ancestor ul {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_hover_background_color')) : ?>
		background-color: <?php echo codeus_get_option('submenu_hover_background_color'); ?>;
	<?php endif; ?>
}
.widget.widget_nav_menu li li.current-menu-item,
.widget.widget_submenu li li.current-menu-item {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		background-color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.widget.widget_nav_menu li.current-menu-ancestor li a:before,
.widget.widget_submenu li.current-menu-ancestor li a:before,
.widget.widget_nav_menu li.current-menu-item li a:before,
.widget.widget_submenu li.current-menu-item li a:before {
	<?php if(codeus_get_option('bullets_symbol_color')) : ?>
		color: <?php echo codeus_get_option('bullets_symbol_color'); ?>;
	<?php endif; ?>
}
.widget.widget_nav_menu li.current-menu-ancestor li.current-menu-item a,
.widget.widget_submenu li.current-menu-ancestor li.current-menu-item a {
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
}
.widget.widget_nav_menu li.current-menu-ancestor li.current-menu-item a:before,
.widget.widget_submenu li.current-menu-ancestor li.current-menu-item a:before {
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
}
.widget.widget_nav_menu li.current-menu-item li a,
.widget.widget_nav_menu li.current-menu-ancestor li a,
.widget.widget_submenu li.current-menu-item li a,
.widget.widget_submenu li.current-menu-ancestor li a {
	<?php if(codeus_get_option('submenu_text_color')) : ?>
		color: <?php echo codeus_get_option('submenu_text_color'); ?>;
	<?php endif; ?>
}
.widget.widget_nav_menu li li.current-menu-item a,
.widget.widget_nav_menu li li.current-menu-ancestor a,
.widget.widget_submenu li li.current-menu-item a,
.widget.widget_submenu li li.current-menu-ancestor a {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}

/* Team */
.team-item .team-image {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.team-item .team-name {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h4_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h4_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h4_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style') && strpos(codeus_get_option('h4_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
}
.widget.widget_calendar th,
.widget.widget_calendar caption {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.widget.widget_calendar td a {
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('button_background_basic_color')) : ?>
		background-color: <?php echo codeus_get_option('button_background_basic_color'); ?>;
	<?php endif; ?>
}
.twitter-box .jtwt_tweet:before {
	<?php if(codeus_get_option('icons_symbol_color')) : ?>
		color: <?php echo codeus_get_option('icons_symbol_color'); ?>;
	<?php endif; ?>
}
.widget.picturebox .description,
.widget.widget_search form {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}

/* TEAM */

.team-element-email a:before,
.contact-form label:before {
	<?php if(codeus_get_option('icons_symbol_color')) : ?>
		color: <?php echo codeus_get_option('icons_symbol_color'); ?>;
	<?php endif; ?>
}
.team-element-position,
.contact-form label .required {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.team-element-name {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h4_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h4_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h4_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style') && strpos(codeus_get_option('h4_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
}
.team-element-image {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.team-element {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}

/* CLIENTS */

.clients.block {
	<?php if(codeus_get_option('portfolio_slider_bar_background_color')) : ?>
		background-color: <?php echo codeus_get_option('portfolio_slider_bar_background_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_bar_background_image')) : ?>
		background-image: url("<?php echo codeus_get_option('portfolio_bar_background_image'); ?>");
	<?php endif; ?>
}
.clients ul.list li a {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.clients ul.filter li a {
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
}
.clients ul.filter li a:hover,
.clients ul.filter li.active a {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.clients ul.filter li .icon {
	<?php if(codeus_get_option('icons_symbol_color')) : ?>
		color: <?php echo codeus_get_option('icons_symbol_color'); ?>;
	<?php endif; ?>
}
.clients ul.filter li a:hover .icon,
.clients ul.filter li.active a .icon {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}

/* DIAGRAMS */

.skill-line {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.diagram-circle .text {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.diagram-circle .text div {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h4_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h4_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style') && strpos(codeus_get_option('h4_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.diagram-circle .text div span {
	<?php if(codeus_get_option('h2_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h2_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h2_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h2_font_family')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h2_font_style') && strpos(codeus_get_option('h2_font_family'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.diagram-circle .text div span.title {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h4_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h4_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style') && strpos(codeus_get_option('h4_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.diagram-circle .text div span.summary {
	<?php if(codeus_get_option('body_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('body_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('body_font_size')) : ?>
		font-size: <?php echo codeus_get_option('body_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('body_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('body_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('body_font_style') && strpos(codeus_get_option('body_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
}
.diagram-legend .legend-element .title {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h4_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h4_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h4_font_style') && strpos(codeus_get_option('h4_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}

/* SLIDESHOW & OVERLAY ICONS */

.slideshow .nivo-directionNav a.nivo-nextNav:before,
.slideshow .nivo-directionNav a.nivo-prevNav:before,
html * .slideshow .ls-container .ls-nav-prev:before,
html * .slideshow .ls-container .ls-nav-next:before,
.portfolio ul.thumbs li .overlay .p-icon,
.block.portfolio ul.thumbs li .overlay .p-icon,
.gallery .navigation.preview-navigation .prev:before,
.gallery .navigation.preview-navigation .next:before,
.gallery .preview li a span.overlay .p-icon,
.gallery-three-columns ul li a span.overlay .p-icon,
.gallery-four-columns ul li a span.overlay .p-icon,
.image.wrap-box .fancy .overlay:before {
	<?php if(codeus_get_option('slideshow_arrow_border_color')) : ?>
		border-color: <?php echo codeus_get_option('slideshow_arrow_border_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('slideshow_arrow_color')) : ?>
		color: <?php echo codeus_get_option('slideshow_arrow_color'); ?>;
	<?php endif; ?>
}

/* WPML */

#bottom-line #lang_sel ul ul a,
#bottom-line #lang_sel ul ul a:visited {
	<?php if(codeus_get_option('footer_background_color')) : ?>
		background-color: <?php echo codeus_get_option('footer_background_color'); ?>;
	<?php endif; ?>
}
#bottom-line #lang_sel ul ul a:hover,
#bottom-line #lang_sel ul ul a:visited:hover {
	<?php if(codeus_get_option('contact_background_color')) : ?>
		background-color: <?php echo codeus_get_option('contact_background_color'); ?>;
	<?php endif; ?>
}

/* PRICING TABLE */

.pricing-table .pricing-column .pricing-title {
	<?php if(codeus_get_option('h3_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h3_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('h3_font_size')) : ?>
		font-size: <?php echo codeus_get_option('h3_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h3_line_height')) : ?>
		line-height: <?php echo codeus_get_option('h3_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('h3_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('h3_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('h3_font_style') && strpos(codeus_get_option('h3_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
}

.pricing-table .pricing-column .pricing-title span.subtitle {
	<?php if(codeus_get_option('body_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('body_font_family'); ?>';
	<?php endif; ?>
}

.pricing-table .pricing-column .pricing-price {
	<?php if(codeus_get_option('h1_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h1_font_family'); ?>';
	<?php endif; ?>
}

.pricing-table .pricing-column .pricing-price span.time {
	<?php if(codeus_get_option('body_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('body_font_family'); ?>';
	<?php endif; ?>
}



/* Menu Widgets */
.widget.widget_product_categories li {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}
.widget.widget_product_categories li a {
	<?php if(codeus_get_option('submenu_text_color')) : ?>
		color: <?php echo codeus_get_option('submenu_text_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_font_size')) : ?>
		font-size: <?php echo codeus_get_option('submenu_font_size'); ?>px;
	<?php endif; ?>
}
.widget.widget_product_categories li a:hover {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.widget.widget_product_categories li.cat-item a:before {
	<?php if(codeus_get_option('bullets_symbol_color')) : ?>
		color: <?php echo codeus_get_option('bullets_symbol_color'); ?>;
	<?php endif; ?>
}
.widget.widget_product_categories li.cat-parent a:before {
	<?php if(codeus_get_option('dropcap_border_color')) : ?>
		border-color: <?php echo codeus_get_option('dropcap_border_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('dropcaps_symbol_color')) : ?>
		color: <?php echo codeus_get_option('dropcaps_symbol_color'); ?>;
	<?php endif; ?>
}
.widget.widget_product_categories li.current-cat a,
.widget.widget_product_categories li.current-cat-parent a {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.widget.widget_product_categories li.current-cat ul,
.widget.widget_product_categories li.cat-parent ul {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('submenu_hover_background_color')) : ?>
		background-color: <?php echo codeus_get_option('submenu_hover_background_color'); ?>;
	<?php endif; ?>
}
.widget.widget_product_categories li li.current-cat {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		background-color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.widget.widget_product_categories li.current-cat li a:before,
.widget.widget_product_categories li.cat-parent li a:before {
	<?php if(codeus_get_option('bullets_symbol_color')) : ?>
		color: <?php echo codeus_get_option('bullets_symbol_color'); ?>;
	<?php endif; ?>
}
.widget.widget_product_categories li.current-cat li.current-cat a:before,
.widget.widget_product_categories li.cat-parent li.current-cat a:before,
.widget.widget_product_categories li.cat-parent li.current-cat a {
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>18:06 26.04.2014
}
widget.widget_product_categories li.cat-parent li.current-cat a:before {
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
}
.widget.widget_product_categories li.current-cat li a,
.widget.widget_product_categories li.cat-parent li a {
	<?php if(codeus_get_option('submenu_text_color')) : ?>
		color: <?php echo codeus_get_option('submenu_text_color'); ?>;
	<?php endif; ?>
}
widget.widget_product_categories li li.current-cat a,
.widget.widget_product_categories li li.cat-parent a {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}

/* PRODUCT LIST */

.woocommerce-result-count,
.shop_table.cart .product-name h4 a,
.woocommerce table.shop_table.order-details tr.cart_item td.product-name .product-info h4 a,
.woocommerce table.shop_table.order-details tr.order_item td.product-name .product-info h4 a {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.thumbs.products li .info,
.portfolio ul.thumbs.products li .info a,
.related-products.block.portfolio ul.thumbs li  .info a {
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
}

/* PRODUCT SEARCH */

.widget_product_search form {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}
.widget_product_search form button,
.widget_product_search form button:hover {
	<?php if(codeus_get_option('form_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('form_elements_background_color'); ?>;
	<?php endif; ?>
}

.woocommerce-message,
.woocommerce-info {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}

.woocommerce table.shop_table.order-details tr.cart_item td.product-total,
.woocommerce table.shop_table.order-details tr.order_item td.product-total,
.woocommerce table.checkout-cart-info-table tr td {
	<?php if(codeus_get_option('h2_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h2_font_family'); ?>';
	<?php endif; ?>
}

.product-right-block .images .dummy,
.products .image.dummy {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}

.product_bottom_line .product_meta .sep {
	<?php if(codeus_get_option('link_color')) : ?>
		color: <?php echo codeus_get_option('link_color'); ?>;
	<?php endif; ?>
}

.shop_table.cart .cart-collaterals .cart_totals td .shipping-message {
	<?php if(codeus_get_option('body_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('body_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('body_font_size')) : ?>
		font-size: <?php echo codeus_get_option('body_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('body_line_height')) : ?>
		line-height: <?php echo codeus_get_option('body_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('body_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('body_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('body_font_style') && strpos(codeus_get_option('body_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
}

.widget_shopping_cart .mini-cart-bottom .buttons .button.cart-link {
	<?php if(codeus_get_option('link_color')) : ?>
		color: <?php echo codeus_get_option('link_color'); ?>;
	<?php endif; ?>
}
.widget_shopping_cart .mini-cart-bottom .buttons .button.cart-link:before {
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
}

.widget_shopping_cart .total {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}

.shop_attributes tr + tr td,
.shop_attributes tr + tr th {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}

.combobox-button,
.quantity.buttons_added input[type="button"],
.woocommerce-checkout .form-row .chosen-container-single .chosen-single div,
.edit-address-form .form-row .chosen-container-single .chosen-single div,
.select2-container .select2-choice .select2-arrow,
.select2-results .select2-highlighted,
.woocommerce-checkout .form-row .checkbox-sign,
.woocommerce-checkout #ship-to-different-address .checkbox-sign,
.woocommerce .checkout #payment .payment_methods li span.radio,
.checkout-login-box .form-row .checkbox-sign {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		background-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}
.combobox-button:after {
	<?php if(codeus_get_option('button_background_hover_color')) : ?>
		color: <?php echo codeus_get_option('button_background_hover_color'); ?>;
	<?php endif; ?>
}

#header #site-navigation ul.minicart .mini-cart-bottom .total .amount,
.woocommerce.widget_products .product_list_widget .price .amount {
	<?php if(codeus_get_option('h4_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('h4_font_family'); ?>';
	<?php endif; ?>
}

.woocommerce .star-rating:before, .woocommerce-page .star-rating:before,
.comment-form-rating .stars a + a,
.comment-form-rating .stars a:before {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}

.woocommerce .star-rating, .woocommerce-page .star-rating,
.comment-form-rating .stars a:hover:before,
.comment-form-rating .stars a.active:before {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.widget_price_filter .price_slider .ui-slider-range,
.widget_price_filter .price_slider .ui-slider-handle {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		background-color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.quantity input[type="number"],
.combobox-wrapper,
.widget_price_filter .price_slider,
.woocommerce .checkout .form-row .input-text,
.woocommerce .edit-address-form .form-row .input-text,
.woocommerce-checkout .form-row .chosen-container-single .chosen-single,
.edit-address-form .form-row .chosen-container-single .chosen-single,
.select2-container .select2-choice,
.select2-container,
.select2-drop,
.select2-results,
.shop_table.cart .input-text {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}

ul.products.thumbs li,
ul.product_list_widget li {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		border-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}

.woocommerce .products .cart-button {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}

.woocommerce .products .cart-button:before,
.woocommerce .products .added_to_cart:before {
	<?php if(codeus_get_option('body_color')) : ?>
		color: <?php echo codeus_get_option('body_color'); ?>;
	<?php endif; ?>
}

.shop_table.cart,
.shop_table.cart tr + tr > td,
.shop_table.cart .cart_totals tr + tr td,
.shop_table.cart .cart_totals tr + tr th {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}

.widget_shopping_cart .cart_list_item {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}
.widget_shopping_cart .cart_list_item .mini-cart-info dl.variation dt,
.widget_shopping_cart .cart_list_item .mini-cart-info dl.variation dd,
.widget_shopping_cart .cart_list_item .mini-cart-info .quantity,
#header #site-navigation ul.minicart .cart_list_item .mini-cart-info dl.variation dt,
#header #site-navigation ul.minicart .cart_list_item .mini-cart-info dl.variation dd,
#header #site-navigation ul.minicart .cart_list_item .mini-cart-info .quantity {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}
.widget_shopping_cart .total,
#header #site-navigation ul.minicart .mini-cart-bottom {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}


.woocommerce .checkout .woocommerce-billing-collumn .form-row label,
.woocommerce .checkout .woocommerce-shipping-fields .form-row label,
.woocommerce .edit-address-form .woocommerce-billing-collumn .form-row label {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}

.shop_table.cart .coupon .button,
.woocommerce .checkout-login-box .woocommerce-info .button,
.myaccount-splash-page .address .title a.edit,
#header #site-navigation ul.minicart .mini-cart-bottom .buttons .wc-forward {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		background-color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}

.woocommerce .checkout #payment .payment_methods li .payment_box,
.woocommerce .checkout-login-box .login .form-row .input-text,
.woocommerce .checkout-lost-password-box .form-row .input-text {
	<?php if(codeus_get_option('styled_elements_background_color')) : ?>
		background-color: <?php echo codeus_get_option('styled_elements_background_color'); ?>;
	<?php endif; ?>
}

.woocommerce table.shop_table.order-details,
.woocommerce table.checkout-cart-info-table tr,
.woocommerce table.shop_table.order-details tr.cart_item,
.woocommerce table.shop_table.order-details tr.order_item,
.checkout-login-box, .checkout-lost-password-box,
.woocommerce .edit-address-form,
.woocommerce table.shop_table.order-details.received-order,
.woocommerce ul.order_details li,
table.myaccount-orders-table,
table.myaccount-orders-table tbody td,
#header #site-navigation ul.minicart .cart_list_item {
	<?php if(codeus_get_option('divider_default_color')) : ?>
		border-color: <?php echo codeus_get_option('divider_default_color'); ?>;
	<?php endif; ?>
}

.woocommerce table.shop_table.order-details thead tr th.product-name,
.woocommerce table.shop_table.order-details thead tr th.product-total,
.woocommerce .checkout-login-box .login .form-row label,
.woocommerce .checkout-lost-password-box .form-row label,
.woocommerce #customer_login .col .login-box .form-row label,
table.myaccount-orders-table thead th {
	<?php if(codeus_get_option('portfolio_date_color')) : ?>
		color: <?php echo codeus_get_option('portfolio_date_color'); ?>;
	<?php endif; ?>
}

.widget_layered_nav ul li a:before,
.widget_layered_nav_filters ul li a:before {
	<?php if(codeus_get_option('bullets_symbol_color')) : ?>
		color: <?php echo codeus_get_option('bullets_symbol_color'); ?>;
	<?php endif; ?>
}

#header #site-navigation .minicart-item-count {
	<?php if(codeus_get_option('button_text_basic_color')) : ?>
		color: <?php echo codeus_get_option('button_text_basic_color'); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('button_background_basic_color')) : ?>
		background-color: <?php echo codeus_get_option('button_background_basic_color'); ?>;
	<?php endif; ?>
}


/* PORTFOLIO FILTER STYLES */
.portfolio ul.filter li a:hover,
.portfolio ul.filter li a.active,
.portfolio ul.dl-menu li a:hover,
.portfolio ul.dl-menu li a.hover,
.portfolio ul.dl-submenu li a:hover,
.portfolio ul.dl-submenu li a.hover {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.filter li a:hover .icon,
.portfolio ul.filter li a.active .icon,
.portfolio ul.dl-menu li a:hover .icon,
.portfolio ul.dl-menu li a.hover .icon,
.portfolio ul.dl-submenu li a:hover .icon,
.portfolio ul.dl-submenu li a.hover .icon {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}

.portfolio ul.filter li.mix-filter li > a.active,
.portfolio ul.dl-menu li > a.active,
.portfolio ul.dl-submenu li > a.active {
	<?php if(codeus_get_option('main_menu_active_background_color')) : ?>
		background-color: <?php echo codeus_get_option('main_menu_active_background_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.filter li.mix-filter li > a,
.portfolio ul.dl-menu li > a,
.portfolio ul.dl-submenu li > a {
	<?php if(codeus_get_option('main_menu_font_family')) : ?>
		font-family: '<?php echo codeus_get_option('main_menu_font_family'); ?>';
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_font_size')) : ?>
		font-size: <?php echo codeus_get_option('main_menu_font_size'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_line_height')) : ?>
		line-height: <?php echo codeus_get_option('main_menu_line_height'); ?>px;
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_font_style')) : ?>
		font-weight: <?php echo str_replace(array('italic', 'regular'),array('', 'normal'),codeus_get_option('main_menu_font_style')); ?>;
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_font_style') && strpos(codeus_get_option('main_menu_font_style'), 'italic') !== false) : ?>
		font-style: italic;
	<?php else : ?>
		font-style: normal;
	<?php endif; ?>
	<?php if(codeus_get_option('main_menu_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_text_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.filter li.mix-filter li > a:hover,
.portfolio ul.dl-menu li > a:hover,
.portfolio ul.dl-submenu li > a:hover {
	<?php if(codeus_get_option('main_menu_hover_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_hover_text_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.filter li.mix-filter li > a.active,
.portfolio ul.dl-menu li > a.active,
.portfolio ul.dl-submenu li > a.active {
	<?php if(codeus_get_option('main_menu_active_text_color')) : ?>
		color: <?php echo codeus_get_option('main_menu_active_text_color'); ?>;
	<?php endif; ?>
}

.portfolio ul.filter li.mix-filter li a,
.portfolio ul.dl-menu li a,
.portfolio ul.dl-submenu li a {
	<?php if(codeus_get_option('submenu_background_color')) : ?>
		background-color: <?php echo codeus_get_option('submenu_background_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.filter li.mix-filter li + li,
.portfolio ul.dl-menu li + li,
.portfolio ul.dl-submenu li + li {
	<?php if(codeus_get_option('submenu_background_color')) : ?>
		background-color: <?php echo codeus_get_option('submenu_background_color'); ?>;
	<?php endif; ?>
}
.portfolio ul.filter li.mix-filter li:hover > a,
.portfolio ul.filter li.mix-filter li a.active,
.portfolio ul.dl-menu li:hover > a,
.portfolio ul.dl-menu li a.active,
.portfolio ul.dl-submenu li:hover > a,
.portfolio ul.dl-submenu li a.active {
	<?php if(codeus_get_option('submenu_hover_background_color')) : ?>
		background-color: <?php echo codeus_get_option('submenu_hover_background_color'); ?>;
	<?php endif; ?>
}


</style>