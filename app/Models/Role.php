<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;


    /**
     * Атрибуты, для которых НЕ разрешено массовое присвоение значений.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * Get users.
     *
     * https://laravel.su/docs/8.x/eloquent-relationships#one-to-many
     *
     * @see App\Http\Controllers\RolesController::users
     *
     * SQL:
     * SELECT u.* FROM users AS u JOIN roles AS r ON u.role_id = r.id WHERE r.id = 2;
     */
    public function users() {
        // Class, foreignKey, localKey
        // return $this->hasMany( User::class, 'role_id', 'id' );
        return $this->hasMany( User::class );
    }
}
