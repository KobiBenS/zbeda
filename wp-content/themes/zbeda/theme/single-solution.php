<?php
/**
 * The template for displaying single solution posts
 *
 * @package zbeda
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<section id="primary">
		<main id="main">

			<!-- Solution Header -->
			<div class="bg-primary border-b border-gray-200">
				<div class="container mx-auto px-4 py-8">
					<div <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
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
									<a href="<?php echo esc_url( get_post_type_archive_link( 'solution' ) ); ?>" class="hover:text-amber-500 transition-colors">
										<?php esc_html_e( 'תחומי פעילות', 'zbeda' ); ?>
									</a>
								</li>
								<li class="text-secondary">/</li>
								<li class="text-secondary font-bold">
									<?php the_title(); ?>
								</li>
							</ol>
						</nav>

						<!-- Solution Title -->
						<h1 class="text-3xl md:text-4xl font-bold text-secondary">
							<?php the_title(); ?>
						</h1>
					</div>
				</div>
			</div>

			<!-- Solution Content -->
			<div class="container mx-auto px-4 pt-24 py-12">
				<div class="flex flex-col md:flex-row gap-8 items-center">
					<div class="<?php echo has_post_thumbnail() ? 'md:w-3/5' : 'w-full'; ?>" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
						<div class="prose prose-lg max-w-none">
							<?php the_content(); ?>
						</div>
						<!-- Contact Button -->
						<a href="#contact-section" class="inline-block mt-6 px-8 py-3 bg-primary text-secondary font-bold rounded-lg hover:bg-primary/90 transition-colors">
							<?php esc_html_e( 'צור קשר', 'zbeda' ); ?>
						</a>
					</div>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="md:w-2/5 flex-shrink-0">
							<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto rounded-lg shadow-lg' ) ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Brands Section -->
			<?php
			$brands = get_field( 'brands' );
			if ( $brands ) :
				?>
				<div class="bg-gray-100 py-16">
					<div>
						<!-- Section Title -->
						<h2 class="text-3xl md:text-4xl font-bold text-center text-secondary mb-12" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
							<?php esc_html_e( 'השותפים שלנו – המותגים שמניעים את הענף', 'zbeda' ); ?>
						</h2>

						<!-- Brands Row -->
						<div class="brands-carousel-wrapper overflow-hidden">
							<div class="swiper brands-swiper-solution">
								<div class="swiper-wrapper">
									<?php foreach ( $brands as $brand_id ) : ?>
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
					</div>
				</div>

				<!-- Brands Carousel Styles -->
				<style>
					.brands-swiper-solution.centered .swiper-wrapper {
						justify-content: center;
					}
				</style>

				<!-- Brands Carousel Script -->
				<script>
					document.addEventListener('DOMContentLoaded', function() {
						if (typeof Swiper !== 'undefined') {
							const solutionBrandsCount = <?php echo count( $brands ); ?>;
							const swiperEl = document.querySelector('.brands-swiper-solution');

							if (solutionBrandsCount <= 6) {
								swiperEl.classList.add('centered');
							}

							const brandsSwiperSolution = new Swiper('.brands-swiper-solution', {
								slidesPerView: 2,
								spaceBetween: 20,
								loop: solutionBrandsCount > 6,
								speed: solutionBrandsCount > 6 ? 5000 : 0,
								allowTouchMove: true,
								autoplay: solutionBrandsCount > 6 ? {
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
						}
					});
				</script>
			<?php endif; ?>

			<!-- Contact Section -->
			<?php get_template_part( 'template-parts/components/contact-section' ); ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php
endwhile;

get_footer();
