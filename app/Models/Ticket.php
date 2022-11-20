<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;


    /**
     * Тест на новые заявки.
     *
     * @see Tests\Unit\Ticket
     *
     * @return Boolean - возвращает: true - новая, false - старая.
     */
    public function isNew(): bool {
        return $this->status === 0;
    }
}
