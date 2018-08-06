<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;

class UserController extends Controller
{
    public function index()
    {
        return view('UserList');
    }

    public function get_list(){
        $user_data = DB::table('users')
		->join('roles', 'roles.id', '=', 'users.role_id')
		->select('users.id', 'users.name', 'users.email', 'roles.name as role');
        return Datatables::of($user_data)->make(true);
    }
}
