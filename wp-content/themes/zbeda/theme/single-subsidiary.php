<?php
/**
 * The template for displaying single subsidiary posts
 *
 * @package zbeda
 */

get_header();

while ( have_posts() ) :
	the_post();

	$brand_name  = get_the_title();
	$logo_url    = get_field( 'logo' );
	$brand_url   = get_field( 'brand_website' );

	// Grid fields
	$grid_top_left        = get_field( 'grid_top_left' );
	$grid_top_left_image  = get_field( 'grid_top_left_image' );
	$grid_top_right       = get_field( 'grid_top_right' );
	$grid_bottom_left     = get_field( 'grid_bottom_left' );
	$grid_bottom_right    = get_field( 'grid_bottom_right' );
	$grid_bottom_right_image = get_field( 'grid_bottom_right_image' );
	?>

	<section id="primary">
		<main id="main">

			<!-- Brand Header -->
			<div class="bg-primary border-b border-gray-200">
				<div class="container mx-auto px-4 py-8">
					<div class="flex items-center justify-between" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>

						<!-- Right side: Breadcrumbs & Brand Name -->
						<div>
							<!-- Breadcrumbs -->
							<nav class="text-sm text-secondary mb-2" aria-label="Breadcrumb">
								<ol class="flex items-center gap-2">
									<li>
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-amber-500 transition-colors" aria-label="<?php esc_attr_e( 'בית', 'zbeda' ); ?>">
											<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
												<path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
											</svg>
										</a>
									</li>
									<li class="text-secondary">/</li>
									<li>
										<a href="<?php echo esc_url( get_post_type_archive_link( 'subsidiary' ) ); ?>" class="hover:text-amber-500 transition-colors">
											<?php esc_html_e( 'חברות הקבוצה', 'zbeda' ); ?>
										</a>
									</li>
									<li class="text-secondary">/</li>
									<li class="text-secondary font-bold">
										<?php echo esc_html( $brand_name ); ?>
									</li>
								</ol>
							</nav>

							<!-- Brand Name -->
							<h1 class="text-3xl md:text-4xl font-bold text-secondary">
								<?php echo esc_html( $brand_name ); ?>
							</h1>
						</div>

						<!-- Left side: Logo -->
						<div class="flex-shrink-0">
							<?php if ( $logo_url ) : ?>
								<img
									src="<?php echo esc_url( $logo_url ); ?>"
									alt="<?php echo esc_attr( $brand_name ); ?>"
									class="h-16 md:h-20 w-auto object-contain"
								>
							<?php endif; ?>
						</div>

					</div>
				</div>
			</div>

			<!-- Brand Content -->
			<div class="container mx-auto px-4 pt-24 py-12">
				<div class="flex flex-col md:flex-row gap-8 items-center">
					<div class="<?php echo has_post_thumbnail() ? 'md:w-3/5' : 'w-full'; ?> prose prose-lg max-w-none" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
						<?php the_content(); ?>
					</div>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="md:w-2/5 flex-shrink-0">
							<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto rounded-lg shadow-lg' ) ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Grid Section -->
		<?php if ( $grid_top_left || $grid_top_right || $grid_bottom_left || $grid_bottom_right ) : ?>
			<!-- Mobile Carousel -->
			<div class="md:hidden relative" style="height: 70vh;">
				<div class="swiper subsidiary-swiper h-full">
					<div class="swiper-wrapper">
						<?php
						// Define slide order based on language direction
						$slides = array();
						if ( is_rtl() ) {
							// RTL order
							if ( $grid_top_right ) {
								$slides[] = array( 'content' => $grid_top_right, 'image' => '', 'has_primary_heading' => false );
							}
							if ( $grid_top_left ) {
								$slides[] = array( 'content' => $grid_top_left, 'image' => $grid_top_left_image, 'has_primary_heading' => true );
							}
							if ( $grid_bottom_right ) {
								$slides[] = array( 'content' => $grid_bottom_right, 'image' => $grid_bottom_right_image, 'has_primary_heading' => true );
							}
							if ( $grid_bottom_left ) {
								$slides[] = array( 'content' => $grid_bottom_left, 'image' => '', 'has_primary_heading' => false );
							}
						} else {
							// LTR order
							if ( $grid_top_left ) {
								$slides[] = array( 'content' => $grid_top_left, 'image' => $grid_top_left_image, 'has_primary_heading' => true );
							}
							if ( $grid_top_right ) {
								$slides[] = array( 'content' => $grid_top_right, 'image' => '', 'has_primary_heading' => false );
							}
							if ( $grid_bottom_left ) {
								$slides[] = array( 'content' => $grid_bottom_left, 'image' => '', 'has_primary_heading' => false );
							}
							if ( $grid_bottom_right ) {
								$slides[] = array( 'content' => $grid_bottom_right, 'image' => $grid_bottom_right_image, 'has_primary_heading' => true );
							}
						}

						// Output slides
						foreach ( $slides as $slide ) :
							?>
							<div class="swiper-slide h-full">
								<div class="bg-secondary text-white p-8 h-full flex items-center justify-center relative overflow-hidden">
									<?php if ( $slide['image'] ) : ?>
										<img
											src="<?php echo esc_url( $slide['image'] ); ?>"
											alt=""
											class="absolute inset-0 w-full h-full object-cover opacity-30"
										>
									<?php endif; ?>
									<div class="relative z-10 max-w-2xl mx-auto">
										<div class="prose prose-invert max-w-none <?php echo $slide['has_primary_heading'] ? '[&_h2]:text-primary' : ''; ?>" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
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

			<!-- Desktop Grid -->
			<div class="hidden md:block w-full py-12">
				<div class="grid md:grid-cols-2 more_info_grid">
					<?php if ( is_rtl() ) : ?>
						<!-- RTL Layout -->
						<!-- Top Right (appears on right in RTL) -->
						<div class="bg-secondary text-white p-8 relative overflow-hidden p-24">
							<div class="relative z-10">
								<?php if ( $grid_top_right ) : ?>
									<div class="prose prose-invert max-w-none">
										<?php echo wp_kses_post( $grid_top_right ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<!-- Top Left (appears on left in RTL) -->
						<div class="bg-secondary text-white p-8 relative overflow-hidden p-24">
							<?php if ( $grid_top_left_image ) : ?>
								<img
									src="<?php echo esc_url( $grid_top_left_image ); ?>"
									alt="<?php echo esc_attr( $grid_top_left ?: '' ); ?>"
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

						<!-- Bottom Right (appears on right in RTL) -->
						<div class="bg-secondary text-white p-8 relative overflow-hidden p-24">
							<?php if ( $grid_bottom_right_image ) : ?>
								<img
									src="<?php echo esc_url( $grid_bottom_right_image ); ?>"
									alt="<?php echo esc_attr( $grid_bottom_right ?: '' ); ?>"
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

						<!-- Bottom Left (appears on left in RTL) -->
						<div class="bg-secondary text-white p-8 relative overflow-hidden p-24">
							<div class="relative z-10">
								<?php if ( $grid_bottom_left ) : ?>
									<div class="prose prose-invert max-w-none">
										<?php echo wp_kses_post( $grid_bottom_left ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>

					<?php else : ?>
						<!-- LTR Layout -->
						<!-- Top Left (appears on left in LTR) -->
						<div class="bg-secondary text-white p-8 relative overflow-hidden">
							<?php if ( $grid_top_left_image ) : ?>
								<img
									src="<?php echo esc_url( $grid_top_left_image ); ?>"
									alt="<?php echo esc_attr( $grid_top_left ?: '' ); ?>"
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

						<!-- Top Right (appears on right in LTR) -->
						<div class="bg-secondary text-white p-8 relative overflow-hidden">
							<div class="relative z-10">
								<?php if ( $grid_top_right ) : ?>
									<div class="prose prose-invert max-w-none">
										<?php echo wp_kses_post( $grid_top_right ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<!-- Bottom Left (appears on left in LTR) -->
						<div class="bg-secondary text-white p-8 relative overflow-hidden">
							<div class="relative z-10">
								<?php if ( $grid_bottom_left ) : ?>
									<div class="prose prose-invert max-w-none">
										<?php echo wp_kses_post( $grid_bottom_left ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<!-- Bottom Right (appears on right in LTR) -->
						<div class="bg-secondary text-white p-8 relative overflow-hidden">
							<?php if ( $grid_bottom_right_image ) : ?>
								<img
									src="<?php echo esc_url( $grid_bottom_right_image ); ?>"
									alt="<?php echo esc_attr( $grid_bottom_right ?: '' ); ?>"
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
		<?php endif; ?>

		<!-- Swiper Custom Styles -->
		<?php if ( $grid_top_left || $grid_top_right || $grid_bottom_left || $grid_bottom_right ) : ?>
			<style>
				/* White arrows, smaller size, with background */
				.subsidiary-swiper .swiper-button-next,
				.subsidiary-swiper .swiper-button-prev {
					color: white;
					width: 40px;
					height: 40px;
					background-color: #fbbf2480;
					border-radius: 50%;
					display: flex;
					align-items: center;
					justify-content: center;
				}
				.subsidiary-swiper .swiper-button-next:after,
				.subsidiary-swiper .swiper-button-prev:after {
					font-size: 18px;
				}

				/* White dots, smaller size */
				.subsidiary-swiper .swiper-pagination-bullet {
					background: white;
					width: 8px;
					height: 8px;
					opacity: 0.5;
				}

				/* Active dot - wider */
				.subsidiary-swiper .swiper-pagination-bullet-active {
					width: 24px;
					border-radius: 4px;
					opacity: 1;
				}
			</style>

			<script>
				document.addEventListener('DOMContentLoaded', function() {
					if (typeof Swiper !== 'undefined') {
						const swiper = new Swiper('.subsidiary-swiper', {
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

	</main><!-- #main -->
	</section><!-- #primary -->

	<?php
endwhile;

get_footer();
