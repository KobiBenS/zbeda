<?php
/**
 * Template Name: Home Page
 * Template Post Type: page
 *
 * @package zbeda
 */

get_header();
?>

<section id="primary">
	<main id="main">

		<?php
		while ( have_posts() ) :
			the_post();

			// Get hero fields
			$hero_bg_type    = get_field( 'hero_background_type' );
			$hero_bg_image   = get_field( 'hero_background_image' );
			$hero_bg_video   = get_field( 'hero_background_video' );
			$hero_headline   = get_field( 'hero_headline' );
			$hero_subheadline = get_field( 'hero_subheadline' );
			$hero_cta_text   = get_field( 'hero_cta_text' );
			$hero_cta_link   = get_field( 'hero_cta_link' );

			// Get grid fields
			$grid_top_left        = get_field( 'grid_top_left' );
			$grid_top_left_image  = get_field( 'grid_top_left_image' );
			$grid_top_right       = get_field( 'grid_top_right' );
			$grid_bottom_left     = get_field( 'grid_bottom_left' );
			$grid_bottom_right    = get_field( 'grid_bottom_right' );
			$grid_bottom_right_image = get_field( 'grid_bottom_right_image' );
			?>

			<!-- Hero Section -->
			<div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gray-900">
				<!-- Background -->
				<?php if ( $hero_bg_type === 'video' && $hero_bg_video ) : ?>
					<video
						id="hero-video"
						class="absolute inset-0 w-full h-full object-cover z-0"
						autoplay
						muted
						loop
						playsinline
						preload="metadata"
						<?php if ( $hero_bg_image ) : ?>
							poster="<?php echo esc_url( $hero_bg_image ); ?>"
						<?php endif; ?>
					>
						<source src="<?php echo esc_url( $hero_bg_video['url'] ); ?>" type="video/mp4">
						<!-- Fallback image if video fails -->
						<?php if ( $hero_bg_image ) : ?>
							<img src="<?php echo esc_url( $hero_bg_image ); ?>" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover">
						<?php endif; ?>
					</video>
				<?php elseif ( $hero_bg_image ) : ?>
					<img
						src="<?php echo esc_url( $hero_bg_image ); ?>"
						alt="Hero Background"
						class="absolute inset-0 w-full h-full object-cover z-0"
					>
				<?php endif; ?>

				<!-- Overlay -->
				<div class="absolute inset-0 bg-black/20 z-10"></div>

				<!-- Content -->
				<div class="relative z-20 container mx-auto px-4 text-center bg-black/20 backdrop-blur-xl w-fit" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
					<?php if ( $hero_headline ) : ?>
						<h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
							<?php echo esc_html( $hero_headline ); ?>
						</h1>
					<?php endif; ?>

					<?php if ( $hero_subheadline ) : ?>
						<p class="text-xl md:text-2xl text-white mb-8 max-w-3xl mx-auto">
							<?php echo esc_html( $hero_subheadline ); ?>
						</p>
					<?php endif; ?>

					<?php if ( $hero_cta_text && $hero_cta_link ) : ?>
						<a href="<?php echo esc_url( $hero_cta_link ); ?>" class="inline-block px-8 py-4 bg-primary text-secondary font-bold text-lg rounded-lg hover:bg-primary/90 transition-colors">
							<?php echo esc_html( $hero_cta_text ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<!-- Grid Section -->
			<?php if ( $grid_top_left || $grid_top_right || $grid_bottom_left || $grid_bottom_right ) : ?>
				<div class="w-full">
					<div class="grid md:grid-cols-2">
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

							<!-- Bottom Right (appears on right in RTL) -->
							<div class="bg-secondary text-white p-8 relative overflow-hidden p-24">
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
			<?php endif; ?>

			<!-- Subsidiaries Section -->
			<?php
			$subsidiaries = new WP_Query(
				array(
					'post_type'      => 'subsidiary',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				)
			);

			if ( $subsidiaries->have_posts() ) :
				?>
				<div class="bg-white py-16">
					<div class="container mx-auto px-4">
						<!-- Section Title -->
						<div class="text-center mb-12" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
							<h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">
								<?php esc_html_e( 'חברות הקבוצה', 'zbeda' ); ?>
							</h2>
							<div class="w-24 h-1 bg-primary mx-auto"></div>
						</div>

						<!-- Subsidiaries Grid -->
						<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
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
											<!-- Title -->
											<h2 class="text-2xl font-bold mb-3">
												<a href="<?php the_permalink(); ?>" class="text-secondary hover:text-primary transition-colors">
													<?php the_title(); ?>
												</a>
											</h2>

											<!-- Excerpt -->
											<?php if ( has_excerpt() || get_the_content() ) : ?>
												<div class="text-gray-600 mb-4 line-clamp-3 min-h-24">
													<?php
													if ( has_excerpt() ) {
														the_excerpt();
													} else {
														echo wp_kses_post( wp_trim_words( get_the_content(), 20, '...' ) );
													}
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
			endif;
			?>

			<!-- Brands Section -->
			<?php
			$brands = new WP_Query(
				array(
					'post_type'      => 'brand',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				)
			);

			if ( $brands->have_posts() ) :
				$brands_array = array();
				while ( $brands->have_posts() ) :
					$brands->the_post();
					$brands_array[] = get_the_ID();
				endwhile;
				wp_reset_postdata();
				?>
				<div class="bg-gray-100 py-16">
					<div>
						<!-- Section Title -->
						<h2 class="text-3xl md:text-4xl font-bold text-center text-secondary mb-12" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
							<?php esc_html_e( 'השותפים שלנו – המותגים שמניעים את הענף', 'zbeda' ); ?>
						</h2>

						<!-- First Row - Scrolls Right -->
						<div class="brands-carousel-wrapper overflow-hidden mb-8">
							<div class="swiper brands-swiper-1">
								<div class="swiper-wrapper">
									<?php foreach ( $brands_array as $brand_id ) : ?>
										<?php
										$brand_thumbnail = get_the_post_thumbnail_url( $brand_id, 'medium' );
										if ( $brand_thumbnail ) :
											?>
											<div class="swiper-slide">
												<a href="<?php echo esc_url( get_permalink( $brand_id ) ); ?>" class="block bg-white p-4 hover:shadow-lg transition-shadow duration-300 rounded-full">
													<img
														src="<?php echo esc_url( $brand_thumbnail ); ?>"
														alt="<?php echo esc_attr( get_the_title( $brand_id ) ); ?>"
														class="w-full h-18 object-contain"
													>
												</a>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>

						<!-- Second Row - Scrolls Left -->
						<div class="brands-carousel-wrapper overflow-hidden">
							<div class="swiper brands-swiper-2">
								<div class="swiper-wrapper">
									<?php foreach ( $brands_array as $brand_id ) : ?>
										<?php
										$brand_thumbnail = get_the_post_thumbnail_url( $brand_id, 'medium' );
										if ( $brand_thumbnail ) :
											?>
											<div class="swiper-slide">
												<a href="<?php echo esc_url( get_permalink( $brand_id ) ); ?>" class="block bg-white rounded-full p-6 hover:shadow-lg transition-shadow duration-300">
													<img
														src="<?php echo esc_url( $brand_thumbnail ); ?>"
														alt="<?php echo esc_attr( get_the_title( $brand_id ) ); ?>"
														class="w-full h-18 object-contain"
													>
												</a>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Brands Carousel Styles -->
				<style>
					.brands-swiper-1.centered .swiper-wrapper,
					.brands-swiper-2.centered .swiper-wrapper {
						justify-content: center;
					}
				</style>

				<!-- Brands Carousel Script -->
				<script>
					document.addEventListener('DOMContentLoaded', function() {
						if (typeof Swiper !== 'undefined') {
							const homeBrandsCount = <?php echo count( $brands_array ); ?>;
							const swiperEl1 = document.querySelector('.brands-swiper-1');
							const swiperEl2 = document.querySelector('.brands-swiper-2');

							if (homeBrandsCount <= 6) {
								swiperEl1.classList.add('centered');
								swiperEl2.classList.add('centered');
							}

							// First carousel - slides to the right
							const brandsSwiper1 = new Swiper('.brands-swiper-1', {
								slidesPerView: 2,
								spaceBetween: 20,
								loop: homeBrandsCount > 6,
								speed: homeBrandsCount > 6 ? 5000 : 0,
								allowTouchMove: true,
								autoplay: homeBrandsCount > 6 ? {
									delay: 1,
									disableOnInteraction: false,
									pauseOnMouseEnter: true,
									reverseDirection: false,
								} : false,
								breakpoints: {
									640: {
										slidesPerView: 3,
										spaceBetween: 20,
									},
									768: {
										slidesPerView: 4,
										spaceBetween: 30,
									},
									1024: {
										slidesPerView: 6,
										spaceBetween: 30,
									},
								},
							});

							// Second carousel - slides to the left (reverse direction)
							const brandsSwiper2 = new Swiper('.brands-swiper-2', {
								slidesPerView: 2,
								spaceBetween: 20,
								loop: homeBrandsCount > 6,
								speed: homeBrandsCount > 6 ? 5000 : 0,
								allowTouchMove: true,
								autoplay: homeBrandsCount > 6 ? {
									delay: 1,
									disableOnInteraction: false,
									pauseOnMouseEnter: true,
									reverseDirection: true,
								} : false,
								breakpoints: {
									640: {
										slidesPerView: 3,
										spaceBetween: 20,
									},
									768: {
										slidesPerView: 4,
										spaceBetween: 30,
									},
									1024: {
										slidesPerView: 6,
										spaceBetween: 30,
									},
								},
							});
						}
					});
				</script>
			<?php endif; ?>

			<!-- Contact Section -->
			<?php get_template_part( 'template-parts/components/contact-section' ); ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</section><!-- #primary -->

<!-- Hero Video Autoplay Script -->
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const heroVideo = document.getElementById('hero-video');
		if (heroVideo) {
			// Log video state
			console.log('Video element found');
			console.log('Video ready state:', heroVideo.readyState);
			console.log('Video paused:', heroVideo.paused);

			// Listen for various video events
			heroVideo.addEventListener('loadedmetadata', function() {
				console.log('Video metadata loaded');
			});

			heroVideo.addEventListener('loadeddata', function() {
				console.log('Video data loaded');
			});

			heroVideo.addEventListener('canplay', function() {
				console.log('Video can play');
				heroVideo.play().catch(function(error) {
					console.error('Play failed:', error);
				});
			});

			heroVideo.addEventListener('error', function(e) {
				console.error('Video error:', e);
				console.error('Video error code:', heroVideo.error);
			});

			// Force play immediately
			const playPromise = heroVideo.play();
			if (playPromise !== undefined) {
				playPromise.then(function() {
					console.log('Video playing successfully');
				}).catch(function(error) {
					console.error('Autoplay failed:', error);

					// Retry on user interaction
					document.addEventListener('click', function() {
						heroVideo.play().then(function() {
							console.log('Video playing after user interaction');
						}).catch(function(err) {
							console.error('Play after click failed:', err);
						});
					}, { once: true });
				});
			}
		} else {
			console.log('Video element not found');
		}
	});
</script>

<?php
get_footer();
