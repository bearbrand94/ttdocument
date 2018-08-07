<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
Use App\Client;

class ClientController extends Controller
{
    public function index()
    {
        return view('ClientList');
    }

    public function get_list(){
        $client_data = Client::get_client_data();
        return Datatables::of($client_data)->make(true);
    }
}
