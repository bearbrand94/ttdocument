<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document_Send;
use Yajra\Datatables\Datatables;
use App\User;
use App\Client;
use Illuminate\Support\Facades\Auth;

class DocumentSendController extends Controller
{
    public function index()
    {
        return view('DocumentSendList');
    }

    public function new_form(){
        return view('DocumentSendCreate',
            [
                'clients' => Client::get_client_data()->orderBy("name", "asc")->get(),
                'users' => User::get_user_data()->where("roles.name", "staff")->orderBy("users.name", "asc")->get()
            ]
        );
    }

    public function store(Request $request)
    {
        $document_data = $request->document;
        $client_id = $request->client_id;
        $staff_id = $request->staff_id;
        $my_id = Auth::id();


        $document_data = new Document_Send();
        $document_data->letter_number = Document_Send::get_letter_number();
        $document_data->requested_by = $my_id;
        $document_data->submitted_to = $staff_id;
        $document_data->send_to = $client_id;
        $document_data->approval_status = 0;
        $document_data->note = "";

        // $new_documment_data = Document_Send::create($document_data);
        return $this->createSuccessMessage($document_data);
    }

    public function get_list(){
        $documents_send = Document_Send::get_header_data()->limit(1000);
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
