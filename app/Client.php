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

    private static function select_client(){
		return DB::table('clients')
		->select('clients.id', 'clients.name', 'clients.email', 'clients.address', 'clients.phone');
    }

    public static function get_client_data(){
        $client_data = Client::select_client();
        return $client_data;
    }

    public static function get_client_detail($client_id){
        $client_data = Client::select_client()->where('clients.id', $client_id)->get()[0];
        return $client_data;
    }
}
