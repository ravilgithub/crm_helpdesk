<?php

namespace App\Http\Controllers;

use App\Models\User;

class MainController extends Controller
{
    public function main() {
        return view( 'welcome' );
    }

    public function users() {
        return User::get()->map( fn( User $user ) => [
            'id' => $user->id,
            'role' => $user->role->name,
            'name' => $user->name,
            'email' => $user->email,
        ] );
    }

    public function user( $user_id ) {
        return User::find( $user_id )->only( 'name', 'email' );
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
