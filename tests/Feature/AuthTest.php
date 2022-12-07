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
     *
     * 401 (Unauthorized), это означает, что вы пытаетесь получить доступ к странице,
     * на которую нужно сначала войти, используя действительный ID пользователя и пароль для просмотра.
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
        $response = $this->get( 'home' );
        $response->assertStatus( 401 );
    }


    /**
     * Аутентификация с не верным паролем.
     *
     * @return void
     *
     * 401 (Unauthorized), это означает, что вы пытаетесь получить доступ к странице,
     * на которую нужно сначала войти, используя действительный ID пользователя и пароль для просмотра.
     */
    public function testAuthFailed() {
        // Аутентификация с не верным паролем.
        $response = $this->attemptToLogin( 7 );
        $response->assertStatus( 401 );

        // Получение роли будучи не аутентифицированным.
        $response = $this->get( 'home' );
        $response->assertStatus( 401 );
    }


    /**
     * Попытка СОЗДАТЬ роль будучи не аутентифицированным.
     *
     * @return void
     *
     * 401 (Unauthorized), это означает, что вы пытаетесь получить доступ к странице,
     * на которую нужно сначала войти, используя действительный ID пользователя и пароль для просмотра.
     */
    public function testRolesAuth() {
        // Аутентификация с не верным паролем.
        $response = $this->attemptToLogin( 7 );
        $response->assertStatus( 401 );

        // Попытка СОЗДАТЬ роль будучи не аутентифицированным.
        $response = $this->post( 'roles' );
        $response->assertStatus( 401 );
    }
}
