<?php

use App\Http\Controllers\ContentPressPwaController;
use Illuminate\Support\Facades\Route;

/*
 * Add custom routes or override existent ones
 */

Route::get( 'admin/settings/cp_pwa', [ ContentPressPwaController::class, 'index' ] )
    ->middleware( [ 'web', 'auth', 'active_user' ] )
    ->name( 'admin.settings.cp_pwa' );

Route::post( 'admin/settings/cp_pwa/save', [ ContentPressPwaController::class, '__save' ] )
    ->middleware( [ 'web', 'auth', 'active_user' ] )
    ->name( 'admin.settings.cp_pwa.save' );

