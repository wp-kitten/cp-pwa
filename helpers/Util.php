<?php

namespace App\Plugins\CP_PWA;

use App\Models\Options;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class Util
{
    /**
     * Retrieve the plugin's options
     * @param array $defaultOptions
     * @return bool|mixed
     */
    public static function getPluginOptions( array $defaultOptions = [] )
    {
        return ( new Options() )->getOption( CPPWA_PLUGIN_OPTIONS_OPTION_NAME, $defaultOptions );
    }

    /**
     * Generates the service worker file and puts it into the "public" directory
     * @param false $override Whether to replace the existing file if exists
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \Exception
     */
    public static function generateServiceWorkerFile( $override = false )
    {
        //#! Copy the service worker to public directory if not already there
        $filePath = public_path( 'cp-pwa-service-worker.js' );
        if ( !File::isFile( $filePath ) || $override ) {
            $swSource = path_combine( CPPWA_PLUGIN_DIR_PATH, 'assets/service-worker.js' );
            $options = Util::getPluginOptions();

            if ( empty( $options ) ) {
                throw new \Exception( __( "cppwa::m.Please configure the plugin." ) );
            }

            $page = Post::find( $options[ 'offline_page_id' ] );
            if ( !$page || !$page->id ) {
                throw new \Exception( __( 'cppwa::m.Please specify the offline page.' ) );
            }

            //#! Prepend the localized data since otherwise will throw errors
            $locale = [
                'offline_page_url' => cp_get_permalink( $page ),
                'service_worker_url' => asset( 'cp-pwa-service-worker.js' ),
                'app_url' => trailingslashit( env( 'APP_URL' ) ),
            ];

            $scriptData = "const CpPwaLocale = " . json_encode( $locale ) . '; ' . PHP_EOL . File::get( $swSource );
            File::put( $filePath, $scriptData );
        }
    }
}
