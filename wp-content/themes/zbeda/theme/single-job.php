<?php
/**
 * The template for displaying single job posts
 *
 * @package zbeda
 */

get_header();

while ( have_posts() ) :
	the_post();

	$job_sku      = function_exists( 'get_field' ) ? get_field( 'job_sku' ) : '';
	$job_location = function_exists( 'get_field' ) ? get_field( 'job_location' ) : '';
	$form_short   = function_exists( 'get_field' ) ? get_field( 'jobs_application_form_shortcode', 'option' ) : '';
	$job_image    = zbeda_get_job_display_image( null, 'large' );
	?>

	<section id="primary">
		<main id="main">

			<div class="bg-primary border-b border-gray-200">
				<div class="container mx-auto px-4 py-3">
					<div <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
						<nav class="text-sm text-secondary" aria-label="Breadcrumb">
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
									<a href="<?php echo esc_url( get_post_type_archive_link( 'job' ) ); ?>" class="hover:text-amber-500 transition-colors">
										<?php esc_html_e( 'משרות', 'zbeda' ); ?>
									</a>
								</li>
								<li class="text-secondary">/</li>
								<li class="text-secondary font-bold">
									<?php the_title(); ?>
								</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>

			<div class="container mx-auto px-4 pt-12 pb-12">
				<div class="flex flex-col md:flex-row gap-8 items-start">
					<div class="<?php echo $job_image ? 'md:w-3/5' : 'w-full'; ?>" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
						<h1 class="text-3xl md:text-4xl font-bold text-secondary <?php echo ( $job_sku || $job_location ) ? 'mb-4' : 'mb-8'; ?>">
							<?php the_title(); ?>
						</h1>
						<?php if ( $job_sku || $job_location ) : ?>
							<ul class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-secondary font-medium mb-8">
								<?php if ( $job_sku ) : ?>
									<li>
										<span class="opacity-80"><?php esc_html_e( 'מק״ט:', 'zbeda' ); ?></span>
										<?php echo esc_html( $job_sku ); ?>
									</li>
								<?php endif; ?>
								<?php if ( $job_location ) : ?>
									<li>
										<span class="opacity-80"><?php esc_html_e( 'מיקום:', 'zbeda' ); ?></span>
										<?php echo esc_html( $job_location ); ?>
									</li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
						<div class="prose prose-lg max-w-none">
							<?php the_content(); ?>
						</div>
					</div>
					<?php if ( $job_image ) : ?>
						<div class="md:w-2/5 flex-shrink-0 w-full">
							<img src="<?php echo esc_url( $job_image['url'] ); ?>" alt="<?php echo esc_attr( $job_image['alt'] ); ?>" class="w-full h-auto rounded-lg shadow-lg" loading="lazy" decoding="async" />
						</div>
					<?php endif; ?>
				</div>
			</div>

			<?php if ( is_string( $form_short ) && $form_short !== '' ) : ?>
				<div class="bg-gray-100 border-t border-gray-200 py-16">
					<div class="container mx-auto px-4 max-w-3xl" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
						<div class="bg-white border border-gray-200 rounded-lg px-6 py-10 md:px-10 md:py-12 shadow-sm">
							<h2 class="text-2xl md:text-3xl font-bold text-secondary mb-8 text-center">
								<?php esc_html_e( 'שלחו קורות חיים', 'zbeda' ); ?>
							</h2>
							<div class="job-application-form prose max-w-none">
								<?php echo do_shortcode( $form_short ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- shortcode output from trusted shortcodes ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php
endwhile;

get_footer();
