<?php

namespace App\Http\Controllers;

use App\Models\Role;

class MainController extends Controller
{
    public function main() {
        return view( 'welcome' );
    }

    /*public function form_post() {
        return response()->json( [ 'name' => 'Ravil', 'age' => 41 ], 201 );
    }*/

    /*public function form_put() {
        return response()->json( [ 'name' => 'Ravil', 'age' => 42 ] );
    }*/

    /*public function form_any() {
        return response()->json( [ 'always' => 'response' ] );
    }*/

    // Возвращает строку и статус 201
    /*public function html() {
        return response( 'response html', 201 );
    }*/
}
