<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    public $table = 'emails';
    
    protected $fillable = [
        'fromName',
        'fromEmail',
        'toEmail',
        'subject',
        'body',
        'status',
        'format',
        'isHtml'
    ];
}
