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
			// Get brands from ACF field
			$brands_raw = get_field( 'brands' );
			
			// Normalize to array (handle single object, array of objects, or array of IDs)
			$brands = array();
			if ( $brands_raw ) {
				if ( is_array( $brands_raw ) ) {
					$brands = $brands_raw;
				} else {
					$brands = array( $brands_raw );
				}
			}
			
			// Filter out any empty values
			$brands = array_filter( $brands );
			
			if ( ! empty( $brands ) ) :
				?>
				<!-- Section Title -->
				<div class="bg-gray-100 py-16">
					<div class="container mx-auto px-4">
						<h2 class="text-3xl md:text-4xl font-bold text-center text-secondary mb-12" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
							<?php esc_html_e( 'השותפים שלנו – המותגים שמניעים את הענף', 'zbeda' ); ?>
						</h2>
					</div>
					<?php get_template_part( 'template-parts/components/grid-brands' ); ?>
				</div>
			<?php endif; ?>

			



		</main><!-- #main -->
	</section><!-- #primary -->

	<?php
endwhile;

get_footer();
