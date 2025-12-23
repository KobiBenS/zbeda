<?php
/**
 * Template part for displaying the contact section
 *
 * Reusable component that shows a map and contact information.
 * Uses ACF fields 'contact_number' and 'contact_email' if available,
 * otherwise falls back to default values.
 *
 * @package zbeda
 */

// Get contact info from ACF fields or use defaults
$contact_number = get_field( 'contact_number' );
$contact_email  = get_field( 'contact_email' );

// Fallback to defaults if not set
if ( empty( $contact_number ) ) {
	$contact_number = '972-3-761-0001';
}
if ( empty( $contact_email ) ) {
	$contact_email = 'main@zbeda.com';
}

// Default map location (can be customized via ACF field 'map_embed' if needed)
$map_embed = get_field( 'map_embed' );
if ( empty( $map_embed ) ) {
	// Default Google Maps embed for Zbeda location (with pin, zoomed out, no info card)
	$map_embed = 'https://maps.google.com/maps?q=32.107293,34.956379&t=&z=14&ie=UTF8&iwloc=B&output=embed';
}
?>

<section id="contact-section" class="contact-section bg-gray-100 py-16">
	<div class="container mx-auto px-4">
		<div class="contact-grid" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>

			<!-- Map Column (2/3) -->
			<div class="contact-map">
				<div class="w-full h-full min-h-[400px] rounded-lg overflow-hidden shadow-lg">
					<iframe
						src="<?php echo esc_url( $map_embed ); ?>"
						width="100%"
						height="100%"
						style="border:0; min-height: 400px;"
						allowfullscreen=""
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"
						title="<?php esc_attr_e( 'מפת מיקום', 'zbeda' ); ?>"
					></iframe>
				</div>
			</div>

			<!-- Contact Info Column (1/3) -->
			<div class="contact-info bg-white rounded-lg p-8">
				<!-- Title -->
				<h2 class="text-2xl md:text-3xl font-bold text-secondary mb-6">
					<?php esc_html_e( 'צור קשר', 'zbeda' ); ?>
				</h2>

				<!-- Phone -->
				<div class="flex items-center gap-3 mb-4">
					<div class="contact-icon-circle">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" viewBox="0 0 20 20" fill="currentColor">
							<path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
						</svg>
					</div>
					<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_number ) ); ?>" class="text-secondary hover:text-primary transition-colors font-medium">
						<?php echo esc_html( $contact_number ); ?>
					</a>
				</div>

				<!-- Email -->
				<div class="flex items-center gap-3 mb-8">
					<div class="contact-icon-circle">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" viewBox="0 0 20 20" fill="currentColor">
							<path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
							<path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
						</svg>
					</div>
					<a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="text-secondary hover:text-primary transition-colors font-medium">
						<?php echo esc_html( $contact_email ); ?>
					</a>
				</div>

				<!-- Contact Form -->
				<div class="contact-form">
					<?php echo do_shortcode( '[fluentform id="3"]' ); ?>
				</div>
			</div>

		</div>
	</div>
</section>

<style>
	/* Smooth scroll behavior */
	html {
		scroll-behavior: smooth;
	}
	/* Rounded icon circles */
	.contact-icon-circle {
		width: 40px;
		height: 40px;
		min-width: 40px;
		min-height: 40px;
		background-color: var(--wp--preset--color--primary);
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.contact-grid {
		display: grid;
		grid-template-columns: 1fr;
		gap: 2rem;
	}
	@media (min-width: 1024px) {
		.contact-grid {
			grid-template-columns: 2fr 1fr;
		}
	}
	.contact-map {
		order: 2;
	}
	.contact-info {
		order: 1;
	}
	@media (min-width: 1024px) {
		.contact-map {
			order: 1;
		}
		.contact-info {
			order: 2;
		}
	}
	/* RTL support - swap order */
	[dir="rtl"] .contact-map {
		order: 2;
	}
	[dir="rtl"] .contact-info {
		order: 1;
	}
	@media (min-width: 1024px) {
		[dir="rtl"] .contact-map {
			order: 2;
		}
		[dir="rtl"] .contact-info {
			order: 1;
		}
	}
</style>
