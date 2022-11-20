<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Models\Role;

class UserTest extends TestCase
{
    use RefreshDatabase;
    // use DatabaseTransactions;


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
    }


    /**
     * Тестовые данные.
     *
     * @see testHasAnyRole()
     *
     * @return Array
     */
    public function dataProviderRoles(): array {
        return [
            [ 'Admin', 'Admin', true ],
            [ 'Admin', [ 'admin' ], true ],
            [ 'Admin', [ 'admin', 'manager' ], true ],
            [ 'Admin', [ 'Client', 'manager' ], false ],
            [ 'Client', [ 'Client', 'manager' ], true ],
            [ 'Client', [ 'Admin', 'manager' ], false ],
            [ 'Manager', [ 'Admin', 'manager' ], true ]
        ];
    }


    /**
     * Тест на испольняемую пользователем роль.
     * Тест запустится столько раз, сколько элементов в (возвращаемом методом dataProviderRoles) массиве.
     *
     * @dataProvider dataProviderRoles
     *
     * @see App\Models\User::hasAnyRole()
     * 
     * @param String $roleName        - роль для создания пользователя.
     * @param String|Array $testRole  - роль|роли для сравнения с ролью созданного пользователя.
     * @param Boolean $expectedResult - ожидаемый результат сравнения.
     *
     * @return void
     */
    public function testHasAnyRole( $roleName, $testRole, $expectedResult ): void {
        $role = Role::where( 'name', $roleName )->first();

        $user = User::factory()->create( [
            'role_id' => $role->id
        ] );

        $this->assertEquals( $expectedResult, $user->hasAnyRole( $testRole ) );
    }
}
