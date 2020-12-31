<?php

namespace App\Plugins\CP_PWA;

use App\Models\Post;
use Illuminate\Support\Facades\File;

class Manifest
{
    /**
     * Generate the manifest.json and place it in the public directory
     * @param array $options
     */
    public static function generate( array $options = [] )
    {
        if ( empty( $options ) ) {
            $options = Util::getPluginOptions();
        }
        if ( empty( $options ) ) {
            return;
        }
        $filePath = public_path( CPPWA_MANIFEST_FILE_NAME );
        $manifest = [];
        foreach ( $options as $optionName => $value ) {
            if ( 'icons' == $optionName ) {
                foreach ( $value as $k => $v ) {
                    if ( !empty( $v ) ) {
                        $manifest[ 'icons' ][] = [
                            'src' => $v,
                            'type' => 'image/png',
                            'sizes' => $k,
                        ];
                    }
                }
            }
            elseif ( 'description' == $optionName ) {
                $manifest[ 'description' ] = ( empty( $value ) ? "" : $value );
            }
            elseif ( 'offline_page_id' == $optionName ) {
                $options = Util::getPluginOptions();
                $page = Post::find( $options[ 'offline_page_id' ] );
                if ( $page && $page->id ) {
                    $manifest[ 'offline_page_url' ] = vp_get_permalink( $page );
                }
            }
            else {
                $manifest[ $optionName ] = $value;
            }
        }

        File::put( $filePath, json_encode( $manifest ) );
    }

}
