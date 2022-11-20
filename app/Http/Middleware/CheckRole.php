<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Проверяем аутентифицированного пользователя на исполняемую роль.
     *
     * @see ~/web/laravel/crm_helpdesk/routes/web.php - добавил посредника "roles".
     * @see Route::middleware( [ 'roles:admin' ] )
     * @see App\Models\User
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  Array $roles - роли, на принадлежность к которым проверяем аутентифицированного пользователя.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // dump( $roles );
        if ( ! Auth::user()->hasAnyRole( $roles ) )
            return response( false, 403 );

        return $next($request);
    }
}
