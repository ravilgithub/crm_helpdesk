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

Route::get('index', [RolesController::class, 'index']);

// Insert
Route::post( 'roles', [ RolesController::class, 'create' ] );

// Update
Route::put( 'roles/{role_id}', [ RolesController::class, 'update' ] );

// Delete
Route::get( 'roles/del/{role_id}', [ RolesController::class, 'delete' ] );

// ? - необязательный параметр created_at
Route::get( 'roles/{role_id}/{year?}', [ RolesController::class, 'show' ] );

// по полю(колонка в БД) name
Route::get( 'roles-2/{role:name}', [ RolesController::class, 'show_2' ] );

/*Route::get( 'roles/{role_id}', function( $role_id ) {
    dd( $role_id );
} );
*/