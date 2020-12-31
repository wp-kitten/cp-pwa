<?php

use App\Http\Controllers\ValPressPwaController;
use Illuminate\Support\Facades\Route;

/*
 * Add custom routes or override existent ones
 */

Route::get( 'admin/settings/vp_pwa', [ ValPressPwaController::class, 'index' ] )
    ->middleware( [ 'web', 'auth', 'active_user' ] )
    ->name( 'admin.settings.vp_pwa' );

Route::post( 'admin/settings/vp_pwa/save', [ ValPressPwaController::class, '__save' ] )
    ->middleware( [ 'web', 'auth', 'active_user' ] )
    ->name( 'admin.settings.vp_pwa.save' );

