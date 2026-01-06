<?php
/**
 * Template part for displaying the brands grid section
 *
 * This component displays a responsive grid of brand logos.
 * Data source: Uses ACF field 'brands' if available, otherwise queries all brands (for homepage).
 *
 * @package zbeda
 */

// Try to get brands from ACF field first
$brands = get_field( 'brands' );

// If no ACF field, query all brands (for homepage)
if ( ! $brands ) {
	$brands_query = new WP_Query(
		array(
			'post_type'      => 'brand',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		)
	);
	
	if ( $brands_query->have_posts() ) {
		$brands = array();
		while ( $brands_query->have_posts() ) {
			$brands_query->the_post();
			$brands[] = get_the_ID();
		}
		wp_reset_postdata();
	}
}

// Normalize to array of IDs
$brand_ids = array();
if ( $brands ) {
	foreach ( $brands as $brand ) {
		$brand_id = is_object( $brand ) ? $brand->ID : $brand;
		if ( $brand_id ) {
			$brand_ids[] = $brand_id;
		}
	}
}

// Filter: Only keep brands that have thumbnails
$brands_with_images = array();
foreach ( $brand_ids as $brand_id ) {
	if ( get_the_post_thumbnail_url( $brand_id, 'medium' ) ) {
		$brands_with_images[] = $brand_id;
	}
}
?>

<?php if ( ! empty( $brands_with_images ) ) : ?>
	<div class="container mx-auto px-4">
		<!-- Brands Grid -->
		<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
			<?php foreach ( $brands_with_images as $brand_id ) :
				$brand_thumbnail = get_the_post_thumbnail_url( $brand_id, 'medium' );
				if ( $brand_thumbnail ) :
					?>
					<a href="<?php echo esc_url( get_permalink( $brand_id ) ); ?>" class="block bg-white p-4 hover:shadow-lg transition-shadow duration-300 rounded-full">
						<img
							src="<?php echo esc_url( $brand_thumbnail ); ?>"
							alt="<?php echo esc_attr( get_the_title( $brand_id ) ); ?>"
							class="w-full h-18 object-contain"
						>
					</a>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

