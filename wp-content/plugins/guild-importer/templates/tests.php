<?php
/**
 * Temporary template with tests
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
<table class="gi-test wp-list-table widefat fixed striped">
	<tr>
		<th>WP Memory Limit</th>
		<td class="column-primary has-row-actions"><?php echo WP_MEMORY_LIMIT; ?></td>
		<td><?php echo gi_get_bytes( WP_MEMORY_LIMIT ) >= 134217728 ? 'success' : 'warning'; ?></td>
	</tr>
	<tr>
		<th>PHP Memory Limit</th>
		<td><?php echo ini_get( 'memory_limit' ); ?></td>
		<td>?</td>
	</tr>
	<tr>
		<th>Time Limit</th>
		<td><?php echo ini_get( 'max_execution_time' ); ?></td>
		<td>
			<?php
			$time = ini_get( 'max_execution_time' );
			echo ( $time == 0 || $time > 300 ) ? 'success' : 'warning';
			unset( $time );
			?>
		</td>
	</tr>
	<tr>
		<th>Post Max Size</th>
		<td><?php echo ini_get( 'post_max_size' ); ?></td>
		<td>
			<?php
			// greater than 20M
			echo gi_get_bytes( ini_get( 'post_max_size' ) ) >= 20971520 ? 'success' : 'warning';
			?>
		</td>
	</tr>
	<tr>
		<th>Max Upload Size</th>
		<td><?php echo ini_get( 'upload_max_filesize' ); ?></td>
		<td>
			<?php
			// greater than 20M
			echo gi_get_bytes( ini_get( 'upload_max_filesize' ) ) >= 20971520 ? 'success' : 'warning';
			?>
		</td>
	</tr>
</table>
