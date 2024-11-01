<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.fse-online.co.uk
 * @since             2.1.3
 * @package           fse_wpeaxf
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Expert Agent XML Feed
 * Description:       Fetch daily for your specified Expert Agent XML feed using the WP-Cron system.
 * Version:           2.1.3
 * Author:            FSE Online Ltd
 * Author URI:        http://www.fse-online.co.uk/?utm_source=wordpress&utm_medium=plugin&utm_campaign=WordPress%20Expert%20Agent%20XML%20Feed
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-expert-agent-xml-feed
 * Domain Path:       /languages
 *
 */
/*
███████╗███████╗███████╗     ██████╗ ███╗   ██╗██╗     ██╗███╗   ██╗███████╗
 ╚══════╝██╔════╝██╔════╝    ██╔═══██╗████╗  ██║██║     ██║████╗  ██║██╔════╝
 █████╗  ███████╗█████╗      ██║   ██║██╔██╗ ██║██║     ██║██╔██╗ ██║█████╗
 ██╔══╝  ╚════██║██╔══╝      ██║   ██║██║╚██╗██║██║     ██║██║╚██╗██║██╔══╝
 ██║     ███████║███████╗    ╚██████╔╝██║ ╚████║███████╗██║██║ ╚████║███████╗
 ╚═╝     ╚══════╝╚══════╝     ╚═════╝ ╚═╝  ╚═══╝╚══════╝╚═╝╚═╝  ╚═══╝╚══════╝
*/
namespace fse_wpeaxf;


if ( !function_exists( 'weaxf_fs' ) ) {
    // Create a helper function for easy SDK access.
    function weaxf_fs()
    {
        global  $weaxf_fs ;
        
        if ( !isset( $weaxf_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $weaxf_fs = fs_dynamic_init( array(
                'id'             => '6857',
                'slug'           => 'wp-expert-agent-xml-feed',
                'type'           => 'plugin',
                'public_key'     => 'pk_67e00049108de044f2d0b4e0eb6a3',
                'is_premium'     => false,
                'has_addons'     => false,
                'has_paid_plans' => false,
                'menu'           => array(
                'slug'    => 'wp-expert-agent-xml-feed',
                'account' => false,
                'support' => false,
                'parent'  => array(
                'slug' => 'options-general.php',
            ),
            ),
                'is_live'        => true,
            ) );
        }
        
        return $weaxf_fs;
    }
    
    // Init Freemius.
    weaxf_fs();
    // Signal that SDK was initiated.
    do_action( 'weaxf_fs_loaded' );
}

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}
/**
 * Define Constants
 */
define( __NAMESPACE__ . '\\NS', __NAMESPACE__ . '\\' );
define( NS . 'PLUGIN_NAME', 'wp-expert-agent-xml-feed' );
define( NS . 'PLUGIN_VERSION', '2.1.3' );
define( NS . 'PLUGIN_NAME_DIR', plugin_dir_path( __FILE__ ) );
define( NS . 'PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );
define( NS . 'PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( NS . 'PLUGIN_TEXT_DOMAIN', 'wp-expert-agent-xml-feed' );
/**
 * Autoload Classes
 */
require_once PLUGIN_NAME_DIR . 'inc/libraries/autoloader.php';
/**
 * Register Activation and Deactivation Hooks
 * This action is documented in inc/core/class-activator.php
 */
register_activation_hook( __FILE__, array( NS . 'Inc\\Core\\Activator', 'activate' ) );
/**
 * The code that runs during plugin deactivation.
 * This action is documented inc/core/class-deactivator.php
 */
register_deactivation_hook( __FILE__, array( NS . 'Inc\\Core\\Deactivator', 'deactivate' ) );
/**
 * Plugin Singleton Container
 *
 * Maintains a single copy of the plugin app object
 *
 * @since    2.1.3
 */
class fse_wpeaxf
{
    static  $init ;
    /**
     * Loads the plugin
     *
     * @access    public
     */
    public static function init()
    {
        
        if ( null == self::$init ) {
            self::$init = new Inc\Core\Init();
            self::$init->run();
        }
        
        return self::$init;
    }

}
/*
 *
 * Begins execution of the plugin
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * Also returns copy of the app object so 3rd party developers
 * can interact with the plugin's hooks contained within.
 *
 */
function fse_wpeaxf_init()
{
    return fse_wpeaxf::init();
}

$min_php = '5.6.0';
// Check the minimum required PHP version and run the plugin.
if ( version_compare( PHP_VERSION, $min_php, '>=' ) ) {
    fse_wpeaxf_init();
}
function weaxf_fs_uninstall_cleanup()
{
    // Remove Plugin options on uninstall
    global  $wpdb ;
    $plugin_options = $wpdb->get_results( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE 'fse_wp_expert_agent_xml_feed_%'" );
    foreach ( $plugin_options as $option ) {
        delete_option( $option->option_name );
    }
    // Unschedule cron job
    wp_clear_scheduled_hook( 'fse_wpeaxf_check_daily' );
}

weaxf_fs()->add_action( 'after_uninstall', 'weaxf_fs_uninstall_cleanup' );