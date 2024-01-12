<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://unifiedplugins.com
 * @since             2.0.0
 * @package           Demo
 *
 * @wordpress-plugin
 * Plugin Name:       Demo 
 * Plugin URI:        
 * Description:       Admin, performance and security toolkit! Things you need.. and things you didn’t know you needed, but you now can’t live without!
 * Version:           2.0.1
 * Author:            Demo
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       demo
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists( 'ut_fs' ) ) {
    // Create a helper function for easy SDK access.
    function ut_fs() {
        global $ut_fs;

        if ( ! isset( $ut_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $ut_fs = fs_dynamic_init( array(
                'id'                  => '4276',
                'slug'                => 'demo',
                'type'                => 'plugin',
                'public_key'          => 'pk_13eeff8936e2273d67ce26f999c77',
                'is_premium'          => false,
                'is_premium_only'     => false,
                'has_addons'          => false,
                'has_paid_plans'      => false,
                'is_org_compliant'    => false,
                'has_affiliation'     => 'selected',
                'menu'                => array(
                    'slug'           => 'demo',
                    'first-path'     => 'admin.php?page=demo',
                    'support'        => false,
                    'parent'         => array(
                        'slug' => 'demo',
                    ),
                    'pricing' => false,
                ),
            ) );
        }

        return $ut_fs;
    }

    // Init Freemius.
    ut_fs();
    // Signal that SDK was initiated.
    do_action( 'ut_fs_loaded' );
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'Demo_VERSION', '1.0.0' );
define( 'Demo_DASHBOARD_SLUG', 'demo' );
define( 'Demo_SLUG', 'demo' );
define( 'Demo_FILE', __FILE__ );
define( 'Demo_DIR', dirname( __FILE__ ) );
define( 'Demo_URL', plugin_dir_url( __FILE__ ) );
define( 'Demo_BASE_NAME', plugin_basename( __FILE__ ) );
define( 'Demo_DUPLICATE_SLUG', 'demo_duplicate_post_as_draft' );
define( 'demo_REQUIRED_MINIFY_PHP_VERSION', version_compare(PHP_VERSION, '5.4', '>=') ? true : false);
$plugin_basename = plugin_basename( __FILE__ );

// WP_PLUGIN_DIR.'/$plugin_basename/cache' : false,
// defined('WP_CONTENT_DIR') ? WP_CONTENT_DIR.'/plugins/$plugin_basename/cache' : false,
// dirname(__FILE__).'/plugins/$plugin_basename/cache',
// '$cache_file_basename',

//define( 'WP_CONTENT_DIR', WP_PLUGIN_DIR.'/'.$plugin_basename.'/cache');

define( 'demo_CACHE_MIN_FILES_DIR', untrailingslashit(WP_CONTENT_DIR).'/cache/demo-minify' );
define( 'demo_CACHE_MIN_FILES_URL', untrailingslashit(WP_CONTENT_URL).'/cache/demo-minify' );


if (!class_exists('\MatthiasMullie\Minify\Minify')) {	
	require_once Demo_DIR.'/vendor/matthiasmullie/minify/src/Minify.php';
	require_once Demo_DIR.'/vendor/matthiasmullie/minify/src/CSS.php';
	require_once Demo_DIR.'/vendor/matthiasmullie/minify/src/JS.php';
	require_once Demo_DIR.'/vendor/matthiasmullie/minify/src/Exception.php';
	require_once Demo_DIR.'/vendor/matthiasmullie/minify/src/Exceptions/BasicException.php';
	require_once Demo_DIR.'/vendor/matthiasmullie/minify/src/Exceptions/FileImportException.php';
	require_once Demo_DIR.'/vendor/matthiasmullie/minify/src/Exceptions/IOException.php';
	require_once Demo_DIR.'/vendor/matthiasmullie/path-converter/src/ConverterInterface.php';
	require_once Demo_DIR.'/vendor/matthiasmullie/path-converter/src/Converter.php';
	
}
use MatthiasMullie\Minify;

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-demo-activator.php
 */
function activate_Demo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-demo-activator.php';
	Demo_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-demo-deactivator.php
 */
function deactivate_Demo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-demo-deactivator.php';
	Demo_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Demo' );
register_deactivation_hook( __FILE__, 'deactivate_Demo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-demo.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Demo() {

	$plugin = new Demo();
	$plugin->run();

}
run_Demo();