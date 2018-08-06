<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document_Send;
use Yajra\Datatables\Datatables;


class DocumentSendController extends Controller
{
    public function index()
    {
        return view('DocumentSendList');
    }

    public function get_list(){
        $documents_send = Document_Send::get_header_data();
        return Datatables::of($documents_send)->make(true);
    }

    public function get_detail(Request $request){
        $header_id = $request->id; 
        $documents_send = Document_Send::get_detail($header_id);

        // return $documents_send;

        return view('DocumentSendDetail', 
            [
                'header' => $documents_send['header'],
                'detail' => $documents_send['detail']
            ]
        );
    }

    public function print_detail(Request $request){
        $header_id = $request->id; 
        $documents_send = Document_Send::get_detail($header_id);

        // return $documents_send;

        return view('DocumentSendPrint', 
            [
                'header' => $documents_send['header'],
                'detail' => $documents_send['detail']
            ]
        );
    }
}
