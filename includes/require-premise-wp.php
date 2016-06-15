<?php 
/**
 * Make Premise WP required by this theme
 *
 * @link https://github.com/PremiseWP/Premise-WP Premise WP GitHub project
 *
 * @package [level 1]\[level 2]\[etc.]
 */

/**
 * Require the TGM_Plugin_Activation class.
 */
require_once 'class-tgm-activation-plugin.php';

/**
 * Register TGM_Plugin_Activation Hook
 */
add_action( 'tgmpa_register', 'themeprefix_register_required_plugins' );

/**
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function themeprefix_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // Make Premise WP required
        array(
            'name'               => 'Premise WP Plugin',                              // The plugin name.
            'slug'               => 'Premise-WP',                                     // The plugin slug (typically the folder name).
            'source'             => 'https://github.com/PremiseWP/Premise-WP/archive/master.zip', // The plugin source.
            'required'           => true,                                             // If false, the plugin is only 'recommended' instead of required.
            'version'            => '',                                               // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation'   => false,                                            // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false,                                            // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '',                                               // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '',                                               // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     */
    $config = array(
        'id'           => 'UNIQUE_ID',              // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                  // Default absolute path to bundled plugins.
        'menu'         => 'UNIQUE_ID-slug',         // Menu slug.
        'parent_slug'  => 'plugins.php',       // Parent menu slug.
        'capability'   => 'manage_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                // Show admin notices or not.
        'dismissable'  => true,                // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                  // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,               // Automatically activate plugins after installation or not.
        'message'      => '',                  // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );
}