<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login( Request $request ) {
        $credentials = $request->only( 'email', 'password' );

        // Если получилось авторизоваться.
        if ( Auth::attempt( $credentials ) )
            return response( true ); // response( bool, status = 200 )

        return response( false, 301 );
    }


    public function logout( Request $request ) {
        Auth::logout();
        return response( true ); // response( bool, status = 200 )
    }
}
