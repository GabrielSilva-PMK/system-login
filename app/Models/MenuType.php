<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
    use HasFactory;

    protected $table = 'menu_type';

    protected $fillable = [
        'name',
    ];

    /**
     * Get the menu that owns the profile.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
