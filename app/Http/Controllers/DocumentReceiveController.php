<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document_Receive;
use Yajra\Datatables\Datatables;


class DocumentReceiveController extends Controller
{
    public function index()
    {
        return view('DocumentReceiveList');
    }

    public function get_list(){
        $documents_receive = Document_Receive::get_header_data();
        return Datatables::of($documents_receive)->make(true);
    }
}
