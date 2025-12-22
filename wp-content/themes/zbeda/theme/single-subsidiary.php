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
	$brand_logo  = get_field( 'brand_logo' );
	$brand_url   = get_field( 'brand_website' );
	?>

	<section id="primary">
		<main id="main">

			<!-- Brand Header -->
			<div class="bg-primary border-b border-gray-200">
				<div class="container mx-auto px-4 py-8">
					<div class="flex items-center justify-between" dir="rtl">

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
									<li class="text-gray-900 font-bold">
										<?php echo esc_html( $brand_name ); ?>
									</li>
								</ol>
							</nav>

							<!-- Brand Name -->
							<h1 class="text-3xl md:text-4xl font-bold text-gray-900">
								<?php echo esc_html( $brand_name ); ?>
							</h1>
						</div>

						<!-- Left side: Logo -->
						<div class="flex-shrink-0">
							<?php if ( $brand_logo ) : ?>
								<img
									src="<?php echo esc_url( $brand_logo['url'] ); ?>"
									alt="<?php echo esc_attr( $brand_logo['alt'] ?: $brand_name ); ?>"
									class="h-16 md:h-20 w-auto object-contain"
								>
							<?php elseif ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium', array( 'class' => 'h-16 md:h-20 w-auto object-contain' ) ); ?>
							<?php endif; ?>
						</div>

					</div>
				</div>
			</div>

			<!-- Brand Content -->
			<div class="container mx-auto px-4 py-12">
				<div class="prose prose-lg max-w-none" dir="rtl">
					<?php the_content(); ?>
				</div>

				<?php if ( $brand_url ) : ?>
					<div class="mt-8" dir="rtl">
						<a
							href="<?php echo esc_url( $brand_url ); ?>"
							target="_blank"
							rel="noopener noreferrer"
							class="inline-flex items-center gap-2 bg-amber-400 hover:bg-amber-500 text-gray-900 font-semibold px-6 py-3 rounded-lg transition-colors"
						>
							<?php esc_html_e( 'לאתר המותג', 'zbeda' ); ?>
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-180" viewBox="0 0 20 20" fill="currentColor">
								<path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
							</svg>
						</a>
					</div>
				<?php endif; ?>
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php
endwhile;

get_footer();
