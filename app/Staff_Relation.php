<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;
use DB;
class Staff_Relation extends Model
{
	protected $table = 'staff_relation';
    protected $fillable = [
        'client_id', 'staff_id'
    ];

    public static function get_relation_detail($staff_id){
        //Nomor surat adalah Nomor urut/Jenis Surat/Bulan/Tahun
        $results = DB::table('staff_relation as sr')->where('staff_id', $staff_id)->get();
        $clients_data = Array();
        foreach ($results as $result) {
        	array_push($clients_data, Client::get_client_detail($result->client_id));
        }
        return $clients_data;
    }

    
}
