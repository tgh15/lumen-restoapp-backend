<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable = [
        'category_name'
    ];

    public function menu(){
        return $this->hasMany(Menu::class);
    }
    
    public function pictures(){
        return $this->hasManyThrough(MenuPicture::class, Menu::class);
    }

    public function storeCategory($request){
        $data = [
            'category_name' => $request->category_name
        ];
        return $this->create($data);
    }

    public function updateCategory($request, $id){
        $data = $this->findOrFail($id)->update(['category_name' => $request->category_name]);
        return $data;
    }

    public function getCategories(){
        return $this->all();
    }

    public function showCategory($id){
        try {
            //code...
            $data = $this->where('id', $id)->with(['menu' => function($query){
                $query->with('picture');
            }])->get();
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }

    public function destroyCategory($id){
        try {
            //code...
            return $this->findOrFail($id)->delete();
        } catch (\Throwable $th) {
            return false;
        }
    }
}
