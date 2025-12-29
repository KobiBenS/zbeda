<?php
/**
 * Template Name: About Us
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
			?>

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
									<?php the_title(); ?>
								</li>
							</ol>
						</nav>

						<!-- Page Title -->
						<h1 class="text-3xl md:text-4xl font-bold text-secondary">
							<?php the_title(); ?>
						</h1>
					</div>
				</div>
			</div>

			<!-- Content Sections -->
			<?php
			// Get section 1 fields
			$section_1_title   = get_field( 'section_1_title' );
			$section_1_content = get_field( 'section_1_content' );
			$section_1_image   = get_field( 'section_1_image' );
			$section_1_video   = get_field( 'section_1_video' );

			// Get section 2 fields
			$section_2_title   = get_field( 'section_2_title' );
			$section_2_content = get_field( 'section_2_content' );
			$section_2_image   = get_field( 'section_2_image' );
			$section_2_video   = get_field( 'section_2_video' );
			?>

			<!-- Section 1 - Media on Right -->
			<?php if ( $section_1_content || $section_1_image || $section_1_video ) : ?>
				<div class="bg-white py-16">
					<div class="container mx-auto px-4">
						<div class="flex flex-col md:flex-row gap-8 items-center" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
							<!-- Content -->
							<div class="md:w-1/2">
								<?php if ( $section_1_title ) : ?>
									<h2 class="text-3xl md:text-4xl font-bold text-secondary mb-2">
										<?php echo esc_html( $section_1_title ); ?>
									</h2>
									<div class="w-24 h-1 bg-primary mb-6"></div>
								<?php endif; ?>
								<div class="prose prose-lg max-w-none">
									<?php echo wp_kses_post( $section_1_content ); ?>
								</div>
							</div>

							<!-- Media (Video or Image) -->
							<div class="md:w-1/2">
								<?php if ( $section_1_video ) : ?>
									<video
										class="w-full h-auto rounded-lg shadow-lg"
										autoplay
										muted
										loop
										playsinline
									>
										<source src="<?php echo esc_url( $section_1_video['url'] ); ?>" type="<?php echo esc_attr( $section_1_video['mime_type'] ); ?>">
										<?php esc_html_e( 'הדפדפן שלך אינו תומך בתג וידאו.', 'zbeda' ); ?>
									</video>
								<?php elseif ( $section_1_image ) : ?>
									<img
										src="<?php echo esc_url( $section_1_image['url'] ); ?>"
										alt="<?php echo esc_attr( $section_1_image['alt'] ?: $section_1_title ); ?>"
										class="w-full h-auto rounded-lg shadow-lg"
									>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<!-- Section 2 - Media on Left -->
			<?php if ( $section_2_content || $section_2_image || $section_2_video ) : ?>
				<div class="py-16">
					<div class="container mx-auto px-4">
						<div class="flex flex-col md:flex-row-reverse gap-8 items-center" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
							<!-- Content -->
							<div class="md:w-1/2">
								<?php if ( $section_2_title ) : ?>
									<h2 class="text-3xl md:text-4xl font-bold text-secondary mb-2">
										<?php echo esc_html( $section_2_title ); ?>
									</h2>
									<div class="w-24 h-1 bg-primary mb-6"></div>
								<?php endif; ?>
								<div class="prose prose-lg max-w-none">
									<?php echo wp_kses_post( $section_2_content ); ?>
								</div>
							</div>

							<!-- Media (Video or Image) -->
							<div class="md:w-1/2">
								<?php if ( $section_2_video ) : ?>
									<video
										class="w-full h-auto rounded-lg shadow-lg"
										autoplay
										muted
										loop
										playsinline
									>
										<source src="<?php echo esc_url( $section_2_video['url'] ); ?>" type="<?php echo esc_attr( $section_2_video['mime_type'] ); ?>">
										<?php esc_html_e( 'הדפדפן שלך אינו תומך בתג וידאו.', 'zbeda' ); ?>
									</video>
								<?php elseif ( $section_2_image ) : ?>
									<img
										src="<?php echo esc_url( $section_2_image['url'] ); ?>"
										alt="<?php echo esc_attr( $section_2_image['alt'] ?: $section_2_title ); ?>"
										class="w-full h-auto rounded-lg shadow-lg"
									>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<!-- Team Section -->
			<?php
			$team_members = new WP_Query(
				array(
					'post_type'      => 'team',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				)
			);

			if ( $team_members->have_posts() ) :
				?>
				<div class="bg-gray-50 py-16">
					<div class="container mx-auto px-4">
						<!-- Section Title -->
						<div class="text-center mb-12" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
							<h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">
								<?php esc_html_e( 'הצוות שלנו', 'zbeda' ); ?>
							</h2>
							<div class="w-24 h-1 bg-primary mx-auto"></div>
						</div>

						<!-- Team Grid -->
						<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
							<?php
							while ( $team_members->have_posts() ) :
								$team_members->the_post();
								$contact_email = get_field( 'contact_email' );
								$contact_phone = get_field( 'contact_phone' );

								// Fallback to defaults if empty
								if ( empty( $contact_email ) ) {
									$contact_email = 'main@zbeda.com';
								}
								if ( empty( $contact_phone ) ) {
									$contact_phone = '037610001';
								}
								?>

								<article class="group bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
									<!-- Photo -->
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="relative overflow-hidden aspect-square">
											<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300' ) ); ?>
											<div class="absolute inset-0 bg-gradient-to-t from-gray-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
										</div>
									<?php else : ?>
										<div class="aspect-square bg-gray-200 flex items-center justify-center">
											<svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
											</svg>
										</div>
									<?php endif; ?>

									<!-- Content -->
									<div class="p-6">
										<!-- Name -->
										<h3 class="text-xl font-bold text-secondary mb-2 group-hover:text-primary transition-colors">
											<?php the_title(); ?>
										</h3>

										<!-- Description -->
										<?php if ( has_excerpt() || get_the_content() ) : ?>
											<div class="text-gray-600 mb-4 text-sm line-clamp-3">
												<?php
												if ( has_excerpt() ) {
													the_excerpt();
												} else {
													echo wp_kses_post( wp_trim_words( get_the_content(), 15, '...' ) );
												}
												?>
											</div>
										<?php endif; ?>

										<!-- Contact Info -->
										<div class="space-y-2 border-t border-gray-100 pt-4">
											<!-- Email -->
											<div class="flex items-center gap-2 text-sm">
												<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
													<path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
													<path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
												</svg>
												<a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="text-gray-700 hover:text-primary transition-colors truncate">
													<?php echo esc_html( $contact_email ); ?>
												</a>
											</div>

											<!-- Phone -->
											<div class="flex items-center gap-2 text-sm">
												<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
													<path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
												</svg>
												<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>" class="text-gray-700 hover:text-primary transition-colors">
													<?php echo esc_html( $contact_phone ); ?>
												</a>
											</div>
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

			<!-- Values/Mission Section -->
			<?php
			// Get values from ACF fields with fallbacks
			$values_section_title = get_field( 'values_section_title' ) ?: 'הערכים שלנו';
			$value_1_title = get_field( 'value_1_title' ) ?: 'מקצועיות';
			$value_1_text  = get_field( 'value_1_text' ) ?: 'צוות מקצועי ומנוסה המתמחה בפתרונות איכותיים';
			$value_2_title = get_field( 'value_2_title' ) ?: 'חדשנות';
			$value_2_text  = get_field( 'value_2_text' ) ?: 'פתרונות חדשניים המותאמים לצרכי השוק המודרני';
			$value_3_title = get_field( 'value_3_title' ) ?: 'שירות';
			$value_3_text  = get_field( 'value_3_text' ) ?: 'שירות אישי ומסור ללקוחותינו בכל שלב';
			?>
			<div class="bg-secondary text-white py-16">
				<div class="container mx-auto px-4" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
					<!-- Section Title -->
					<div class="text-center mb-12">
						<h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
							<?php echo esc_html( $values_section_title ); ?>
						</h2>
						<div class="w-24 h-1 bg-primary mx-auto"></div>
					</div>

					<!-- Values Row -->
					<div class="flex flex-col md:flex-row gap-8 md:gap-12 items-stretch">
						<!-- Value 1 -->
						<div class="text-center flex-1">
							<div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-full mb-4">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
								</svg>
							</div>
							<h3 class="text-xl font-bold mb-2 text-primary">
								<?php echo esc_html( $value_1_title ); ?>
							</h3>
							<p class="text-gray-300">
								<?php echo esc_html( $value_1_text ); ?>
							</p>
						</div>

						<!-- Value 2 -->
						<div class="text-center flex-1">
							<div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-full mb-4">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
								</svg>
							</div>
							<h3 class="text-xl font-bold mb-2 text-primary">
								<?php echo esc_html( $value_2_title ); ?>
							</h3>
							<p class="text-gray-300">
								<?php echo esc_html( $value_2_text ); ?>
							</p>
						</div>

						<!-- Value 3 -->
						<div class="text-center flex-1">
							<div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-full mb-4">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
								</svg>
							</div>
							<h3 class="text-xl font-bold mb-2 text-primary">
								<?php echo esc_html( $value_3_title ); ?>
							</h3>
							<p class="text-gray-300">
								<?php echo esc_html( $value_3_text ); ?>
							</p>
						</div>
					</div>
				</div>
			</div>

			<!-- Contact Section -->
			<?php get_template_part( 'template-parts/components/contact-section' ); ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
