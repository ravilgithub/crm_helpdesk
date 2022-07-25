<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;


// Запуск теста в консоле по имени
// php artisan test --filter AuthTest

class AuthTest extends TestCase
{
    public function testAuth() {
        $this->seed();

        $password = 123456;
        $user = User::factory()->create( [ 'password' => bcrypt( $password ) ] );
        
        // Аутентификация
        $response = $this->post( 'login', [ 'email' => $user->email, 'password' => $password ] );
        $response->assertStatus( 200 );

        // Получение роли
        $response = $this->get( 'roles' );
        $response->assertStatus( 200 );

        // Выход
        $response = $this->get( 'logout' );
        $response->assertStatus( 200 );

        // Получение роли после выхода.
        // 301 - перенаправление на страницу аутентификации.
        $response = $this->get( 'roles' );
        $response->assertStatus( 301 );
    }


    public function testAuthFailed() {
        $this->seed();

        // Не верный пароль
        $password = 123456;
        $user = User::factory()->create( [ 'password' => bcrypt( $password ) ] );
        
        // Аутентификация с не верным паролем.
        // 301 - перенаправление на страницу аутентификации.
        $response = $this->post( 'login', [ 'email' => $user->email, 'password' => $password . 7 ] );
        $response->assertStatus( 301 );

        // Получение роли будучи не аутентифицированным.
        // 301 - перенаправление на страницу аутентификации.
        $response = $this->get( 'roles' );
        $response->assertStatus( 301 );
    }


    public function testRolesAuth() {
        $this->seed();

        // Не верный пароль
        $password = 123456;
        $user = User::factory()->create( [ 'password' => bcrypt( $password ) ] );
        
        // Аутентификация с не верным паролем.
        // 301 - перенаправление на страницу аутентификации.
        $response = $this->post( 'login', [ 'email' => $user->email, 'password' => $password . 7 ] );
        $response->assertStatus( 301 );

        // Попытка СОЗДАТЬ роль будучи не аутентифицированным.
        // 301 - перенаправление на страницу аутентификации.
        $response = $this->post( 'roles' );
        $response->assertStatus( 301 );
    }
}
