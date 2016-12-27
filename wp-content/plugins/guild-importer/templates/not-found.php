<?php
/**
 * This template will be show when provided variant not found
 *
 * This template can be overridden by copying it to
 *   theme-child/template-parts/importer/not-found.php
 *   theme/template-parts/importer/not-found.php
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
	<p>Provided variant `<?php echo esc_html( $args['variant'] ); ?>` not registered.</p>
	<p><?php show_message( $args['links'] ); ?></p>
</div>
