<?php
/**
 * The template for displaying job archive
 *
 * @package zbeda
 */

get_header();
?>

<section id="primary">
	<main id="main">

		<?php if ( have_posts() ) : ?>

			<div class="bg-primary border-b border-gray-200">
				<div class="container mx-auto px-4 py-3">
					<div <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
						<nav class="text-sm text-secondary mb-2" aria-label="Breadcrumb">
							<ol class="flex items-center gap-2">
								<li>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:scale-125" aria-label="<?php esc_attr_e( 'בית', 'zbeda' ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
											<path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
										</svg>
									</a>
								</li>
								<li class="text-secondary">/</li>
								<li class="text-secondary font-bold">
									<?php esc_html_e( 'משרות', 'zbeda' ); ?>
								</li>
							</ol>
						</nav>

						<h1 class="text-3xl md:text-4xl font-bold text-secondary">
							<?php esc_html_e( 'משרות', 'zbeda' ); ?>
						</h1>
					</div>
				</div>
			</div>

			<div class="container mx-auto px-4 py-12">
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
					<?php
					while ( have_posts() ) :
						the_post();

						$job_location = function_exists( 'get_field' ) ? get_field( 'job_location' ) : '';
						?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'group' ); ?>>
							<a href="<?php the_permalink(); ?>" class="block group h-full focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 rounded-lg">
								<div class="rounded-lg overflow-hidden h-full flex flex-col border border-gray-200 shadow-sm transition-shadow duration-300 group-hover:shadow-md">

									<?php
									$job_card_image = zbeda_get_job_display_image( null, 'medium' );
									if ( $job_card_image ) :
										?>
										<div class="aspect-square overflow-hidden flex-shrink-0 bg-gray-100">
											<img src="<?php echo esc_url( $job_card_image['url'] ); ?>" alt="<?php echo esc_attr( $job_card_image['alt'] ); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy" decoding="async" />
										</div>
									<?php endif; ?>

									<div class="bg-white flex flex-col flex-grow p-4 text-center<?php echo $job_card_image ? ' border-t border-gray-100' : ''; ?>" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
										<h2 class="text-secondary font-bold mb-2 text-xl lg:text-2xl">
											<?php the_title(); ?>
										</h2>

										<?php if ( has_excerpt() || get_the_excerpt() ) : ?>
											<p class="text-secondary text-sm mb-3 line-clamp-3 grow">
												<?php echo esc_html( get_the_excerpt() ); ?>
											</p>
										<?php endif; ?>

										<?php if ( $job_location ) : ?>
											<p class="text-secondary text-sm font-semibold mb-1">
												<?php echo esc_html( $job_location ); ?>
											</p>
										<?php endif; ?>
									</div>

									<div class="bg-primary w-full py-3 px-4 text-center">
										<span class="text-secondary text-base font-semibold inline-block w-full">
											<?php esc_html_e( 'לפרטים נוספים', 'zbeda' ); ?>
										</span>
									</div>
								</div>
							</a>
						</article>

						<?php
					endwhile;
					?>
				</div>

				<div class="mt-12">
					<?php zbeda_the_posts_navigation(); ?>
				</div>
			</div>

		<?php else : ?>

			<div class="container mx-auto px-4 py-12">
				<div class="text-center" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
					<p class="text-xl text-gray-600">
						<?php esc_html_e( 'לא נמצאו משרות.', 'zbeda' ); ?>
					</p>
				</div>
			</div>

		<?php endif; ?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
