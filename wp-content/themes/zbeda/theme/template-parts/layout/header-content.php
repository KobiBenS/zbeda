<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zbeda
 */

?>

<header id="masthead" class="bg-gray-900 border-b-4 border-amber-400">
	<div class="container mx-auto px-4">
		<div class="flex items-center justify-start h-16 gap-4" dir="rtl">

			<!-- Logo -->
			<div class="flex items-center">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="flex items-center gap-2">
					<?php
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
					if ( $logo ) :
						?>
						<img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="h-10 w-auto">
					<?php else : ?>
						<span class="text-white text-xl font-bold"><?php bloginfo( 'name' ); ?></span>
					<?php endif; ?>
				</a>
			</div>

			<!-- Navigation -->
			<nav id="site-navigation" class="hidden md:flex items-center gap-2" aria-label="<?php esc_attr_e( 'Main Navigation', 'zbeda' ); ?>">
				<!-- Home Icon -->
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-amber-400 hover:text-amber-300 transition-colors" aria-label="<?php esc_attr_e( 'Home', 'zbeda' ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
						<path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
					</svg>
				</a>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'items_wrap'     => '<ul id="%1$s" class="%2$s flex items-center gap-6">%3$s</ul>',
						'link_before'    => '<span class="text-white hover:text-amber-400 transition-colors text-sm">',
						'link_after'     => '</span>',
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

			<!-- Mobile Menu Button -->
			<button
				id="mobile-menu-toggle"
				class="md:hidden text-white hover:text-amber-400 transition-colors"
				aria-controls="mobile-menu"
				aria-expanded="false"
			>
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
				</svg>
				<span class="sr-only"><?php esc_html_e( 'Menu', 'zbeda' ); ?></span>
			</button>

		</div>

		<!-- Mobile Menu -->
		<nav id="mobile-menu" class="hidden md:hidden pb-4" dir="rtl">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'mobile-primary-menu',
					'container'      => false,
					'items_wrap'     => '<ul id="%1$s" class="%2$s flex flex-col gap-2">%3$s</ul>',
					'link_before'    => '<span class="text-white hover:text-amber-400 transition-colors text-sm block py-2">',
					'link_after'     => '</span>',
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

	</div>
</header><!-- #masthead -->
