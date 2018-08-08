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

    public function new_form(){
        return view('ClientCreate');
    }

    public function update_form(Request $request){
    	$client_data = Client::get_client_data()->where('id', $request->id)->get()[0];
        return view('ClientUpdate', [
        	'client_data' => $client_data
        ]);
    }

    public function store(Request $request)
    {
        $name = $request->client_name;
        $address = $request->client_address;
        $phone = $request->client_phone;
        $email = $request->client_email;

        DB::beginTransaction();
        $client_data = new Client();
        $client_data->name = $name;
        $client_data->email = $email;
        $client_data->address = $address;
        $client_data->phone = $phone;
        $client_data->save();
        DB::commit();
        
        return $this->createSuccessMessage("Data Client Berhasil Disimpan.");
    }

    public function update(Request $request)
    {
    	$id = $request->client_id;
        $name = $request->client_name;
        $address = $request->client_address;
        $phone = $request->client_phone;
        $email = $request->client_email;

        $client_obj = Client::findOrFail($id);
        $client_data['name'] = $name;
        $client_data['email'] = $email;
        $client_data['address'] = $address;
        $client_data['phone'] = $phone;
        $client_obj->update($client_data);
        
        return $this->createSuccessMessage("Data Client Berhasil Diubah.");
    }
}
