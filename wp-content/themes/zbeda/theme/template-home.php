<?php
/**
 * Template Name: Home Page
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

			// Get hero fields
			$hero_bg_type    = get_field( 'hero_background_type' );
			$hero_bg_image   = get_field( 'hero_background_image' );
			$hero_bg_video   = get_field( 'hero_background_video' );
			$hero_headline   = get_field( 'hero_headline' );
			$hero_subheadline = get_field( 'hero_subheadline' );
			$hero_cta_text   = get_field( 'hero_cta_text' );
			$hero_cta_link   = get_field( 'hero_cta_link' );

			?>

			<!-- Hero Section -->
			<div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gray-900">
				<!-- Background -->
				<?php if ( $hero_bg_type === 'video' && $hero_bg_video ) : ?>
					<video
						id="hero-video"
						class="absolute inset-0 w-full h-full object-cover z-0"
						autoplay
						muted
						loop
						playsinline
						preload="metadata"
						<?php if ( $hero_bg_image ) : ?>
							poster="<?php echo esc_url( $hero_bg_image ); ?>"
						<?php endif; ?>
					>
						<source src="<?php echo esc_url( $hero_bg_video['url'] ); ?>" type="video/mp4">
						<!-- Fallback image if video fails -->
						<?php if ( $hero_bg_image ) : ?>
							<img src="<?php echo esc_url( $hero_bg_image ); ?>" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover">
						<?php endif; ?>
					</video>
				<?php elseif ( $hero_bg_image ) : ?>
					<img
						src="<?php echo esc_url( $hero_bg_image ); ?>"
						alt="Hero Background"
						class="absolute inset-0 w-full h-full object-cover z-0"
					>
				<?php endif; ?>

				<!-- Overlay -->
				<div class="absolute inset-0 bg-black/20 z-10"></div>

				<!-- Content -->
				<div class="relative z-20 container mx-auto p-4 text-center bg-black/20 backdrop-blur-xl w-fit rounded-lg" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
					<?php if ( $hero_headline ) : ?>
						<h1 class="text-4xl md:text-6xl font-bold text-primary mb-6">
							<?php echo esc_html( $hero_headline ); ?>
						</h1>
					<?php endif; ?>

					<?php if ( $hero_subheadline ) : ?>
						<p class="text-xl md:text-2xl text-primary max-w-3xl mx-auto">
							<?php echo esc_html( $hero_subheadline ); ?>
						</p>
					<?php endif; ?>

					<?php if ( $hero_cta_text && $hero_cta_link ) : ?>
						<a href="<?php echo esc_url( $hero_cta_link ); ?>" class="inline-block px-8 py-4 bg-primary text-secondary font-bold text-lg rounded-lg hover:bg-primary/90 transition-colors">
							<?php echo esc_html( $hero_cta_text ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<!-- Grid Section -->
			<?php get_template_part( 'template-parts/components/grid-section' ); ?>

			<!-- Subsidiaries Section -->
			<!-- Section Title -->
			<div class="bg-white py-16 border-t-1 border-secondary">
				<div class="container mx-auto px-4">
					<div class="text-center mb-12" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
						<h2 class="text-3xl md:text-4xl font-bold text-secondary mb-4">
							<?php esc_html_e( 'חברות הקבוצה', 'zbeda' ); ?>
						</h2>
						<div class="w-24 h-1 bg-primary mx-auto"></div>
					</div>
				</div>
			

			<?php get_template_part( 'template-parts/components/grid-subsidiaries' ); ?>
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

			

			<!-- Contact Section -->
			<?php get_template_part( 'template-parts/components/contact-section' ); ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</section><!-- #primary -->

<!-- Hero Video Autoplay Script -->
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const heroVideo = document.getElementById('hero-video');
		if (heroVideo) {
			// Log video state
			console.log('Video element found');
			console.log('Video ready state:', heroVideo.readyState);
			console.log('Video paused:', heroVideo.paused);

			// Listen for various video events
			heroVideo.addEventListener('loadedmetadata', function() {
				console.log('Video metadata loaded');
			});

			heroVideo.addEventListener('loadeddata', function() {
				console.log('Video data loaded');
			});

			heroVideo.addEventListener('canplay', function() {
				console.log('Video can play');
				heroVideo.play().catch(function(error) {
					console.error('Play failed:', error);
				});
			});

			heroVideo.addEventListener('error', function(e) {
				console.error('Video error:', e);
				console.error('Video error code:', heroVideo.error);
			});

			// Force play immediately
			const playPromise = heroVideo.play();
			if (playPromise !== undefined) {
				playPromise.then(function() {
					console.log('Video playing successfully');
				}).catch(function(error) {
					console.error('Autoplay failed:', error);

					// Retry on user interaction
					document.addEventListener('click', function() {
						heroVideo.play().then(function() {
							console.log('Video playing after user interaction');
						}).catch(function(err) {
							console.error('Play after click failed:', err);
						});
					}, { once: true });
				});
			}
		} else {
			console.log('Video element not found');
		}
	});
</script>

<?php
get_footer();
