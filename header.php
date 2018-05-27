<?php
/**
 * The header for our theme.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Startapp
 */

?><!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<?php wp_head();?>
<script>
/**
 * Add FullStory Integration
 * @author Jack
 * @see https://help.fullstory.com/integrate/wordpress
 * @see https://help.fullstory.com/technical-questions/fs-namespacing-issue
 */
window['_fs_debug'] = false;
window['_fs_host'] = 'fullstory.com';
window['_fs_org'] = '48ZFD';
window['_fs_namespace'] = 'FullStory';
(function(m,n,e,t,l,o,g,y){
    if (e in m) {if(m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].');} return;}
    g=m[e]=function(a,b){g.q?g.q.push([a,b]):g._api(a,b);};g.q=[];
    o=n.createElement(t);o.async=1;o.src='https://'+_fs_host+'/s/fs.js';
    y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y);
    g.identify=function(i,v){g(l,{uid:i});if(v)g(l,v)};g.setUserVars=function(v){g(l,v)};
    g.shutdown=function(){g("rec",!1)};g.restart=function(){g("rec",!0)};
    g.consent=function(a){g("consent",!arguments.length||a)};
    g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)};
    g.clearUserCookie=function(){};
})(window,document,window['_fs_namespace'],'script','user');
<?php if (is_user_logged_in()) {
	?>
var wpEmail = "<?php $current_user = wp_get_current_user();
	echo $current_user->user_email;?>";
FullStory.identify(wpEmail, { "displayName": wpEmail,
"email": wpEmail });
<?php }?>
</script>

</head>

<body <?php body_class();?>>

<?php
/**
 * Fires right before the <header>
 *
 * @see startapp_the_preloader()
 * @see startapp_the_offcanvas()
 * @see startapp_the_seach()
 * @see startapp_the_scroller()
 * @see startapp_offcanvas_menu()
 */
do_action('startapp_header_before');

get_template_part('template-parts/headers/header', startapp_header_layout());

/**
 * Fires right after the .site-header
 *
 * @see startapp_open_page_wrap() -1
 * @see startapp_page_title() 10
 */
do_action('startapp_header_after');
