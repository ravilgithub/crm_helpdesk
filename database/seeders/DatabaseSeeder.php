<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * https://laravel.su/docs/8.x/seeding
     * В консоль: php artisan migrate:fresh --seed
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call( [
            RolesSeeder::class
        ] );
    }
}
