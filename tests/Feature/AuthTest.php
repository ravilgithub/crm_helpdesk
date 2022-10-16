<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;


// Запуск теста в консоле по имени
// php artisan test --filter AuthTest

class AuthTest extends TestCase
{
    use WithFaker;

    protected $user;
    protected $password;


    protected function setUp(): void {
        parent::setUp();

        $this->seed();
        $this->password = $this->faker->password;
        $this->user = User::factory()->create( [ 'password' => bcrypt( $this->password ) ] );
    }


    /**
     * Аутентификация
     */
    protected function attemptToLogin( $wrong_pass_sfx = '' ) {
        return $this->post( 'login', [ 'email' => $this->user->email, 'password' => $this->password . $wrong_pass_sfx ] );
    }


    public function testAuth() {
        // Аутентификация
        $response = $this->attemptToLogin();
        // dd( $response->getContent() );
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
        // Аутентификация с не верным паролем.
        // 301 - перенаправление на страницу аутентификации.
        $response = $this->attemptToLogin( 7 );
        $response->assertStatus( 301 );

        // Получение роли будучи не аутентифицированным.
        // 301 - перенаправление на страницу аутентификации.
        $response = $this->get( 'roles' );
        $response->assertStatus( 301 );
    }


    public function testRolesAuth() {
        // Аутентификация с не верным паролем.
        // 301 - перенаправление на страницу аутентификации.
        $response = $this->attemptToLogin( 7 );
        $response->assertStatus( 301 );

        // Попытка СОЗДАТЬ роль будучи не аутентифицированным.
        // 301 - перенаправление на страницу аутентификации.
        $response = $this->post( 'roles' );
        $response->assertStatus( 301 );
    }
}
