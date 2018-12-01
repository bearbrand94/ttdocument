<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $my_id = Auth::User();
        $data['role'] = Role::find($my_id->role_id);

        return view('home', $data);
    }

    public function my_profile()
    {
        $user_data = Auth::User();
        $data['detail'] = $user_data;
        $data['role'] = Role::find($user_data->role_id);

        return view('UserProfile', $data);
    }

    public function change_password_form()
    {
        $user_data = Auth::User();
        $data['detail'] = $user_data;
        $data['role'] = Role::find($user_data->role_id);

        return view('ChangePassword', $data);
    }

    public function change_password(Request $request)
    {
        $user_data = Auth::User();
        $old_password = $request->old_password;
        $new_password = $request->new_password;

        if( Auth::attempt(
                [
                'email' => Auth::User()->email,
                'password' => $old_password
                ]
            )
        )
        {
            $user = User::find(Auth::id());
            $user->password = Hash::make($new_password);
            $user->save();
            return $this->createSuccessMessage("Berhasil Merubah Password");
        }
        else{
            return $this->createErrorMessage("Password Lama Tidak Sesuai");
        };
    }
}
