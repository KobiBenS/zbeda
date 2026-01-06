<?php
/**
 * The template for displaying brand archive
 *
 * @package zbeda
 */

get_header();
?>

<section id="primary">
	<main id="main">

		<?php if ( have_posts() ) : ?>

			<!-- Page Header -->
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
								<li class="text-secondary font-bold">
									<?php esc_html_e( 'מותגים', 'zbeda' ); ?>
								</li>
							</ol>
						</nav>

						<!-- Page Title -->
						<h1 class="text-3xl md:text-4xl font-bold text-secondary">
							<?php esc_html_e( 'מותגים', 'zbeda' ); ?>
						</h1>
					</div>
				</div>
			</div>

			<!-- Brands Grid -->
			<div class="container mx-auto px-4 py-12">
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
					<?php
					// Start the Loop.
					while ( have_posts() ) :
						the_post();
						?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'group' ); ?>>
							<div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">

								<!-- Logo -->
								<?php
								$logo_url = get_field( 'main_image' ) ?: get_the_post_thumbnail_url( get_the_ID(), 'medium' );
								if ( $logo_url ) :
									?>
									<div class="relative overflow-hidden bg-gray-50 flex items-center justify-center aspect-[16/9]">
										<a href="<?php the_permalink(); ?>" class="block h-full w-full">
											<img
												src="<?php echo esc_url( $logo_url ); ?>"
												alt="<?php echo esc_attr( get_the_title() ); ?>"
												class="mx-auto max-w-full max-h-full h-full object-contain object-center group-hover:scale-105 transition-transform duration-300"
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

									<!-- Read More Link (WPML-ready) -->
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

						<?php
					endwhile;
					?>
				</div>

				<!-- Pagination -->
				<div class="mt-12">
					<?php zbeda_the_posts_navigation(); ?>
				</div>
			</div>

		<?php else : ?>

			<!-- No Brands Found -->
			<div class="container mx-auto px-4 py-12">
				<div class="text-center" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
					<p class="text-xl text-gray-600">
						<?php esc_html_e( 'לא נמצאו מותגים.', 'zbeda' ); ?>
					</p>
				</div>
			</div>

		<?php endif; ?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
