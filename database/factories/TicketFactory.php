<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->numberBetween( 0, 3 ),

            // @see App\Models\User::tickets
            'user_id' => User::factory()
            /*'user_id' => function() {
                return User::inRandomOrder()->first()->id;
            },*/
        ];
    }
}
