<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * Аутентификация пользователя.
     *
     * @param Object $request
     *
     * @return Mixed - Oтвет, который будет отправлен обратно в браузер пользователя.
     */
    public function login( LoginRequest $request ) {
        $credentials = $request->only( 'email', 'password' );

        // Если получилось аутентификация.
        if ( Auth::attempt( $credentials ) )
            return response( true ); // response( bool, status = 200 )

        return response( false, 401 );
    }


    /**
     * Выход из системы.
     *
     * @return Mixed - Oтвет, который будет отправлен обратно в браузер пользователя.
     */
    public function logout() {
        Auth::logout();
        return response( true ); // response( bool, status = 200 )
    }


    /**
     * Переход по маршруту.
     *
     * @return Mixed - Oтвет, который будет отправлен обратно в браузер пользователя.
     */
    public function home() {
        return response( Auth::user() ); // response( bool, status = 200 )
    }
}
