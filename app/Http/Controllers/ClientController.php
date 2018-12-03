<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
Use App\Client;
use App\Staff_Relation;
use App\User;
use Validator;

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

    public function detail(Request $request){
        $client_data = Client::get_client_detail($request->id);
        $client_data->staffs = Staff_Relation::get_staff_handle($request->id);
        return view('ClientProfile', [
            'client_data' => $client_data
        ]);
    }

    public function update_form(Request $request){
    	$client_data = Client::get_client_detail($request->id);
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

        $staff_handle = User::get_user_data()->where("roles.name", "staff")->inRandomOrder()->get()[0];
        $staff_relation = new Staff_Relation();
        $staff_relation->staff_id = $staff_handle->id;
        $staff_relation->client_id = $client_data->id;
        $staff_relation->save();
        DB::commit();
        return $this->createSuccessMessage("Data Client Berhasil Disimpan. Client Ditangani Oleh Staff: ". $staff_handle->name);
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
