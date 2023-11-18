<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ticket;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Создаём пользователей, но не вносим записи в таблицу.
        // Можем посмотреть структуру модели перед вставкой в таблицу, а в частности атрибуты: #attributes, #fillable, #hidden, #casts.
        /*$user = User::factory()->make();
        dd( $user );*/

        // Создаём пользователей в таблице "User".
        // User::factory( 2 )->create();



        /**
         * Создаём одного пользователя с ролью "admin".
         */
        // Вариант 1
        /*User::factory( 1 )->create( [
            'role_id' => 1
        ] );*/
        // Вариант 2
        // @see Database\Factories\UserFactory
        // User::factory( 1 )->admin()->create();



        /*$tickets = Ticket::factory( 3 )->make();
        dd( $tickets );*/

        // Ticket::factory( 3 )->create();


        // https://laravel.su/docs/8.x/database-testing#has-many-relationships
        User::factory(3)
            ->client()
            ->has(Ticket::factory()->count(3))
            // ->hasTickets( 3 ) // короткая запись // работает не правильно !!!
            ->create();

        $users = [
            [
                'role_id' => 1, // admin
                'count' => 1,
            ],
            [
                'role_id' => 3, // manager
                'count' => 2,
            ],
            [
                'role_id' => 4, // main-manager
                'count' => 1,
            ],
        ];

        array_map(
            fn ($user) => User::factory($user['count'])->create(['role_id' => $user['role_id']]),
            $users
        );
    }
}
