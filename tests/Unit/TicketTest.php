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


    public function getTestData(): array {
        return [
            [ 0, true ],
            [ 1, false ]
        ];
    }


    /**
     * Тест на новые заявки.
     * Тест запустится столько раз, сколько элементов в (возвращающем методом getTestData) массиве.
     *
     * @dataProvider getTestData
     */
    public function testIsNew( $status, $exceptedResult ): void {
        $this->seed(); // При использовании DatabaseTransactions закомментировать.

        $ticket = Ticket::factory()->create( [
            'status' => $status // 0 - new
        ]);

        $this->assertEquals( $exceptedResult, $ticket->isNew() );
    }
}
