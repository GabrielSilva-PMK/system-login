<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    protected $table = 'user_permission';

    protected $fillable = [
        'id_user',
        'id_permission',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id_user', 'id');
    }

    public function permission(){
        return $this->hasOne(Permission::class, 'id_permission', 'id');
    }
}
