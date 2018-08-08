<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document_Receive;
use App\Document_Receive_Detail;
use Yajra\Datatables\Datatables;
use App\User;
use App\Client;
use Illuminate\Support\Facades\Auth;
use DB;

class DocumentReceiveController extends Controller
{
    public function index()
    {
        return view('DocumentReceiveList');
    }

    public function new_form(){
        return view('DocumentReceiveCreate',
            [
                'clients' => Client::get_client_data()->orderBy("name", "asc")->get(),
                'users' => User::get_user_data()->where("roles.name", "staff")->orderBy("users.name", "asc")->get()
            ]
        );
    }

    public function store(Request $request)
    {
        $arr_detail = json_decode($request->document);
        $client_id = $request->client_id;
        $staff_id = $request->staff_id;
        $my_id = Auth::id();

        DB::beginTransaction();
        $document_data = new Document_Receive();
        $document_data->letter_number = Document_Receive::get_letter_number();
        $document_data->receiver1 = $my_id;
        $document_data->receiver2 = $staff_id;
        $document_data->client = $client_id;
        $document_data->review_status = 0;
        $document_data->note = "";
        $document_data->save();

        foreach ($arr_detail as $detail) {
            $document_data_detail = new Document_Receive_Detail();
            $document_data_detail->document_receive_id = $document_data->id;
            $document_data_detail->description = $detail;
            $document_data_detail->save();
        }
        DB::commit();

        return $this->createSuccessMessage("Dokumen Berhasil Disimpan");
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
