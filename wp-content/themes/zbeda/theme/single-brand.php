<?php
/**
 * The template for displaying single brand posts
 *
 * @package zbeda
 */

get_header();

while ( have_posts() ) :
	the_post();

	$brand_name    = get_the_title();
	$main_image_url = get_field( 'main_image' );

	// Get custom colors
	$primary_color = get_field( 'primary_color' );
	$secondary_color = get_field( 'secondary_color' );

	// Function to determine if a color is light or dark
	function zbeda_is_light_color( $hex_color ) {
		// Remove # if present
		$hex_color = ltrim( $hex_color, '#' );

		// Convert hex to RGB
		$r = hexdec( substr( $hex_color, 0, 2 ) );
		$g = hexdec( substr( $hex_color, 2, 2 ) );
		$b = hexdec( substr( $hex_color, 4, 2 ) );

		// Calculate relative luminance (perceived brightness)
		$luminance = ( 0.299 * $r + 0.587 * $g + 0.114 * $b ) / 255;

		// Return true if light (needs dark text), false if dark (needs light text)
		return $luminance > 0.5;
	}

	// Build inline style string
	$custom_styles = '';
	if ( $primary_color || $secondary_color ) {
		$custom_styles = '<style>';
		if ( $primary_color ) {
			$text_color_on_primary = zbeda_is_light_color( $primary_color ) ? '#000000' : '#ffffff';
			$custom_styles .= '.brand-custom-primary { background-color: ' . esc_attr( $primary_color ) . ' !important; }';
			$custom_styles .= '.brand-custom-primary-text { color: ' . esc_attr( $primary_color ) . ' !important; }';
			$custom_styles .= '.brand-custom-primary-border { border-color: ' . esc_attr( $primary_color ) . ' !important; }';
			$custom_styles .= '.brand-custom-primary .text-on-bg { color: ' . esc_attr( $text_color_on_primary ) . ' !important; }';
			$custom_styles .= '.brand-custom-primary.text-on-bg { color: ' . esc_attr( $text_color_on_primary ) . ' !important; }';
			$custom_styles .= '.text-on-bg.brand-custom-primary { color: ' . esc_attr( $text_color_on_primary ) . ' !important; }';
		}
		if ( $secondary_color ) {
			$custom_styles .= '.brand-custom-secondary { background-color: ' . esc_attr( $secondary_color ) . ' !important; }';
			$custom_styles .= '.brand-custom-secondary-text { color: ' . esc_attr( $secondary_color ) . ' !important; }';
			$custom_styles .= '.brand-custom-secondary-border { border-color: ' . esc_attr( $secondary_color ) . ' !important; }';
		}
		$custom_styles .= '</style>';
		echo $custom_styles;
	}
	?>

	<section id="primary">
		<main id="main">

			<!-- Brand Header -->
			<div class="<?php echo $primary_color ? 'brand-custom-primary' : 'bg-primary'; ?> border-b border-gray-200">
				<div class="container mx-auto px-4 py-8">
					<div class="flex items-center justify-between" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>

						<!-- Right side: Breadcrumbs & Brand Name -->
						<div>
							<!-- Breadcrumbs -->
							<nav class="text-sm <?php echo $primary_color ? 'text-on-bg' : 'text-secondary'; ?> mb-2" aria-label="Breadcrumb">
								<ol class="flex items-center gap-2">
									<li>
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:opacity-80 transition-opacity" aria-label="<?php esc_attr_e( 'בית', 'zbeda' ); ?>">
											<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
												<path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
											</svg>
										</a>
									</li>
									<li class="<?php echo $primary_color ? 'text-on-bg' : 'text-secondary'; ?>">/</li>
									<li>
										<a href="<?php echo esc_url( get_post_type_archive_link( 'brand' ) ); ?>" class="hover:opacity-80 transition-opacity">
											<?php esc_html_e( 'מותגים', 'zbeda' ); ?>
										</a>
									</li>
									<li class="<?php echo $primary_color ? 'text-on-bg' : 'text-secondary'; ?>">/</li>
									<li class="<?php echo $primary_color ? 'text-on-bg' : 'text-secondary'; ?> font-bold">
										<?php echo esc_html( $brand_name ); ?>
									</li>
								</ol>
							</nav>

							<!-- Brand Name -->
							<h1 class="text-3xl md:text-4xl font-bold <?php echo $primary_color ? 'text-on-bg' : 'text-secondary'; ?>">
								<?php echo esc_html( $brand_name ); ?>
							</h1>
						</div>

						<!-- Left side: Featured Image -->
						<div class="flex-shrink-0">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium', array( 'class' => 'h-16 md:h-20 w-auto object-contain' ) ); ?>
							<?php endif; ?>
						</div>

					</div>
				</div>
			</div>

			<!-- Brand Content -->
			<div class="container mx-auto px-4 pt-24 py-12">
				<div class="flex flex-col md:flex-row gap-8 items-center">
					<div class="<?php echo $main_image_url ? 'md:w-3/5' : 'w-full'; ?>" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
						<div class="prose prose-lg max-w-none">
							<?php the_content(); ?>
						</div>
					</div>
					<?php if ( $main_image_url ) : ?>
						<div class="md:w-2/5 flex-shrink-0">
							<img
								src="<?php echo esc_url( $main_image_url ); ?>"
								alt="<?php echo esc_attr( $brand_name ); ?>"
								class="w-full h-auto rounded-lg shadow-lg object-contain"
							>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Brand Gallery Section -->
			<?php
			$brand_gallery = get_field( 'brand_gallery' );
			if ( $brand_gallery && is_array( $brand_gallery ) && ! empty( $brand_gallery ) ) :
				?>
				<div class="bg-primary py-16">
					<div class="">
						<!-- Section Title
						<h2 class="text-3xl md:text-4xl font-bold text-center text-secondary mb-12 px-4" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
							<?php esc_html_e( 'גלריית תמונות', 'zbeda' ); ?>
						</h2> -->

						<!-- Gallery Carousel -->
						<div class="relative">
							<div class="swiper brand-gallery-swiper">
								<div class="swiper-wrapper">
									<?php foreach ( $brand_gallery as $image ) :
										$image_url = is_array( $image ) ? $image['url'] : $image;
										$image_full = is_array( $image ) ? ( $image['sizes']['large'] ?? $image['url'] ) : $image;
										$image_alt = is_array( $image ) ? ( $image['alt'] ?? '' ) : '';
										?>
										<div class="swiper-slide">
											<a href="<?php echo esc_url( $image_full ); ?>" class="glightbox" data-gallery="brand-gallery">
												<img
													src="<?php echo esc_url( $image_url ); ?>"
													alt="<?php echo esc_attr( $image_alt ); ?>"
													class="w-full rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
												>
											</a>
										</div>
									<?php endforeach; ?>
								</div>
								<!-- Navigation -->
								<div class="swiper-button-prev brand-gallery-prev"></div>
								<div class="swiper-button-next brand-gallery-next"></div>
								<!-- Pagination -->
								<div class="swiper-pagination brand-gallery-pagination"></div>
							</div>
						</div>
					</div>
				</div>

				<!-- Gallery Styles -->
				<style>
					.brand-gallery-swiper .swiper-slide {
						height: auto;
						padding-bottom: 60px;
					}
					.brand-gallery-swiper .swiper-slide img {
						width: 100%;
						aspect-ratio: 1 / 1;
						object-fit: contain;
					}
					.brand-gallery-swiper .swiper-button-next,
					.brand-gallery-swiper .swiper-button-prev {
						color: var(--wp--preset--color--primary);
						width: 40px;
						height: 40px;
						background-color: var(--wp--preset--color--secondary);
						border-radius: 50%;
						display: flex;
						align-items: center;
						justify-content: center;
						box-shadow: 0 2px 8px rgba(0,0,0,0.15);
					}
					.brand-gallery-swiper .swiper-button-next:after,
					.brand-gallery-swiper .swiper-button-prev:after {
						font-size: 16px;
					}
					.brand-gallery-swiper .swiper-pagination-bullet {
						background: var(--wp--preset--color--secondary);
						width: 8px;
						height: 8px;
						opacity: 0.5;
					}
					.brand-gallery-swiper .swiper-pagination-bullet-active {
						opacity: 1;
						width: 24px;
						border-radius: 4px;
					}
					.brand-gallery-swiper.no-carousel .swiper-button-prev,
					.brand-gallery-swiper.no-carousel .swiper-button-next,
					.brand-gallery-swiper.no-carousel .swiper-pagination {
						display: none !important;
					}
					.brand-gallery-swiper.no-carousel .swiper-wrapper {
						display: flex;
						justify-content: center;
						align-items: center;
						flex-wrap: wrap;
						gap: 20px;
					}
					@media (min-width: 768px) {
						.brand-gallery-swiper.no-carousel .swiper-wrapper {
							gap: 30px;
						}
					}
					.brand-gallery-swiper.no-carousel .swiper-slide {
						width: calc((100% - (4 * 30px)) / 5) !important;
						margin: 0 !important;
						flex-shrink: 0;
					}
					@media (max-width: 1279px) {
						.brand-gallery-swiper.no-carousel .swiper-slide {
							width: calc((100% - (3 * 30px)) / 4) !important;
						}
					}
					@media (max-width: 1023px) {
						.brand-gallery-swiper.no-carousel .swiper-slide {
							width: calc((100% - (2 * 30px)) / 3) !important;
						}
					}
					@media (max-width: 767px) {
						.brand-gallery-swiper.no-carousel .swiper-wrapper {
							gap: 20px;
						}
						.brand-gallery-swiper.no-carousel .swiper-slide {
							width: calc((100% - (0.3 * 20px)) / 1.3) !important;
						}
					}
				</style>

				<!-- Gallery Script -->
				<script>
					document.addEventListener('DOMContentLoaded', function() {
						if (typeof Swiper !== 'undefined') {
							const slideCount = <?php echo count( $brand_gallery ); ?>;
							const swiperEl = document.querySelector('.brand-gallery-swiper');
							let gallerySwiper = null;
							
							function getSlidesPerView() {
								if (window.innerWidth >= 1280) return 5;
								if (window.innerWidth >= 1024) return 4;
								if (window.innerWidth >= 768) return 3;
								return 1.3;
							}
							
							function initCarousel() {
								if (gallerySwiper) {
									gallerySwiper.destroy(true, true);
									gallerySwiper = null;
								}
								
								const slidesPerView = getSlidesPerView();
								
								if (slideCount > slidesPerView) {
									swiperEl.classList.remove('no-carousel');
									gallerySwiper = new Swiper('.brand-gallery-swiper', {
										slidesPerView: 1.3,
										centeredSlides: true,
										spaceBetween: 20,
										autoHeight: true,
										slidesOffsetBefore: 0,
										slidesOffsetAfter: 0,
										loop: <?php echo count( $brand_gallery ) > 1 ? 'true' : 'false'; ?>,
										keyboard: {
											enabled: true,
										},
										pagination: {
											el: '.brand-gallery-pagination',
											clickable: true,
										},
										navigation: {
											nextEl: '.brand-gallery-next',
											prevEl: '.brand-gallery-prev',
										},
										breakpoints: {
											768: {
												slidesPerView: 3,
												spaceBetween: 30,
												slidesOffsetBefore: 0,
												slidesOffsetAfter: 0,
											},
											1024: {
												slidesPerView: 4,
												spaceBetween: 30,
												slidesOffsetBefore: 0,
												slidesOffsetAfter: 0,
											},
											1280: {
												slidesPerView: 5,
												spaceBetween: 30,
												slidesOffsetBefore: 0,
												slidesOffsetAfter: 0,
											},
										},
									});
								} else {
									swiperEl.classList.add('no-carousel');
								}
							}
							
							initCarousel();
							
							let resizeTimer;
							window.addEventListener('resize', function() {
								clearTimeout(resizeTimer);
								resizeTimer = setTimeout(function() {
									initCarousel();
								}, 250);
							});
						}
						
						if (typeof GLightbox !== 'undefined') {
							const lightbox = GLightbox({
								selector: '.glightbox',
								loop: true,
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
