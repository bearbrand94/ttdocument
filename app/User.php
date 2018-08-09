<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Checks if User has access to $permissions.
     */
    public function hasAccess(array $permissions) : bool
    {
        // check if the permission is available in user's role
        $roles = Role::where('id', $this->role_id)->firstOrFail();
            if($roles->hasAccess($permissions)) {
                return true;
            }
        return false;
    }

    public static function get_user_data(){
        $user_data = DB::table('users')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->select('users.id', 'users.name', 'users.email', 'roles.id as role_id', 'roles.name as role');
        return $user_data;
    }
}
