<?php
/**
 * Template part for displaying the grid section
 *
 * This component displays a 2x2 grid layout on desktop and a carousel on mobile.
 * It uses ACF fields: grid_top_left, grid_top_left_image, grid_top_right,
 * grid_bottom_left, grid_bottom_right, grid_bottom_right_image
 *
 * @package zbeda
 */

// Get grid fields
$grid_top_left        = get_field( 'grid_top_left' );
$grid_top_left_image  = get_field( 'grid_top_left_image' );
$grid_top_right       = get_field( 'grid_top_right' );
$grid_bottom_left     = get_field( 'grid_bottom_left' );
$grid_bottom_right    = get_field( 'grid_bottom_right' );
$grid_bottom_right_image = get_field( 'grid_bottom_right_image' );

// Get mobile carousel checkbox (optional field - only exists for subsidiary post type)
$show_mobile_carousel = get_field( 'grid_mobile_carousel' );

// Only display if at least one grid field has content
if ( $grid_top_left || $grid_top_right || $grid_bottom_left || $grid_bottom_right ) :
	?>

	<?php if ( $show_mobile_carousel ) : ?>
		<!-- Mobile Carousel (hidden on desktop) -->
		<div class="md:hidden relative" style="height: 70vh;">
		<div class="swiper grid-section-swiper h-full">
			<div class="swiper-wrapper">
				<?php
				// Define slide order - MUST MATCH mobile grid order: Top Right, Top Left, Bottom Left, Bottom Right
				// Colors match desktop grid: RTL has mixed colors, LTR all secondary
				$slides = array();
				
				// Order 1: Top Right (same for both RTL and LTR)
				if ( $grid_top_right ) {
					$slides[] = array( 
						'content' => $grid_top_right, 
						'image' => '', 
						'has_primary_heading' => false,
						'bg_class' => is_rtl() ? 'bg-white' : 'bg-secondary',
						'text_class' => is_rtl() ? 'text-secondary' : 'text-white',
						'prose_class' => is_rtl() ? 'prose' : 'prose prose-invert'
					);
				}
				
				// Order 2: Top Left (same for both RTL and LTR)
				if ( $grid_top_left ) {
					$slides[] = array( 
						'content' => $grid_top_left, 
						'image' => $grid_top_left_image, 
						'has_primary_heading' => true,
						'bg_class' => 'bg-secondary',
						'text_class' => 'text-white',
						'prose_class' => 'prose prose-invert'
					);
				}
				
				// Order 3: Bottom Left (same for both RTL and LTR)
				if ( $grid_bottom_left ) {
					$slides[] = array( 
						'content' => $grid_bottom_left, 
						'image' => '', 
						'has_primary_heading' => false,
						'bg_class' => is_rtl() ? 'bg-white' : 'bg-secondary',
						'text_class' => is_rtl() ? 'text-secondary' : 'text-white',
						'prose_class' => is_rtl() ? 'prose' : 'prose prose-invert'
					);
				}
				
				// Order 4: Bottom Right (same for both RTL and LTR)
				if ( $grid_bottom_right ) {
					$slides[] = array( 
						'content' => $grid_bottom_right, 
						'image' => $grid_bottom_right_image, 
						'has_primary_heading' => true,
						'bg_class' => 'bg-secondary',
						'text_class' => 'text-white',
						'prose_class' => 'prose prose-invert'
					);
				}

				// Output slides with colors matching desktop grid
				foreach ( $slides as $slide ) :
					?>
					<div class="swiper-slide h-full">
						<div class="<?php echo esc_attr( $slide['bg_class'] . ' ' . $slide['text_class'] ); ?> p-8 h-full flex items-center justify-center relative overflow-hidden">
							<?php if ( $slide['image'] ) : ?>
								<img
									src="<?php echo esc_url( $slide['image'] ); ?>"
									alt=""
									class="absolute inset-0 w-full h-full object-cover opacity-30"
								>
							<?php endif; ?>
							<div class="relative z-10 max-w-2xl mx-auto">
								<div class="<?php echo esc_attr( $slide['prose_class'] ); ?> max-w-none <?php echo $slide['has_primary_heading'] ? '[&_h2]:text-primary' : ''; ?>" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
									<?php echo wp_kses_post( $slide['content'] ); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Navigation -->
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>

			<!-- Pagination -->
			<div class="swiper-pagination"></div>
		</div>
	</div>
	<?php endif; ?>

	<!-- Desktop Grid (always visible on desktop, visible on mobile only if carousel is disabled) -->
	<!-- Note: Mobile grid uses same background and text colors as desktop for consistency -->
	<div class="<?php echo $show_mobile_carousel ? 'hidden md:block' : 'block'; ?> w-full sqaureSection">
		<div class="flex flex-col md:grid md:grid-cols-2">
			<?php if ( is_rtl() ) : ?>
				<!-- RTL Layout -->
				<!-- Top Right (appears on right in RTL, order 1 on mobile) -->
				<!-- bg-white text-secondary matches desktop -->
				<div class="order-1 md:order-none bg-white text-secondary p-8 relative overflow-hidden md:p-12 xl:p-24">
					<div class="relative z-10">
						<?php if ( $grid_top_right ) : ?>
							<div class="prose  max-w-none">
								<?php echo wp_kses_post( $grid_top_right ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Top Left (appears on left in RTL, order 2 on mobile) -->
				<div class="order-2 md:order-none bg-secondary text-white p-8 relative overflow-hidden md:p-12 xl:p-24"> 
					<?php if ( $grid_top_left_image ) : ?>
						<img
							src="<?php echo esc_url( $grid_top_left_image ); ?>"
							alt=""
							class="absolute inset-0 w-full h-full object-cover opacity-30"
						>
					<?php endif; ?>
					<div class="relative z-10">
						<?php if ( $grid_top_left ) : ?>
							<div class="prose prose-invert max-w-none [&_h2]:text-primary">
								<?php echo wp_kses_post( $grid_top_left ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Bottom Right (appears on right in RTL, order 4 on mobile) -->
				<div class="order-4 md:order-none bg-secondary text-white p-8 relative overflow-hidden md:p-12 xl:p-24">
					<?php if ( $grid_bottom_right_image ) : ?>
						<img
							src="<?php echo esc_url( $grid_bottom_right_image ); ?>"
							alt=""
							class="absolute inset-0 w-full h-full object-cover opacity-30"
						>
					<?php endif; ?>
					<div class="relative z-10">
						<?php if ( $grid_bottom_right ) : ?>
							<div class="prose prose-invert max-w-none [&_h2]:text-primary">
								<?php echo wp_kses_post( $grid_bottom_right ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Bottom Left (appears on left in RTL, order 3 on mobile) -->
				<div class="order-3 md:order-none bg-white text-secondary p-8 relative overflow-hidden md:p-12 xl:p-24">
					<div class="relative z-10">
						<?php if ( $grid_bottom_left ) : ?>
							<div class="prose max-w-none">
								<?php echo wp_kses_post( $grid_bottom_left ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

			<?php else : ?>
				<!-- LTR Layout -->
				<!-- Top Right (appears on right in LTR, order 1 on mobile) -->
				<div class="order-1 md:order-none bg-secondary text-white p-8 relative overflow-hidden">
					<div class="relative z-10">
						<?php if ( $grid_top_right ) : ?>
							<div class="prose prose-invert max-w-none">
								<?php echo wp_kses_post( $grid_top_right ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Top Left (appears on left in LTR, order 2 on mobile) -->
				<div class="order-2 md:order-none bg-secondary text-white p-8 relative overflow-hidden">
					<?php if ( $grid_top_left_image ) : ?>
						<img
							src="<?php echo esc_url( $grid_top_left_image ); ?>"
							alt=""
							class="absolute inset-0 w-full h-full object-cover opacity-30"
						>
					<?php endif; ?>
					<div class="relative z-10">
						<?php if ( $grid_top_left ) : ?>
							<div class="prose prose-invert max-w-none [&_h2]:text-primary">
								<?php echo wp_kses_post( $grid_top_left ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Bottom Left (appears on left in LTR, order 3 on mobile) -->
				<div class="order-3 md:order-none bg-secondary text-white p-8 relative overflow-hidden">
					<div class="relative z-10">
						<?php if ( $grid_bottom_left ) : ?>
							<div class="prose prose-invert max-w-none">
								<?php echo wp_kses_post( $grid_bottom_left ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Bottom Right (appears on right in LTR, order 4 on mobile) -->
				<div class="order-4 md:order-none bg-secondary text-white p-8 relative overflow-hidden">
					<?php if ( $grid_bottom_right_image ) : ?>
						<img
							src="<?php echo esc_url( $grid_bottom_right_image ); ?>"
							alt=""
							class="absolute inset-0 w-full h-full object-cover opacity-30"
						>
					<?php endif; ?>
					<div class="relative z-10">
						<?php if ( $grid_bottom_right ) : ?>
							<div class="prose prose-invert max-w-none [&_h2]:text-primary">
								<?php echo wp_kses_post( $grid_bottom_right ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( $show_mobile_carousel ) : ?>
		<!-- Swiper Styles and Scripts -->
		<style>
		/* White arrows, smaller size, with background */
		.grid-section-swiper .swiper-button-next,
		.grid-section-swiper .swiper-button-prev {
			color: #101828;
			width: 40px;
			height: 40px;
			background-color: #fbbf2480;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.grid-section-swiper .swiper-button-next:after,
		.grid-section-swiper .swiper-button-prev:after {
			font-size: 18px;
		}

		/* White dots, smaller size */
		.grid-section-swiper .swiper-pagination-bullet {
			background:rgb(62, 93, 156);
			width: 8px;
			height: 8px;
			opacity: 0.5;
		}

		/* Active dot - wider */
		.grid-section-swiper .swiper-pagination-bullet-active {
			width: 24px;
			border-radius: 4px;
			opacity: 1;
		}
	</style>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			if (typeof Swiper !== 'undefined') {
				const swiper = new Swiper('.grid-section-swiper', {
					direction: 'horizontal',
					slidesPerView: 1,
					spaceBetween: 0,
					keyboard: {
						enabled: true,
					},
					pagination: {
						el: '.swiper-pagination',
						clickable: true,
					},
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
				});
			}
		});
	</script>
	<?php endif; ?>

	<?php
endif;