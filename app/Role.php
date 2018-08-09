<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    //
    protected $fillable = [
        'name', 'permissions'
    ];
    protected $casts = [
        'permissions' => 'array',
    ];

    public function users()
    {
        return User::where('role_id', $this->id)->firstOrFail();
    }

    public function hasAccess(array $permissions) : bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission))
                return true;
        }
        return false;
    }

    private function hasPermission(string $permission) : bool
    {
        return $this->permissions[$permission] ?? false;
    }
}
