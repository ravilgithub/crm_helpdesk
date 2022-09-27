<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login( LoginRequest $request ) {
        $credentials = $request->only( 'email', 'password' );

        // Если получилось авторизоваться.
        if ( Auth::attempt( $credentials ) )
            return response( true ); // response( bool, status = 200 )

        return response( false, 301 );
    }


    public function logout() {
        Auth::logout();
        return response( true ); // response( bool, status = 200 )
    }
}
