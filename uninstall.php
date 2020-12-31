<?php

require_once( dirname( __FILE__ ) . '/index.php' );

add_action( 'valpress/plugin/deleted', function ( $pluginDirName ) {
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
}, 10 );
