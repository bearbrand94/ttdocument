<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Supervisor_Relation;
use App\Staff_Relation;
use DB;

class RelationController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function supervisor_form(){
        $supervisors_data = User::get_user_data()->where("roles.name", "supervisor")->orderBy("users.name", "asc")->get();
        for ($i=0; $i < count($supervisors_data); $i++) { 
            $supervisors_data[$i]->staffs = Supervisor_Relation::get_relation_detail($supervisors_data[$i]->id);
        }
        return view('SupervisorRelationManager',
            [
                'staffs' => User::get_user_data()->where("roles.name", "staff")->orderBy("users.name", "asc")->get(),
                'supervisors' => $supervisors_data
            ]
        );
    }

    public function add_supervisor_relation(Request $request){
        $sr = new Supervisor_Relation();
        $sr->supervisor_id = $request->supervisor_id;
        $sr->staff_id = $request->staff_id;
        $sr->save();
        return $this->createSuccessMessage("Relasi Berhasil Ditambahkan");
    }

    public function remove_supervisor_relation(Request $request){
        $sr = DB::table('supervisor_relation')->where('supervisor_id', $request->supervisor_id)->where('staff_id', $request->staff_id)->delete();
        return $this->createSuccessMessage("Relasi Berhasil Dihapus");
    }

    public function staff_form(){
        $staffs_data = User::get_user_data()->where("roles.name", "staff")->orderBy("users.name", "asc")->get();
        for ($i=0; $i < count($staffs_data); $i++) { 
            $staffs_data[$i]->clients = Staff_Relation::get_relation_detail($staffs_data[$i]->id);
        }
        // return             [
        //         'clients' => Client::get_client_data()->get(),
        //         'staffs' => $staffs_data
        //     ];
        return view('StaffRelationManager',
            [
                'clients' => Client::get_client_data()->get(),
                'staffs' => $staffs_data
            ]
        );
    }

    public function add_staff_relation(Request $request){
        $sr = new Staff_Relation();
        $sr->staff_id = $request->staff_id;
        $sr->client_id = $request->client_id;
        $sr->save();
        return $this->createSuccessMessage("Relasi Berhasil Ditambahkan");
    }

    public function remove_staff_relation(Request $request){
        $sr = DB::table('staff_relation')->where('staff_id', $request->staff_id)->where('client_id', $request->client_id)->delete();
        return $this->createSuccessMessage("Relasi Berhasil Dihapus");
    }
}
