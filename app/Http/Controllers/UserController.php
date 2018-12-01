<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
use App\User;
use App\Role;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('UserList');
    }

    public function get_list(){
        $user_data = User::get_user_data();
        return Datatables::of($user_data)->make(true);
    }

    public function change_access_form(Request $request){
        $header_id = $request->user_id; 
        $user_detail = User::get_user_detail($header_id);
        $role_list = Role::all();
        return view('UserChangeAccess', 
            [
                'header' => $header_id,
                'detail' => $user_detail,
                'role_list' => $role_list
            ]
        );
    }

    public function change_access(Request $request){
        $validator = Validator::make(
            array(
                "user_id"      => $request->user_id,
                "role_id"      => $request->role_id
            ),
            array(
                "user_id"      => 'required|exists:users,id',
                "role_id"      => 'required|exists:roles,id'
            )
        );
        if ($validator->fails()){
            $messages = $validator->messages();
            foreach ($messages->all() as $key => $value) {
                return $this->createErrorMessage($value);
            }
        }

        $user = User::find($request->user_id);
        $user->role_id = $request->role_id;
        $user->save();
        return $this->createSuccessMessage("Hak Akses Berhasil Diubah.");
    }
}
