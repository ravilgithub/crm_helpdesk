<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * https://laravel.su/docs/8.x/seeding
     * В консоль: php artisan migrate:fresh --seed
     *
     * https://carbon.nesbot.com/docs/
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Client',
            'Manager',
            'Main-manager',
            'Admin',
        ];

        foreach ( $roles as $role ) {
            // $date = Date( 'Y-m-d H:i:s' );
            $date = Carbon::now();

            $role = [
                'name' => $role,
                'created_at' => $date,
                'updated_at' => $date
            ];

            DB::table( 'roles' )->insert( $role );
        }
    }
}
