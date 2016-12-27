<?php
/**
 * This template will be show when user go to step=2 without sending a form
 *
 * This template can be overridden by copying it to
 *   theme-child/template-parts/importer/no-direct-access.php
 *   theme/template-parts/importer/no-direct-access.php
 *
 * @var array $args Arguments passed to template
 *
 * @author  8guild
 * @package Guild\Importer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="wrap">
	<h1><?php echo esc_html( $args['title'] ); ?></h1>
	<p>Direct access not allowed. You have to send a form to make this page work properly.</p>
	<p><?php show_message( $args['links'] ); ?></p>
</div>
