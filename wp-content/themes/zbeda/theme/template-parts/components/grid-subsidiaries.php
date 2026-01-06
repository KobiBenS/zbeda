<?php
/**
 * Template part for displaying the subsidiaries grid section
 *
 * This component displays a responsive grid of subsidiary post cards.
 * Always shows all subsidiaries ordered by menu_order.
 *
 * @package zbeda
 */

// Query all subsidiaries ordered by menu_order
$subsidiaries = new WP_Query(
	array(
		'post_type'      => 'subsidiary',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);

// Grid column configuration (mobile, tablet, desktop)
// Default: 1 column mobile, 2 columns tablet, 4 columns desktop
$mobile_cols  = apply_filters( 'grid_subsidiaries_mobile_cols', 1 );
$tablet_cols  = apply_filters( 'grid_subsidiaries_tablet_cols', 2 );
$desktop_cols = apply_filters( 'grid_subsidiaries_desktop_cols', 4 );

// Build grid classes
$grid_classes = sprintf(
	'grid grid-cols-%d md:grid-cols-%d lg:grid-cols-%d gap-8',
	$mobile_cols,
	$tablet_cols,
	$desktop_cols
);
?>

<?php if ( $subsidiaries->have_posts() ) : ?>
	<div class="bg-white">
		<div class="container mx-auto px-4">
			<!-- Subsidiaries Grid -->
			<div class="<?php echo esc_attr( $grid_classes ); ?>" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
				<?php
				while ( $subsidiaries->have_posts() ) :
					$subsidiaries->the_post();
					$logo_url = get_field( 'logo' );
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'group' ); ?>>
						<div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
							<!-- Logo -->
							<?php if ( $logo_url ) : ?>
								<div class="relative overflow-hidden aspect-[4/3] bg-gray-50 flex items-center justify-center p-8">
									<a href="<?php the_permalink(); ?>" class="block">
										<img
											src="<?php echo esc_url( $logo_url ); ?>"
											alt="<?php echo esc_attr( get_the_title() ); ?>"
											class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300"
										>
									</a>
								</div>
							<?php endif; ?>

							<!-- Content -->
							<div class="p-6">
								<!-- Title or Excerpt -->
								<h2 class="text-xl font-bold mb-3">
									<a href="<?php the_permalink(); ?>" class="text-secondary hover:text-primary transition-colors">
										<?php if ( has_excerpt() && ! empty( get_the_excerpt() ) ) : ?>
											<?php the_excerpt(); ?>
										<?php else : ?>
											<?php the_title(); ?>
										<?php endif; ?>
									</a>
								</h2>

								<!-- Excerpt -->
								<?php if ( has_excerpt() || get_the_content() ) : ?>
									<div class="text-gray-600 mb-4 line-clamp-3 min-h-24">
										<?php

											echo wp_kses_post( wp_trim_words( get_the_content(), 20, '...' ) );

										?>
									</div>
								<?php endif; ?>

								<!-- Read More Link -->
								<a
									href="<?php the_permalink(); ?>"
									class="inline-flex items-center gap-2 text-primary hover:text-secondary font-semibold transition-colors"
								>
									<?php esc_html_e( 'קרא עוד', 'zbeda' ); ?>
									<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 <?php echo is_rtl() ? 'rotate-180' : ''; ?>" viewBox="0 0 20 20" fill="currentColor">
										<path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
									</svg>
								</a>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
	<?php
	wp_reset_postdata();
else :
	?>
	<!-- No Subsidiaries Found -->
	<div class="bg-white py-16 border-t-1 border-secondary">
		<div class="container mx-auto px-4">
			<div class="text-center" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
				<p class="text-xl text-gray-600">
					<?php esc_html_e( 'לא נמצאו חברות בקבוצה.', 'zbeda' ); ?>
				</p>
			</div>
		</div>
	</div>
	<?php
endif;
?>

