<?php

use App\Helpers\MenuHelper;
use App\Plugins\VP_PWA\Manifest;
use App\Plugins\VP_PWA\Util;

add_filter( 'valpress/register_view_paths', function ( $paths = [] ) {
    $viewPath = path_combine( public_path( 'plugins' ), CPPWA_PLUGIN_DIR_NAME, 'views' );
    if ( !in_array( $viewPath, $paths ) ) {
        array_push( $paths, $viewPath );
    }
    return $paths;
}, 20 );

//#! Add the sidebar menu entry
add_action( 'valpress/admin/sidebar/menu/settings', function () {
    if ( vp_current_user_can( 'administrator' ) ) {
        ?>
        <li>
            <a class="treeview-item <?php MenuHelper::activateSubmenuItem( 'admin.settings.vp_pwa' ); ?>"
               href="<?php esc_attr_e( route( 'admin.settings.vp_pwa' ) ); ?>">
                <?php esc_html_e( __( 'cppwa::m.PWA' ) ); ?>
            </a>
        </li>
        <?php
    }
} );

/**
 * Register the path to the translation file that will be used depending on the current locale
 */
add_action( 'valpress/app/loaded', function () {
    vp_register_language_file( 'cppwa', path_combine( public_path( 'plugins' ), CPPWA_PLUGIN_DIR_NAME, 'lang' ) );

    //#! Copy the service worker & the manifest files to public directory if not already there
    try {
        Util::generateServiceWorkerFile();
        Manifest::generate( Util::getPluginOptions() );
    }
    catch ( Exception $e ) {
        logger( __( 'cppwa::m.Error creating the service worker file: :error', [ 'error' => $e->getMessage() ] ) );
    }
} );

/**
 * Inject scripts & meta tags
 */
add_action( 'valpress/site/head', function () {
    //#! Localized data, mainly used by service-worker-init.js
    ?>
    <script id="vp-pwa-locale">
        window.CpPwaServiceLocale = {
            service_worker_url: "<?php echo asset( CPPWA_SERVICE_WORKER_FILE_NAME );?>",
        };
    </script>
    <script id="vp-pwa-service-worker" src="<?php echo asset( CPPWA_SERVICE_WORKER_FILE_NAME ); ?>"></script>
    <script id="vp-pwa-service-worker-init" src="<?php echo vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/service-worker-init.js' ); ?>"></script>
    <?php
    echo view( 'vp_pwa-app-header' )->render();
} );

/**
 * Delete files when deactivating the plugin
 */
add_action( 'valpress/plugin/deactivated', function ( $pluginDirName, $pluginInfo ) {
    if ( CPPWA_PLUGIN_DIR_NAME == $pluginDirName ) {
        try {
            $swFilePath = public_path( CPPWA_SERVICE_WORKER_FILE_NAME );
            $mfFilePath = public_path( CPPWA_MANIFEST_FILE_NAME );
            if ( \Illuminate\Support\Facades\File::isFile( $swFilePath ) ) {
                \Illuminate\Support\Facades\File::delete( $swFilePath );
            }
            if ( \Illuminate\Support\Facades\File::isFile( $mfFilePath ) ) {
                \Illuminate\Support\Facades\File::delete( $mfFilePath );
            }
        }
        catch ( Exception $e ) {
            logger( 'An error occurred while trying to delete the service worker file and the manifest.' );
        }
    }
}, 20, 2 );
