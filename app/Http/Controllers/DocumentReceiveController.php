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
        $documents_receive = Document_Receive::get_header_data()->limit(1000);
        return Datatables::of($documents_receive)->make(true);
    }


    public function get_detail(Request $request){
        $header_id = $request->id; 
        $documents_receive = Document_Receive::get_detail($header_id);

        // return $documents_send;

        return view('DocumentReceiveDetail', 
            [
                'header' => $documents_receive['header'],
                'detail' => $documents_receive['detail']
            ]
        );
    }

    public function print_detail(Request $request){
        $header_id = $request->id; 
        $documents_receive = Document_Receive::get_detail($header_id);

        // return $documents_send;

        return view('DocumentReceivePrint', 
            [
                'header' => $documents_receive['header'],
                'detail' => $documents_receive['detail']
            ]
        );
    }
}
