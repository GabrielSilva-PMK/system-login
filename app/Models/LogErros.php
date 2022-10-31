<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogErros extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'Message',
        'Code',
        'File',
        'Line',
        'TraceAsString'
    ];
}
