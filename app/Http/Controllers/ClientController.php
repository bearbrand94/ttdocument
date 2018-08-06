<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;

class ClientController extends Controller
{
    public function index()
    {
        return view('ClientList');
    }

    public function get_list(){
        $user_data = DB::table('clients')
		->select('clients.id', 'clients.name', 'clients.email', 'clients.address', 'clients.phone');
        return Datatables::of($user_data)->make(true);
    }
}
