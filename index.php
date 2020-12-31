<?php
/**
 * Stores the name of the plugin's directory
 * @var string
 */
define( 'CPPWA_PLUGIN_DIR_NAME', basename( dirname( __FILE__ ) ) );
/**
 * Stores the system path to the plugin's directory
 * @var string
 */
define( 'CPPWA_PLUGIN_DIR_PATH', trailingslashit( wp_normalize_path( dirname( __FILE__ ) ) ) );
/**
 * The name of the service worker file
 * @var string
 */
define( 'CPPWA_SERVICE_WORKER_FILE_NAME', 'cp-pwa-service-worker.js' );
/**
 * The name of the manifest file
 * @var string
 */
define( 'CPPWA_MANIFEST_FILE_NAME', 'cp-pwa-manifest.json' );

/**
 * The name of the option storing the plugin's options
 * @var string
 */
define( 'CPPWA_PLUGIN_OPTIONS_OPTION_NAME', 'vp_pwa_options' );

require_once( CPPWA_PLUGIN_DIR_PATH . 'helpers/Util.php' );
require_once( CPPWA_PLUGIN_DIR_PATH . 'helpers/Manifest.php' );
require_once( CPPWA_PLUGIN_DIR_PATH . 'controllers/ValPressPwaController.php' );
require_once( CPPWA_PLUGIN_DIR_PATH . 'hooks.php' );
require_once( CPPWA_PLUGIN_DIR_PATH . 'routes/web.php' );
