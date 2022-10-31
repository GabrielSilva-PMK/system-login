<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
    use HasFactory;

    protected $table = 'user_menu';

    protected $fillable = [
        'id_user',
        'id_menu',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id_user', 'id');
    }

    public function menu(){
        return $this->hasOne(Permission::class, 'id_menu', 'id');
    }
}
