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
			<div class="container mx-auto px-4 py-12">
				<div <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="mb-8">
							<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto rounded-lg shadow-lg' ) ); ?>
						</div>
					<?php endif; ?>

					<div class="prose prose-lg max-w-none">
						<?php the_content(); ?>
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php
endwhile;

get_footer();
