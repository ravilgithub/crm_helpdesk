<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Определение обратной связи Один ко многим.
     *
     * @see App\Models\Role::users
     * @see App\Http\Controllers\RolesController::users
     *
     * https://laravel.su/docs/8.x/eloquent-relationships#one-to-many-inverse
     *
     * SQL:
     * SELECT DISTINCT r.* FROM users AS u JOIN roles AS r ON u.role_id = r.id WHERE r.id = 2;
     */
    public function role() {
        // return $this->belongsTo( Role::class, 'role_id', 'id' );
        // return $this->belongsTo( Role::class, 'role_id' );
        return $this->belongsTo( Role::class );
    }


    /**
     * Определение связи Один-ко-многим ( foreign key ).
     *
     * https://laravel.su/docs/8.x/eloquent-relationships#one-to-many
     *
     * @see Database\Factories\TicketFactory
     */
    public function tickets() {
        return $this->hasMany( Ticket::class );
    }


    /**
     * Тест на испольняемую пользователем роль.
     *
     * @see Tests\Unit\UserTest
     *
     * @return Boolean - роль|роли: true - совпадают, false - не совпадают.
     */
    public function hasAnyRole( $roles ): bool {
        if ( ! is_array( $roles ) )
            $roles = [ $roles ];

        foreach ( $roles as $role ) {
            if ( strtolower( $role ) === strtolower( $this->role->name ) ) {
                return true;
            }
        }

        return false;
    }

}
