<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use DB;

class Supervisor_Relation extends Model
{
	protected $table = 'supervisor_relation';
    protected $fillable = [
        'supervisor_id', 'staff_id'
    ];

    public static function get_relation_detail($supervisor_id){
        //Nomor surat adalah Nomor urut/Jenis Surat/Bulan/Tahun
        $results = DB::table('supervisor_relation as sr')->where('supervisor_id', $supervisor_id)->get();
        $staffs_data = Array();
        foreach ($results as $result) {
        	array_push($staffs_data, User::get_user_detail($result->staff_id));
        }
        return $staffs_data;
    }

    
}
