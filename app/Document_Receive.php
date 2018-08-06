<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document_Receive extends Model
{
	protected $table = 'documents_receive';
    protected $fillable = [
        'client', 'receiver1', 'receiver2','letter_number', 'review_status', 'note'
    ];
}
