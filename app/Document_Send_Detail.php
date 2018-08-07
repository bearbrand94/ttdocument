<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document_Send_Detail extends Model
{
	protected $table = 'documents_send_detail';
    protected $fillable = [
        'document_send_id', 'description'
    ];
}
