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
    public function create() {
        // Вариант 1
        /*$role = new Role();
        $role->name = 'Client';
        $role->save();*/

        
        // Вариант 2
        /*Role::insert(['name'=>'Admin 1']);

        $dt = Date('Y-m-d H:i:s');
        Role::insert(['name'=>'Admin 2', 'created_at'=>$dt, 'updated_at'=>$dt]);*/


        // Вариант 3
        Role::create(['name'=>'Manager']);

        return response()->json(true);
    }


    /**
     * DELETE | UPDATE | SELECT
     * https://laravel.su/docs/8.x/eloquent
     */
    public function index() {
        /**
         * ------------------------
         * DELETE
         * ------------------------
         */
        // Role::where('name', '=', 'Manager')->delete(); 



        /**
         * ------------------------
         * UPDATE
         * ------------------------
         */
        // Вариани 1
        $row = Role::find(3);
        $row->name = 'Admin'; // замена значения
        $row->save();

        // Варирнт 2
        $row = Role::where('name', '=', 'Admin')->update([
            'name' => 'Admin 2'
        ]);

        dump($row);



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
}
