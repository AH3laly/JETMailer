<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTAServer extends Model
{
    use HasFactory;

    public $table = 'mta_servers';
    
    protected $fillable = [
        'host',
        'port',
        'security',
        'username',
        'password',
        'failures',
        'enabled'
    ];
}
