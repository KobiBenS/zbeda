<?php
/**
 * Custom Post Types
 *
 * @package zbeda
 */

/**
 * Register ACF fields for Subsidiary post type (if ACF is active).
 */
function zbeda_register_subsidiary_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_subsidiary_details',
			'title'                 => __( 'פרטי חברה', 'zbeda' ),
			'fields'                => array(
				array(
					'key'           => 'field_brand_logo',
					'label'         => __( 'לוגו', 'zbeda' ),
					'name'          => 'brand_logo',
					'type'          => 'image',
					'instructions'  => __( 'העלה את הלוגו', 'zbeda' ),
					'required'      => 0,
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
				),
				array(
					'key'          => 'field_brand_website',
					'label'        => __( 'אתר החברה', 'zbeda' ),
					'name'         => 'brand_website',
					'type'         => 'url',
					'instructions' => __( 'קישור לאתר הרשמי', 'zbeda' ),
					'required'     => 0,
				),
				array(
					'key'          => 'field_brand_description',
					'label'        => __( 'תיאור קצר', 'zbeda' ),
					'name'         => 'brand_description',
					'type'         => 'textarea',
					'instructions' => __( 'תיאור קצר של החברה', 'zbeda' ),
					'required'     => 0,
					'rows'         => 3,
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'subsidiary',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);
}
add_action( 'acf/init', 'zbeda_register_subsidiary_acf_fields' );
