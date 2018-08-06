<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document_Receive_Detail extends Model
{
	protected $table = 'documents_receive_detail';
    protected $fillable = [
        'document_receive_id', 'description'
    ];
}
