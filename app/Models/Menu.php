<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $fillable = [
        'id_menu_type',
        'name',
        'link',
        'icon',
        'order',
    ];

    /**
     * Get the menutype associated with the menu.
     */
    public function menutype()
    {
        return $this->hasOne(MenuType::class);
    }

    public function user()
    {
        return $this->hasMany(UserMenu::class, 'id_menu', 'id');
    }
}
