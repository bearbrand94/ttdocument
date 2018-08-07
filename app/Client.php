<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Client extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'address','phone'
    ];

    public static function get_client_data(){
        $client_data = DB::table('clients')
		->select('clients.id', 'clients.name', 'clients.email', 'clients.address', 'clients.phone');
        return $client_data;
    }
}
