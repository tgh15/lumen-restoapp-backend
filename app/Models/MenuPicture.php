<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuPicture extends Model
{
    protected $fillable = [
        'url','menu_id'
    ];

    protected $hidden = [
        'category_menu_id', 'created_at','updated_at'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
