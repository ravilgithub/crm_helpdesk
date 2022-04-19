<?php

use App\Http\Controllers\MainController;
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

Route::get('/', [ MainController::class, 'index' ] );

Route::post( 'form', [ MainController::class, 'form_post' ] );
Route::put( 'form', [ MainController::class, 'form_put' ] );
// Route::any( 'form', [ MainController::class, 'form_any' ] );

Route::get( 'html', [ MainController::class, 'html' ] );
