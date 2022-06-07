<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Ticket;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    // Если в проекте используются транзакции то тест выкинет ошибку.
    // Сначала надо создать таблицы:
    //   php artisan migrate --seed --env=testing
    // Если таблицы уже заполненны то их можно перезаролнить: 
    //   php artisan migrate:refresh --seed --env=testing
    // use DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_is_new() {
        $this->seed(); // При использовании DatabaseTransactions закомментировать.

        $ticket = Ticket::factory()->create( [
            'status' => 0 // 0 - new
        ]);

        $this->assertTrue($ticket->isNew());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_is_not_new() {
        $this->seed(); // При использовании DatabaseTransactions закомментировать.

        $ticket = Ticket::factory()->create( [
            'status' => 1 // 1 - not new
        ]);

        $this->assertFalse($ticket->isNew());
    }    
}
