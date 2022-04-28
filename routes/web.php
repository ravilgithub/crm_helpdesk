<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'main']);

Route::get('create', [RolesController::class, 'create']);
Route::get('index', [RolesController::class, 'index']);

// ? - необязательный параметр created_at
Route::get( 'roles/{role_id}/{year?}', [ RolesController::class, 'show' ] );

// по полю(колонка в БД) name
Route::get( 'roles-2/{role:name}', [ RolesController::class, 'show_2' ] );

/*Route::get( 'roles/{role_id}', function( $role_id ) {
    dd( $role_id );
} );
*/