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

    public function updatePic($request, $id){
        try {
            //code...
            $data = $this->findOrFail($id);
            $data->url = $request->url;
            $data->getDirty();
            $data->save();
            return $data;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function destroyPic($id){
        try {
            return $this->findOrFail($id)->delete(); 
        } catch (\Throwable $th) {
            return false;
        }
    }
}
