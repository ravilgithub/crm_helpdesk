<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


// Запуск теста в консоле по имени
// php artisan test --filter AuthTest

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;
    protected $password;


    /**
     * Заполняем таблицы начальными данными.
     *  @see Database\Seeders\DatabaseSeeder
     *
     * Создаём пользавателя.
     *  @see Database\Factories\UserFactory
     *
     * Метод будет запускаться перед каждым тестом класса.
     *
     * @return void
     */
    protected function setUp(): void {
        parent::setUp();

        $this->seed();
        $this->password = $this->faker->password;
        $this->user = User::factory()->create( [ 'password' => bcrypt( $this->password ) ] );
    }


    /**
     * Аутентификация пользавателя.
     *
     * @param String $wrong_pass_sfx - окончание пароля для формирования заведомо не правильного пароля.
     *
     * @return Object response
     */
    protected function attemptToLogin( $wrong_pass_sfx = '' ) {
        return $this->post( 'login', [ 'email' => $this->user->email, 'password' => $this->password . $wrong_pass_sfx ] );
    }


    /**
     * Аутентификация.
     *
     * @return void
     */
    public function testAuth() {
        // Аутентификация
        $response = $this->attemptToLogin();
        // dd( $response->getContent() );
        $response->assertStatus( 200 );

        // Получение роли
        $response = $this->get( 'home' );
        $response->assertStatus( 200 );

        // Выход
        $response = $this->get( 'logout' );
        $response->assertStatus( 200 );

        // Получение роли после выхода.
        // 301 - перенаправление на страницу аутентификации.
        $response = $this->get( 'home' );
        $response->assertStatus( 301 );
    }


    /**
     * Аутентификация с не верным паролем.
     *
     * @return void
     */
    public function testAuthFailed() {
        // Аутентификация с не верным паролем.
        // 301 - перенаправление на страницу аутентификации.
        $response = $this->attemptToLogin( 7 );
        $response->assertStatus( 301 );

        // Получение роли будучи не аутентифицированным.
        // 301 - перенаправление на страницу аутентификации.
        $response = $this->get( 'home' );
        $response->assertStatus( 301 );
    }


    /**
     * Попытка СОЗДАТЬ роль будучи не аутентифицированным.
     *
     * @return void
     */
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
