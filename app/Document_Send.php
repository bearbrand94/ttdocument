<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Document_Send extends Model
{
	protected $table = 'documents_send';
    protected $fillable = [
        'requested_by', 'submitted_to', 'send_to','letter_number', 'approval_status', 'note'
    ];

    public static function get_header_data(){
        $documents_send_header = DB::table('documents_send as ds')
		->join('users as user1', 'user1.id', '=', 'ds.requested_by')
		->join('users as user2', 'user2.id', '=', 'ds.submitted_to')
		->join('clients', 'clients.id', '=', 'ds.send_to')
		->select('ds.id', 'ds.created_at', 'ds.letter_number', 'user1.name as requested_by', 'user2.name as submitted_to', 'clients.name as send_to', 'ds.approval_status', 'ds.note');
		return $documents_send_header;
    }


    public static function get_detail($header_id){
    	$document_send_header = Document_Send::get_header_data();
        
    	$document_send_data['header'] = $document_send_header->where('ds.id', $header_id)->get()[0];

        $documents_send_detail = DB::table('documents_send_detail as dsd')
		->join('documents_send as ds', 'ds.id', '=', 'dsd.document_send_id')
		->select('dsd.id', 'dsd.created_at', 'dsd.description');

    	$document_send_data['detail'] = $documents_send_detail->where('ds.id', $header_id)->get();
    	return $document_send_data;
    }
}
