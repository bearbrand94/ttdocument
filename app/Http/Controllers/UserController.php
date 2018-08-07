<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return view('UserList');
    }

    public function get_list(){
        $user_data = User::get_user_data();
        return Datatables::of($user_data)->make(true);
    }
}
