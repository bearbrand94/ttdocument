<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document_Send;
use Yajra\Datatables\Datatables;
use DB;

class DocumentSendController extends Controller
{
    public function index()
    {
        return view('DocumentSendList');
    }

    public function get_list(){
        $documents_send = DB::table('documents_send as ds')
        		->join('users as user1', 'user1.id', '=', 'ds.requested_by')
        		->join('users as user2', 'user2.id', '=', 'ds.submitted_to')
        		->join('clients', 'clients.id', '=', 'ds.send_to')

        		->select('ds.id', 'ds.created_at', 'ds.letter_number', 'user1.name as requested_by', 'user2.name as submitted_to', 'clients.name as send_to', 'ds.approval_status', 'ds.note');
        return Datatables::of($documents_send)->make(true);
    }
}
