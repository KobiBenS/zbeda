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
						<!-- Contact Button -->
						<a href="#contact-section" class="inline-block mt-6 px-8 py-3 <?php echo $primary_color ? 'brand-custom-primary' : 'bg-primary'; ?> <?php echo $primary_color ? 'text-on-bg' : 'text-secondary'; ?> font-bold rounded-lg hover:opacity-90 transition-opacity">
							<?php esc_html_e( 'צור קשר', 'zbeda' ); ?>
						</a>
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

			<!-- Contact Section -->
			<?php
			get_template_part(
				'template-parts/components/contact-section',
				null,
				array(
					'primary_color'   => $primary_color,
					'secondary_color' => $secondary_color,
				)
			);
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php
endwhile;

get_footer();
