<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class Document_Receive extends Model
{
	protected $table = 'documents_receive';
    protected $fillable = [
        'client', 'receiver1', 'receiver2','letter_number', 'review_status', 'note'
    ];

    public static function hasAccess($id){
        if(Auth::User()->role_id != 1){
            return true;
        };
        
    }

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
        		->join('clients', 'clients.id', '=', 'dr.client');

                // ->join('staff_relation as sr1', 'sr1.staff_id', '=', 'dr.receiver1')
                // if(Auth::User()->role_id != 1){
                //     $documents_receive_header->join('staff_relation as sr', 'sr.client_id', '=', 'dr.client');
                // }

        $documents_receive_header->select('dr.id', 'dr.created_at', 'dr.letter_number', 'user1.name as r1_name', 'user2.name as r2_name', 'clients.name as client_name', 'clients.address as client_address', 'clients.phone as client_phone', 'clients.email as client_email', 'dr.review_status', 'dr.note')
                ->where(function ($query) {
                    if(Auth::User()->role_id > 2){
                        $query->where('dr.receiver1', Auth::User()->id)
                              ->orWhere('dr.receiver2', Auth::User()->id);
                    };
                });
		return $documents_receive_header;
    }

    public static function get_detail($header_id){
        $document_receive_header = Document_Receive::get_header_data();
        if(count($document_receive_header->get())>0){
            $document_receive_data['header'] = $document_receive_header->where('dr.id', $header_id)->get()[0];

            $documents_receive_detail = DB::table('documents_receive_detail as drd')
            ->join('documents_receive as dr', 'dr.id', '=', 'drd.document_receive_id')
            ->select('drd.id', 'drd.created_at', 'drd.description');

            $document_receive_data['detail'] = $documents_receive_detail->where('dr.id', $header_id)->get();
            return $document_receive_data;    
        }

    }

    public function accept($id, $note){
        $obj = Document_Receive::findOrFail($id);
        $data['review_status'] = 1;
        $data['note'] = $note;
        $obj->update($data);
        return $obj;
    }
    
    public function reject($id, $note){
        $obj = Document_Receive::findOrFail($id);
        $data['review_status'] = 2;
        $data['note'] = $note;
        $obj->update($data);
        return $obj;
    }
}
