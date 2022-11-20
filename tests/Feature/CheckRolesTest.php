<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class CheckRolesTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    /**
     * Заполняем таблицы начальными данными.
     *  @see Database\Seeders\DatabaseSeeder
     *
     * Метод будет запускаться перед каждым тестом класса.
     *
     * @return void
     */
    protected function setUp(): void {
        parent::setUp();

        $this->seed();
        $this->password = $this->faker->password;
    }


    /**
     * Тестовые данные.
     *
     * @see testCheckRouteRoles()
     *
     * @return Array
     */
    public function dataProviderRoles(): array {
        return [
            [ 'Admin', 200 ],
            [ 'Client', 403 ],
            [ 'Manager', 403 ],
            [ 'Main-Manager', 403 ]
        ];
    }


    /**
     * Тест на роль "admin".
     * Тест запустится столько раз, сколько элементов в (возвращаемом методом dataProviderRoles) массиве.
     *
     * @dataProvider dataProviderRoles
     *
     * @see Route::post( 'login' )
     * @see Route::get( 'roles' )
     *
     * @param String $role    - роль для создания пользователя.
     * @param Integer $status - ожидаемый статус при аутентификации|авторизации: 200 - admin, 403 - остальные.
     *
     * @return void
     */
    public function testCheckRouteRoles( string $roleName, int $statusCode ): void {
        $role = Role::where( 'name', $roleName )->first();

        $user = User::factory()->create( [
            'password' => bcrypt( $this->password ),
            'role_id' => $role->id
        ] );

        $this->post( 'login', [ 'email' => $user->email, 'password' => $this->password ] );

        $response = $this->get( 'roles' );
        $response->assertStatus( $statusCode );
    }
}
