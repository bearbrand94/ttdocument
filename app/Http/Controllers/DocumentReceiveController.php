<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document_Receive;
use Yajra\Datatables\Datatables;
use DB;

class DocumentReceiveController extends Controller
{
    public function index()
    {
        return view('DocumentReceiveList');
    }

    public function get_list(){
        $documents_receive = DB::table('documents_receive as dr')
        		->join('users as user1', 'user1.id', '=', 'dr.receiver1')
        		->join('users as user2', 'user2.id', '=', 'dr.receiver2')
        		->join('clients', 'clients.id', '=', 'dr.client')

        		->select('dr.id', 'dr.created_at', 'dr.letter_number', 'user1.name as r1_name', 'user2.name as r2_name', 'clients.name as client_name', 'dr.review_status', 'dr.note');
        return Datatables::of($documents_receive)->make(true);
    }
}
