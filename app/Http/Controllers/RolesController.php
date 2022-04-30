<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RolesController extends Controller
{
    /**
     * INSERT row to DB
     * https://laravel.su/docs/8.x/eloquent
     */
    public function create( Request $request ) {
        if ( $request->filled( 'name' ) ) {
            Role::create( $request->only( [ 'name' ] ) );
            // Role::create( [ 'name' => $request->input( 'name' ) ] );
        }

        return response( $request->filled( 'name' ) );
        return response()->json(true);
    }


    /**
     * ------------------------
     * UPDATE
     * ------------------------
     */
    public function update( Request $request, $role_id ) {
        // Вариани 1
        /*$row = Role::find(3);
        $row->name = 'Admin'; // замена значения
        $row->save();*/

        // Варирнт 2
        /*$row = Role::where('name', '=', 'Admin')->update([
            'name' => 'Admin 2'
        ]);

        dump($row);*/

        Role::whereId( $role_id )->update( [ 'name' => $request->input( 'name' ) ] );
        return response()->json( $role_id );
    }


    /**
     * ------------------------
     * DELETE
     * ------------------------
     */
    public function delete( $role_id ) {
        // Role::where( 'name', '=', 'Manager' )->delete();
        Role::find( $role_id )->delete();
    }


    /**
     * SELECT
     * https://laravel.su/docs/8.x/eloquent
     */
    public function index() {
        /**
         * ------------------------
         * SELECT
         * ------------------------
         */
        // Вариант 1
        // $res = Role::all();

        // Вариант 2
        // $res = Role::get();

        // С условием where(col_name, operand, col_value)
        // $res = Role::where('name', '=', 'Admin 1')->get();
        // $res = Role::where('created_at', '!=', NULL)->get();

        // $res = Role::whereNotNull('created_at')->get();
        // $res = Role::whereNull('created_at')->get();

        // SQL sting
        // $res = Role::whereNotNull('created_at')->orWhere('id', '>', 1)->toSql();

        // $res = Role::whereNotNull('created_at')->where('id', '>', 1)->get();
        // $res = Role::whereNotNull('created_at')->where('id', '>', 1)->where('name', '=', 'Manager')->get();


        // dd - dump and due
        // dd(Role::whereNotNull('created_at')->where('id', '>', 1)->get());

        // dump и выполнится дальнейший код 
        // dump(Role::whereNotNull('created_at')->where('id', '>', 1)->get());


        // Только первую запись из выборки
        // $res = Role::whereNotNull('created_at')->first();

        // Поиск по значению имени поля которое указано в свойстве $primaryKey
        // класса Illuminate\Database\Eloquent\Model по умолчанию id;
        // Аналог Role::where('id', '=', 4)->get();
        // $res = Role::find(4);


        // Сортировка
        $res = Role::orderByDesc('id')->get('name');

        return $res;
    }


    public function show( $role_id, $year = '' ) {

        // $role = Role::find( $role_id );
        $role = Role::where( 'id', '=', $role_id )->orWhere( 'created_at', 'like', "$year-%" )->get();

        if ( empty( $role ) ) {
            return response( [ 'empty' ], 404 );
        }

        return response()->json( [ 'data' => $role ] );
    }


    // Тоже самое что и метод show только короче
    public function show_2( Role $role ) {
        return response()->json( [ 'data' => $role ] );
    }
}
