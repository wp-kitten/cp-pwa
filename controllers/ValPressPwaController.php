<?php

namespace App\Http\Controllers;

use App\Helpers\VPML;
use App\Http\Controllers\Admin\AdminControllerBase;
use App\Models\Post;
use App\Models\PostStatus;
use App\Models\PostType;
use App\Plugins\CP_PWA\Manifest;
use App\Plugins\CP_PWA\Util;

class ValPressPwaController extends AdminControllerBase
{
    public function index()
    {
        return view( 'vp_pwa_config' )->with( [
            'options' => Util::getPluginOptions( $this->__getDefaultOptions() ),
            'pages' => Post::where( 'post_type_id', PostType::where( 'name', 'page' )->first()->id )
                ->where( 'post_status_id', PostStatus::where( 'name', 'publish' )->first()->id )
                ->where( 'language_id', VPML::getDefaultLanguageID() )
                ->where( 'translated_post_id', null )
                ->get(),
        ] );
    }

    private function __getDefaultOptions(): array
    {
        return [
            'name' => env( 'APP_NAME' ),
            'short_name' => env( 'APP_NAME' ),
            'description' => '',
            'start_url' => env( 'APP_URL' ),
            'background_color' => '#ffffff',
            'theme_color' => '#000000',
            'display' => 'standalone',
            'icons' => [
                '72x72' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/72x72.png' ),
                '96x96' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/96x96.png' ),
                '128x128' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/128x128.png' ),
                '144x144' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/144x144.png' ),
                '152x152' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/152x152.png' ),
                '192x192' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/192x192.png' ),
                '384x384' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/384x384.png' ),
                '512x512' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/512x512.png' ),
                '640x640' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/640x640.png' ),
                '750x750' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/750x750.png' ),
                '828x828' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/828x828.png' ),
                '1125x1125' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/1125x1125.png' ),
                '1242x1242' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/1242x1242.png' ),
                '1536x1536' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/1536x1536.png' ),
                '1668x1668' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/1668x1668.png' ),
                '2048x2048' => vp_plugin_url( CPPWA_PLUGIN_DIR_NAME, 'assets/images/icons/2048x2048.png' ),
            ],
            'offline_page_id' => 0,
        ];
    }

    //#! POST
    public function __save()
    {
        $this->request->validate( [
            'name' => 'required',
            'short_name' => 'required',
            'description' => '',
            'start_url' => 'required',
            'background_color' => 'required',
            'theme_color' => 'required',
            'display' => 'required',
            'icon_72x72' => 'required',
            'icon_96x96' => '',
            'icon_128x128' => '',
            'icon_144x144' => '',
            'icon_152x152' => 'required',
            'icon_192x192' => '',
            'icon_384x384' => '',
            'icon_512x512' => '',
            'icon_640x640' => '',
            'icon_750x750' => '',
            'icon_828x828' => '',
            'icon_1125x1125' => '',
            'icon_1242x1242' => '',
            'icon_1536x1536' => '',
            'icon_1668x1668' => '',
            'icon_2048x2048' => '',
            'offline_page_id' => 'required',
        ] );

        $optData = [
            'name' => $this->request->get( 'name' ),
            'short_name' => $this->request->get( 'short_name' ),
            'description' => $this->request->get( 'description' ),
            'start_url' => $this->request->get( 'start_url' ),
            'background_color' => $this->request->get( 'background_color' ),
            'theme_color' => $this->request->get( 'theme_color' ),
            'display' => $this->request->get( 'display' ),
            'icons' => [
                '72x72' => $this->request->get( 'icon_72x72' ),
                '96x96' => $this->request->get( 'icon_96x96' ),
                '128x128' => $this->request->get( 'icon_128x128' ),
                '144x144' => $this->request->get( 'icon_144x144' ),
                '152x152' => $this->request->get( 'icon_152x152' ),
                '192x192' => $this->request->get( 'icon_192x192' ),
                '384x384' => $this->request->get( 'icon_384x384' ),
                '512x512' => $this->request->get( 'icon_512x512' ),
                '640x640' => $this->request->get( 'icon_640x640' ),
                '750x750' => $this->request->get( 'icon_750x750' ),
                '828x828' => $this->request->get( 'icon_828x828' ),
                '1125x1125' => $this->request->get( 'icon_1125x1125' ),
                '1242x1242' => $this->request->get( 'icon_1242x1242' ),
                '1536x1536' => $this->request->get( 'icon_1536x1536' ),
                '1668x1668' => $this->request->get( 'icon_1668x1668' ),
                '2048x2048' => $this->request->get( 'icon_2048x2048' ),
            ],
            'offline_page_id' => $this->request->get( 'offline_page_id' ),
        ];
        $this->options->addOption( CPPWA_PLUGIN_OPTIONS_OPTION_NAME, $optData );

        try {
            Util::generateServiceWorkerFile( true );
            Manifest::generate( $optData );
        }
        catch ( \Exception $e ) {
            return redirect()->back()->with( 'message', [
                'class' => 'danger',
                'text' => __( 'cppwa::m.Error creating the service worker file: :error', [ 'error' => $e->getMessage() ] ),
            ] );
        }

        return redirect()->back()->with( 'message', [
            'class' => 'success',
            'text' => __( 'cppwa::m.Options saved.' ),
        ] );
    }
}
