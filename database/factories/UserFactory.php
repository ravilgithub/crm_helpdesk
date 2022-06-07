<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            // 'role_id' => Role::inRandomOrder()->first()->id
            'role_id' => function() {
                // Сортировка записей в таблице "Role" в случайном порядке и выборка значения поля "id" первой записи.
                // return Role::orderBy( DB::raw( 'RAND()' ) )->first()->id;
                return Role::inRandomOrder()->first()->id;
            },
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }


    /**
     * Создаём пользователя с ролью "admin".
     *
     * @see Database\Seeders\DatabaseSeeder
     */
    public function admin() {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => 1
            ];
        });
    }


    /**
     * Создаём пользователя с ролью "client".
     *
     * @see Database\Seeders\DatabaseSeeder
     */
    public function client() {
        return $this->state(function(array $attributes) {
            return [
                'role_id' => 2
            ];
        });
    }
}
