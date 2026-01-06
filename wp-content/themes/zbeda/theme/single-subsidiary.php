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

			<!-- Grid Section -->
			<?php get_template_part( 'template-parts/components/grid-section' ); ?>

		<!-- Solutions Section -->
		<?php
		// Get solutions from ACF field
		$solutions_raw = get_field( 'solutions' );

		// Normalize to array (handle single object, array of objects, or array of IDs)
		$solutions = array();
		if ( $solutions_raw ) {
			if ( is_array( $solutions_raw ) ) {
				$solutions = $solutions_raw;
			} else {
				$solutions = array( $solutions_raw );
			}
		}

		// Filter out any empty values
		$solutions = array_filter( $solutions );

		if ( ! empty( $solutions ) ) :
			?>
			<div class="bg-white py-16">
				<div class="container mx-auto px-4">
					<!-- Section Title -->
					<h2 class="text-3xl md:text-4xl font-bold text-center text-secondary mb-12" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
						<?php esc_html_e( 'תחומי פעילות', 'zbeda' ); ?>
					</h2>

					<!-- Solutions Grid -->
					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
						<?php foreach ( $solutions as $solution ) :
							$solution_id = is_object( $solution ) ? $solution->ID : $solution;
							?>
							<article id="solution-<?php echo esc_attr( $solution_id ); ?>" class="group">
								<a href="<?php echo esc_url( get_permalink( $solution_id ) ); ?>" class="block group">
									<div class="bg-primary rounded-lg overflow-hidden">
										<?php if ( has_post_thumbnail( $solution_id ) ) : ?>
											<div class="aspect-square overflow-hidden">
												<?php echo get_the_post_thumbnail( $solution_id, 'medium', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300' ) ); ?>
											</div>
										<?php endif; ?>
										<div class="p-4 text-center" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
											<h3 class="text-secondary font-bold mb-2 text-xl lg:text-2xl"><?php echo esc_html( get_the_title( $solution_id ) ); ?></h3>
											<span class="text-secondary text-md font-semibold">
												<?php esc_html_e( 'למד עוד', 'zbeda' ); ?>
											</span>
										</div>
									</div>
								</a>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<!-- Brands Section -->
		<!-- Section Title -->
		<div class="bg-gray-100 py-16">
			<div class="container mx-auto px-4">
				<h2 class="text-3xl md:text-4xl font-bold text-center text-secondary mb-12" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
					<?php esc_html_e( 'השותפים שלנו – המותגים שמניעים את הענף', 'zbeda' ); ?>
				</h2>
			</div>
			<?php get_template_part( 'template-parts/components/grid-brands' ); ?>
		</div>

		
			<!-- Contact Section -->
			<?php get_template_part( 'template-parts/components/contact-section' ); ?>


	</main><!-- #main -->
	</section><!-- #primary -->

	<?php
endwhile;

get_footer();
