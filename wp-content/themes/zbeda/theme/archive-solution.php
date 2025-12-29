<?php
/**
 * The template for displaying solution archive
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
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:scale-125" aria-label="<?php esc_attr_e( 'בית', 'zbeda' ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
											<path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
										</svg>
									</a>
								</li>
								<li class="text-secondary">/</li>
								<li class="text-secondary font-bold">
									<?php esc_html_e( 'תחומי פעילות', 'zbeda' ); ?>
								</li>
							</ol>
						</nav>

						<!-- Page Title -->
						<h1 class="text-3xl md:text-4xl font-bold text-secondary">
							<?php esc_html_e( 'תחומי פעילות', 'zbeda' ); ?>
						</h1>
					</div>
				</div>
			</div>

			<!-- Solutions Grid -->
			<div class="container mx-auto px-4 py-12">
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
					<?php
					// Start the Loop.
					while ( have_posts() ) :
						the_post();
						?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'group' ); ?>>
							<a href="<?php the_permalink(); ?>" class="block">
								<div class="bg-secondary rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">

									<!-- Featured Image -->
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="aspect-square overflow-hidden">
											<?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300' ) ); ?>
										</div>
									<?php endif; ?>

									<!-- Content -->
									<div class="p-6 text-center" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
										<!-- Title -->
										<h2 class="text-xl font-bold text-white mb-2">
											<?php the_title(); ?>
										</h2>

										<!-- Read More -->
										<span class="text-primary text-sm font-semibold">
											<?php esc_html_e( 'למד עוד', 'zbeda' ); ?>
										</span>
									</div>
								</div>
							</a>
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

			<!-- No Solutions Found -->
			<div class="container mx-auto px-4 py-12">
				<div class="text-center" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
					<p class="text-xl text-gray-600">
						<?php esc_html_e( 'לא נמצאו תחומי פעילות.', 'zbeda' ); ?>
					</p>
				</div>
			</div>

		<?php endif; ?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
