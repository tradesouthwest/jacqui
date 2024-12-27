<?php
// required functions to add theme plugin
add_action( 'tgmpa_register', 'jacqui_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function jacqui_register_required_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This includes required plugin pre-packaged with theme.
        array(
            'name'               => __( 'TSW Custom Profile', 'jacqui' ), 
            'slug'               => 'tsw-custom-profile',               
            'source'             => 'https://downloads.wordpress.org/plugin/tsw-custom-profile.zip',
            'required'           => false,   // false, the plugin is only 'recommended'.
            'version'            => '',     // If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation.
            'force_deactivation' => true, // If true, plugin is deactivated upon theme switch.
            'external_url'       => 'https://downloads.wordpress.org/plugin/tsw-custom-profile.zip'
        )
    );
    /**
     * Array of configuration settings. Amend each line as needed.
     */
    $config = array(
        'default_path' => '',                      // path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false,
        'is_automatic' => false,                   // Automatically activate plugins
        'message'      => __( 'TSW Profile creates a custom post to display below header', 'jacqui' ), 

        'strings'      => array(

            'page_title'                      => __( 'Install Required Plugins', 'jacqui' ),
            'menu_title'                      => __( 'Install Plugins', 'jacqui' ),
            'installing'                      => __( 'Installing Plugin: %s', 'jacqui' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'jacqui' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'jacqui' ), 
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'jacqui' ), 
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'jacqui' ), 
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'jacqui' ), 
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'jacqui' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'jacqui' ), 
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'jacqui' ), 
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'jacqui' ), 
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'jacqui' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'jacqui' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'jacqui' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'jacqui' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'jacqui' ), 
            'nag_type'                        => 'updated' // Determines admin notice type
        )
    );

    tgmpa( $plugins, $config );

}
?>