<?php

declare(strict_types=1);

/**
 * Set up the default theme options
 *
 * @return array<string, string>
 *
 * @since Jacqui 0.1
 */
function jacqui_theme_options(): array
{
    // Uncomment the line below to reset theme options to default
    // delete_option('jacqui_theme_options');

    $default_theme_options = [
        'width' => 'w960',
        'layout' => '2',
        'primary' => 'c8',
        'link_color' => '#336699',
    ];

    $options = get_option('jacqui_theme_options');
    
    // Ensure we always return an array
    if (!is_array($options)) {
        return $default_theme_options;
    }

    // Merge with defaults to ensure all keys exist
    return array_merge($default_theme_options, $options);
}

/**
 * Class Jacqui_Customizer
 *
 * Handles the customization options for the Jacqui theme.
 */
final class Jacqui_Customizer
{
    /**
     * Default theme options
     *
     * @var array<string, string>
     */
    private array $default_theme_options = [
        'width' => 'w960',
        'layout' => '2',
        'primary' => 'c8',
        'link_color' => '#336699',
    ];

    /**
     * Constructor.
     */
    public function __construct()
    {
        add_action('customize_register', [$this, 'customize_register']);
    }

    /**
     * Register customizer settings and controls.
     *
     * @param WP_Customize_Manager $wp_customize The customizer manager instance.
     * @return void
     */
    public function customize_register(WP_Customize_Manager $wp_customize): void
    {
        $jacqui_theme_options = jacqui_theme_options();

        // Add a section for layout options
        $wp_customize->add_section(
            'jacqui_layout',
            [
                'title' => __('Layout', 'jacqui'),
                'priority' => 35,
            ]
        );

        // Site Width Setting
        $wp_customize->add_setting(
            'jacqui_theme_options[width]',
            [
                'default' => $this->default_theme_options['width'],
                'type' => 'option',
                'sanitize_callback' => 'jacqui_sanitize_html',
                'capability' => 'edit_theme_options',
            ]
        );

        // Site Width Control
        $wp_customize->add_control(
            'jacqui_width',
            [
                'label' => __('Site Width', 'jacqui'),
                'section' => 'jacqui_layout',
                'settings' => 'jacqui_theme_options[width]',
                'type' => 'select',
                'choices' => [
                    '' => __('1200px', 'jacqui'),
                    'w960' => __('960px', 'jacqui'),
                    'w640' => __('640px', 'jacqui'),
                    'wfull' => __('Full Width', 'jacqui'),
                ],
            ]
        );

        // Site Layout Setting
        $wp_customize->add_setting(
            'jacqui_theme_options[layout]',
            [
                'default' => $this->default_theme_options['layout'],
                'type' => 'option',
                'sanitize_callback' => 'sanitize_jacqui_layout',
                'capability' => 'edit_theme_options',
            ]
        );

        // Site Layout Control
        $wp_customize->add_control(
            'jacqui_site_layout',
            [
                'label' => __('Site Layout', 'jacqui'),
                'section' => 'jacqui_layout',
                'settings' => 'jacqui_theme_options[layout]',
                'type' => 'radio',
                'choices' => [
                    '1' => __('Left Sidebar', 'jacqui'),
                    '2' => __('Right Sidebar', 'jacqui'),
                    '3' => __('No Sidebar', 'jacqui'),
                ],
            ]
        );

        // Main Content Setting
        $wp_customize->add_setting(
            'jacqui_theme_options[primary]',
            [
                'default' => $this->default_theme_options['primary'],
                'type' => 'option',
                'sanitize_callback' => 'jacqui_sanitize_html',
                'capability' => 'edit_theme_options',
            ]
        );

        // Main Content Control
        $wp_customize->add_control(
            'jacqui_primary_column',
            [
                'label' => __('Main Content', 'jacqui'),
                'section' => 'jacqui_layout',
                'settings' => 'jacqui_theme_options[primary]',
                'type' => 'select',
                'choices' => array_combine(
                    range(1, 12),
                    array_map(
                        static fn(int $i): string => sprintf(
                            '%d %s',
                            $i,
                            __('Columns', 'jacqui')
                        ),
                        range(1, 12)
                    )
                ),
            ]
        );

        // Link Color Setting
        $wp_customize->add_setting(
            'jacqui_theme_options[link_color]',
            [
                'default' => $this->default_theme_options['link_color'],
                'type' => 'option',
                'sanitize_callback' => 'sanitize_hex_color',
                'capability' => 'edit_theme_options',
            ]
        );

        // Link Color Control
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'link_color',
                [
                    'label' => __('Link Color', 'jacqui'),
                    'section' => 'colors',
                    'settings' => 'jacqui_theme_options[link_color]',
                ]
            )
        );
    }
}

/**
 * Instantiate the customizer class.
 */
$jacqui_customizer = new Jacqui_Customizer();

/**
 * Sanitize layout input.
 *
 * @param mixed $input The input value.
 * @param WP_Customize_Setting $setting The setting instance.
 * @return string The sanitized layout value.
 */
function sanitize_jacqui_layout(mixed $input, WP_Customize_Setting $setting): string
{
    $valid_layouts = ['1', '2', '3'];
    return in_array($input, $valid_layouts, true) ? (string) $input : $setting->default;
}

/**
 * Sanitize HTML input.
 *
 * @param string $input The HTML input value.
 * @return string Sanitized HTML output.
 */
function jacqui_sanitize_html(string $input): string
{
    return wp_kses_post(force_balance_tags($input));
} 