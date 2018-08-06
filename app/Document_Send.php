<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document_Send extends Model
{
	protected $table = 'documents_send';
    protected $fillable = [
        'requested_by', 'submitted_to', 'send_to','letter_number', 'approval_status', 'note'
    ];

}
