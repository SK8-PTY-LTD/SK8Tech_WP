<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	?>
		<div class="gallery noscript small">
			<div class="container">
				<ul class="preview clearfix styled">
					<?php foreach($attachment_ids as $item) : ?>
						<?php
							$large_image_url = codeus_thumbnail($item, 'codeus_product_gallery');
							$full_image_url = wp_get_attachment_image_src($item, 'full');
						?>
						<?php if($large_image_url[0]) : ?>
							<li>
								<a class="fancy_gallery zoom" rel="group-<?php echo $product->ID; ?>" href="<?php echo $full_image_url[0]; ?>">
									<img src="<?php echo $large_image_url[0]; ?>" width="<?php echo $large_image_url[1]?>" height="<?php echo $large_image_url[2]?>" alt="" />
									<span class="overlay"><span class="p-icon"></span></span>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="thumbs_wrapper">
				<ul class="thumbs clearfix styled">
					<?php foreach($attachment_ids as $item) : ?>
						<?php
							$small_image_url = codeus_thumbnail($item, 'codeus_product_gallery_thumb');
						?>
						<?php if($small_image_url[0]) : ?>
							<li>
								<a class="thumb" href="<?php echo $large_image_url[0]; ?>">
									<img src="<?php echo $small_image_url[0]; ?>" width="<?php echo $small_image_url[1]?>" height="<?php echo $small_image_url[2]?>" alt="" />
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="loading"></div>
	<?php
} else {
?>
	<a class="zoom dummy" href="#"></a>
<?php
}