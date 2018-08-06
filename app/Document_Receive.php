<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Document_Receive extends Model
{
	protected $table = 'documents_receive';
    protected $fillable = [
        'client', 'receiver1', 'receiver2','letter_number', 'review_status', 'note'
    ];

    public static function get_header_data(){
        $documents_receive_header = DB::table('documents_receive as dr')
        		->join('users as user1', 'user1.id', '=', 'dr.receiver1')
        		->join('users as user2', 'user2.id', '=', 'dr.receiver2')
        		->join('clients', 'clients.id', '=', 'dr.client')

        		->select('dr.id', 'dr.created_at', 'dr.letter_number', 'user1.name as r1_name', 'user2.name as r2_name', 'clients.name as client_name', 'dr.review_status', 'dr.note');
		return $documents_receive_header;
    }
}
