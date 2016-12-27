<?php
/**
 * This template will be shown when nonce is invalid
 *
 * This template can be overridden by copying it to
 *   theme-child/template-parts/importer/invalid-nonce.php
 *   theme/template-parts/importer/invalid-nonce.php
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
	<p>Nonce is invalid. Please try again.</p>
	<p><?php show_message( $args['links'] ); ?></p>
</div>
