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
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

	</div>
</header><!-- #masthead -->

<style>
/* Desktop Dropdown Styles */
#primary-menu {
	position: relative;
}

#primary-menu > li {
	position: relative;
}

#primary-menu > li > a {
	display: flex;
	align-items: center;
	gap: 0.25rem;
	color: white;
	font-size: 0.875rem;
	transition: color 0.2s;
	padding: 0.5rem 0;
}

#primary-menu > li > a:hover {
	color: #fbbf24;
}

/* Dropdown arrow for parent items */
#primary-menu > li.menu-item-has-children > a::after {
	content: '';
	display: inline-block;
	width: 0;
	height: 0;
	border-left: 4px solid transparent;
	border-right: 4px solid transparent;
	border-top: 4px solid currentColor;
	margin-<?php echo is_rtl() ? 'right' : 'left'; ?>: 0.25rem;
}

/* Submenu styles */
#primary-menu .sub-menu {
	display: none;
	position: absolute;
	top: 100%;
	<?php echo is_rtl() ? 'right' : 'left'; ?>: 0;
	background-color: #1f2937;
	min-width: 200px;
	border-radius: 0.375rem;
	box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
	padding: 0.5rem 0;
	z-index: 50;
	margin-top: 0.25rem;
}

#primary-menu li:hover > .sub-menu {
	display: block;
}

#primary-menu .sub-menu li {
	width: 100%;
}

#primary-menu .sub-menu a {
	display: block;
	padding: 0.5rem 1rem;
	color: white;
	font-size: 0.875rem;
	transition: all 0.2s;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

#primary-menu .sub-menu a:hover {
	background-color: #374151;
	color: #fbbf24;
}

/* Mobile Menu Styles */
#mobile-primary-menu li {
	width: 100%;
}

#mobile-primary-menu > li > a {
	display: block;
	color: white;
	font-size: 0.875rem;
	padding: 0.5rem 0;
	transition: color 0.2s;
}

#mobile-primary-menu > li > a:hover {
	color: #fbbf24;
}

#mobile-primary-menu .sub-menu {
	display: none;
	padding-<?php echo is_rtl() ? 'right' : 'left'; ?>: 1rem;
	margin-top: 0.5rem;
}

#mobile-primary-menu .menu-item-has-children.open > .sub-menu {
	display: block;
}

#mobile-primary-menu .sub-menu a {
	display: block;
	color: #d1d5db;
	font-size: 0.8125rem;
	padding: 0.375rem 0;
	transition: color 0.2s;
}

#mobile-primary-menu .sub-menu a:hover {
	color: #fbbf24;
}

/* Mobile dropdown toggle button */
#mobile-primary-menu .menu-item-has-children > a {
	display: flex;
	align-items: center;
	justify-content: space-between;
}

#mobile-primary-menu .menu-item-has-children > a::after {
	content: '';
	display: inline-block;
	width: 0;
	height: 0;
	border-left: 4px solid transparent;
	border-right: 4px solid transparent;
	border-top: 4px solid currentColor;
	transition: transform 0.2s;
}

#mobile-primary-menu .menu-item-has-children.open > a::after {
	transform: rotate(180deg);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
	// Mobile menu toggle
	const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
	const mobileMenu = document.getElementById('mobile-menu');

	if (mobileMenuToggle && mobileMenu) {
		mobileMenuToggle.addEventListener('click', function() {
			const isExpanded = mobileMenuToggle.getAttribute('aria-expanded') === 'true';
			mobileMenuToggle.setAttribute('aria-expanded', !isExpanded);
			mobileMenu.classList.toggle('hidden');
		});
	}

	// Mobile submenu toggle
	const mobileMenuItems = document.querySelectorAll('#mobile-primary-menu .menu-item-has-children');
	mobileMenuItems.forEach(item => {
		const link = item.querySelector('a');
		if (link) {
			link.addEventListener('click', function(e) {
				// Only prevent default if clicking on parent item (not actual navigation)
				if (item.querySelector('.sub-menu')) {
					e.preventDefault();
					item.classList.toggle('open');
				}
			});
		}
	});
});
</script>
