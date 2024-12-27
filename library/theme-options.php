<?php
/**
 * Set up the default theme options
 *
 * @param string $name  The option name
 *
 * @since Jacqui 0.1
 */
function jacqui_theme_options() {
    //delete_option( 'jacqui_theme_options' );
    $default_theme_options = array(
        'width'      => 'w960',
        'layout'     => '2',
        'primary'    => 'c8',
        'link_color' => '#336699'
        );
    return get_option( 'jacqui_theme_options', $default_theme_options );
}

class jacqui_Customizer {
    public function __construct() {
        add_action( 'customize_register', array( $this, 'customize_register' ) );
    }

     public function customize_register( $wp_customize ) {
        $jacqui_theme_options = jacqui_theme_options();

            $wp_customize->add_section( 'jacqui_layout', array(
                'title' => __( 'Layout', 'jacqui' ),
                'priority' => 35,
            ) );

            $wp_customize->add_setting( 'jacqui_theme_options[width]', array(
                'default'    => $jacqui_theme_options['width'],
                'type'       => 'option',
                'sanitize_callback' => 'jacqui_sanitize_html',
                'capability' => 'edit_theme_options',
            ) );

            $wp_customize->add_control( 'jacqui_width', array(
                'label'      => __( 'Site Width', 'jacqui' ),
                'section'    => 'jacqui_layout',
                'settings' => 'jacqui_theme_options[width]',
                'type' => 'select',
                'choices' => array(
                    '' => '1200px',
                    'w960' => __( '960px', 'jacqui' ),
                    'w640' => __( '640px', 'jacqui' ),
                    'wfull' => __( 'Full Width', 'jacqui' ),
                ),
            ) );

            $wp_customize->add_setting( 'jacqui_theme_options[layout]', array(
                'default'    => $jacqui_theme_options['layout'],
                'type'       => 'option',
                'sanitize_callback' => 'sanitize_jacqui_layout',
                'capability' => 'edit_theme_options',
            ) );

            $wp_customize->add_control( 'jacqui_site_layout', array(
                'label'      => __( 'Site Layout', 'jacqui' ),
                'section'    => 'jacqui_layout',
                'settings' => 'jacqui_theme_options[layout]',
                'type' => 'radio',
                'choices' => array(
                    '1' => __( 'Left Sidebar', 'jacqui' ),
                    '2' => __( 'Right Sidebar', 'jacqui' ),
                    '3' => __( 'No Sidebar', 'jacqui' ),
                ),
            ) );

            $wp_customize->add_setting( 'jacqui_theme_options[primary]', array(
                'default'    => $jacqui_theme_options['primary'],
                'type'       => 'option',
                'sanitize_callback' => 'jacqui_sanitize_html',
                'capability' => 'edit_theme_options',
            ) );

            $wp_customize->add_control( 'jacqui_primary_column', array(
                'label'      => __( 'Main Content', 'jacqui' ),
                'section'    => 'jacqui_layout',
                'settings' => 'jacqui_theme_options[primary]',
                'type' => 'select',
                'choices' => array(
                    'c1' => __( '1 Column', 'jacqui' ),
                    'c2' => __( '2 Columns', 'jacqui' ),
                    'c3' => __( '3 Columns', 'jacqui' ),
                    'c4' => __( '4 Columns', 'jacqui' ),
                    'c5' => __( '5 Columns', 'jacqui' ),
                    'c6' => __( '6 Columns', 'jacqui' ),
                    'c7' => __( '7 Columns', 'jacqui' ),
                    'c8' => __( '8 Columns', 'jacqui' ),
                    'c9' => __( '9 Columns', 'jacqui' ),
                    'c10' => __( '10 Columns', 'jacqui' ),
                    'c11' => __( '11 Columns', 'jacqui' ),
                    'c12' => __( '12 Columns', 'jacqui' ),
                ),
            ) );

		// Color options
                $wp_customize->add_setting( 'jacqui_theme_options[link_color]', array(
			'default'           => $jacqui_theme_options['link_color'],
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'    => __( 'Link Color', 'jacqui' ),
			'section'  => 'colors',
			'settings' => 'jacqui_theme_options[link_color]',
		) ) );
    }
}
$jacqui_customizer = new jacqui_Customizer;

function sanitize_jacqui_layout( $input, $setting ) 
{

$jacqui_theme_options = get_theme_mod( 'jacqui_theme_options' );

    if ( $jacqui_theme_options['layout'] ==  1 || 2 || 3 || 4 || 5 ) {
        return $input;
    } else {
        return $setting->default;
    }
}
function jacqui_sanitize_html( $input ) 
{
    return wp_kses_post( force_balance_tags( $input ) );
}