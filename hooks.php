<?php
//#! Register the views path
use App\Helpers\MenuHelper;
use App\Plugins\CP_PWA\Util;

add_filter( 'contentpress/register_view_paths', function ( $paths = [] ) {
    $viewPath = path_combine( public_path( 'plugins' ), CPPWA_PLUGIN_DIR_NAME, 'views' );
    if ( !in_array( $viewPath, $paths ) ) {
        array_push( $paths, $viewPath );
    }
    return $paths;
}, 20 );

//#! Add the sidebar menu entry
add_action( 'contentpress/admin/sidebar/menu/settings', function () {
    if ( cp_current_user_can( 'administrator' ) ) {
        ?>
        <li>
            <a class="treeview-item <?php MenuHelper::activateSubmenuItem( 'admin.settings.cp_pwa' ); ?>"
               href="<?php esc_attr_e( route( 'admin.settings.cp_pwa' ) ); ?>">
                <?php esc_html_e( __( 'cppwa::m.PWA' ) ); ?>
            </a>
        </li>
        <?php
    }
} );

/**
 * Register the path to the translation file that will be used depending on the current locale
 */
add_action( 'contentpress/app/loaded', function () {
    cp_register_language_file( 'cppwa', path_combine( public_path( 'plugins' ), CPPWA_PLUGIN_DIR_NAME, 'lang' ) );

    //#! Copy the service worker to public directory if not already there
    try {
        Util::generateServiceWorkerFile();
    }
    catch ( Exception $e ) {
        logger( __( 'cppwa::m.Error creating the service worker file: :error', [ 'error' => $e->getMessage() ] ) );
    }
} );

add_action( 'contentpress/site/head', function () {
    //#! Localized data mainly used by service-worker-init.js
    ?>
    <script id="cp-pwa-locale">
        window.CpPwaServiceLocale = {
            service_worker_url: "<?php echo asset( CPPWA_SERVICE_WORKER_FILE_NAME );?>",
        };
    </script>
    <script id="cp-pwa-service-worker" src="<?php echo asset( CPPWA_SERVICE_WORKER_FILE_NAME ); ?>"></script>
    <script id="cp-pwa-service-worker-init" src="<?php echo cp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/service-worker-init.js' ); ?>"></script>
    <?php
    echo view( 'cp_pwa-app-header' )->render();
} );

