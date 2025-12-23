<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zbeda
 */

?>

<footer id="colophon" class="bg-secondary text-white">
	<!-- Main Footer Content -->
	<div class="container mx-auto px-4 py-12">
		<div class="footer-grid" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>

			<!-- Column 1: Logo -->
			<div class="footer-col">
				<?php if ( has_custom_logo() ) : ?>
					<div class="mb-4">
						<?php the_custom_logo(); ?>
					</div>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold text-primary hover:text-primary/80 transition-colors">
						<?php bloginfo( 'name' ); ?>
					</a>
				<?php endif; ?>
				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description ) :
					?>
					<p class="text-gray-400 mt-2"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
				<!-- Contact Form -->
				<div class="mt-4">
					<?php echo do_shortcode( '[fluentform id="3"]' ); ?>
				</div>
			</div>

			<!-- Column 2: Menu 1 -->
			<div class="footer-col">
				<h3 class="font-bold text-white mb-4"><?php esc_html_e( 'חברות הקבוצה', 'zbeda' ); ?></h3>
				<?php if ( has_nav_menu( 'footer-menu-1' ) ) : ?>
					<nav aria-label="<?php esc_attr_e( 'חברות הקבוצה', 'zbeda' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu-1',
								'menu_class'     => 'footer-menu-list',
								'container'      => false,
								'depth'          => 1,
							)
						);
						?>
					</nav>
				<?php endif; ?>
			</div>

			<!-- Column 3: Menu 2 -->
			<div class="footer-col">
				<h3 class="font-bold text-white mb-4"><?php esc_html_e( 'תחומי פעילות', 'zbeda' ); ?></h3>
				<?php if ( has_nav_menu( 'footer-menu-2' ) ) : ?>
					<nav aria-label="<?php esc_attr_e( 'תחומי פעילות', 'zbeda' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu-2',
								'menu_class'     => 'footer-menu-list',
								'container'      => false,
								'depth'          => 1,
							)
						);
						?>
					</nav>
				<?php endif; ?>
			</div>

			<!-- Column 4: Menu 3 -->
			<div class="footer-col">
				<h3 class="font-bold text-white mb-4"><?php esc_html_e( 'מותגים', 'zbeda' ); ?></h3>
				<?php if ( has_nav_menu( 'footer-menu-3' ) ) : ?>
					<nav aria-label="<?php esc_attr_e( 'מותגים', 'zbeda' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu-3',
								'menu_class'     => 'footer-menu-list',
								'container'      => false,
								'depth'          => 1,
							)
						);
						?>
					</nav>
				<?php endif; ?>
			</div>

		</div>
	</div>

	<!-- Bottom Bar: Accessibility & Copyright -->
	<div class="border-t border-gray-700">
		<div class="container mx-auto px-4 py-6">
			<div class="flex flex-col md:flex-row justify-between items-center gap-4" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>

				<!-- Accessibility Statement -->
				<div class="flex items-center gap-2 text-gray-400">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
						<path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9H15V22H13V16H11V22H9V9H3V7H21V9Z"/>
					</svg>
					<a href="<?php echo esc_url( home_url( '/accessibility' ) ); ?>" class="hover:text-primary transition-colors">
						<?php esc_html_e( 'הצהרת נגישות', 'zbeda' ); ?>
					</a>
				</div>

				<!-- Copyright -->
				<div class="text-gray-400 text-sm">
					<?php
					printf(
						/* translators: %1$s: Current year, %2$s: Site name */
						esc_html__( '© %1$s %2$s. כל הזכויות שמורות.', 'zbeda' ),
						esc_html( date( 'Y' ) ),
						esc_html( get_bloginfo( 'name' ) )
					);
					?>
				</div>

			</div>
		</div>
	</div>

</footer><!-- #colophon -->

<style>
	/* Footer grid layout */
	.footer-grid {
		display: grid;
		grid-template-columns: 1fr;
		gap: 2rem;
	}
	@media (min-width: 768px) {
		.footer-grid {
			grid-template-columns: repeat(2, 1fr);
		}
	}
	@media (min-width: 1024px) {
		.footer-grid {
			grid-template-columns: repeat(4, 1fr);
		}
	}
	.footer-col {
		min-width: 0;
	}
	/* Footer menu styling */
	#colophon .footer-menu-list {
		list-style: none;
		padding: 0;
		margin: 0;
	}
	#colophon .footer-menu-list li {
		margin-bottom: 0.75rem;
	}
	#colophon .footer-menu-list li a {
		color: #d1d5db;
		text-decoration: none;
		transition: color 0.2s ease;
	}
	#colophon .footer-menu-list li a:hover {
		color: var(--wp--preset--color--primary);
	}
	/* Custom logo sizing */
	#colophon .custom-logo {
		max-height: 60px;
		width: auto;
	}
</style>
