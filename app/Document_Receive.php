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

    public static function get_letter_number(){
        //Nomor surat adalah Nomor urut/Jenis Surat/Bulan/Tahun

        $results = DB::select( DB::raw("
            SELECT count(*)+1 as no_urut
            FROM documents_receive
            WHERE substr(created_at,1,7)=:date_now
        "), array(
           'date_now' => date("Y-m"),
        ));

        $no_surat = $results[0]->no_urut."/RECEIVE/".date("m/Y");

        return $no_surat;
    }

    public static function get_header_data(){
        $documents_receive_header = DB::table('documents_receive as dr')
        		->join('users as user1', 'user1.id', '=', 'dr.receiver1')
        		->join('users as user2', 'user2.id', '=', 'dr.receiver2')
        		->join('clients', 'clients.id', '=', 'dr.client')

        		->select('dr.id', 'dr.created_at', 'dr.letter_number', 'user1.name as r1_name', 'user2.name as r2_name', 'clients.name as client_name', 'clients.address as client_address', 'clients.phone as client_phone', 'clients.email as client_email', 'dr.review_status', 'dr.note');
		return $documents_receive_header;
    }

    public static function get_detail($header_id){
        $document_receive_header = Document_Receive::get_header_data();
        
        $document_receive_data['header'] = $document_receive_header->where('dr.id', $header_id)->get()[0];

        $documents_receive_detail = DB::table('documents_receive_detail as drd')
        ->join('documents_receive as dr', 'dr.id', '=', 'drd.document_receive_id')
        ->select('drd.id', 'drd.created_at', 'drd.description');

        $document_receive_data['detail'] = $documents_receive_detail->where('dr.id', $header_id)->get();
        return $document_receive_data;
    }
}
