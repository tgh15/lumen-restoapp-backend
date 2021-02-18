<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\MenuPicture;

class Menu extends Model
{
    protected $fillable = [
        'name', 'price', 'description', 'menu_category_id', 'status'
    ];

    protected $hidden = [
        'category_menu_id'
    ];

    public function category(){
        return $this->belongsTo(MenuCategory::class);
    }

    public function picture(){
        return $this->hasMany(MenuPicture::class);
    }

    public function getMenus(){
        return $this->with('picture')->get();
    }

    public function storeMenu($request){
        try {
            $this->name = $request->name;
            $this->price = $request->price;
            $this->description = $request->description;
            $this->menu_category_id = $request->menu_category_id;
            $this->save();
            if ($request->pictures != []) {
                for ($i=0; $i < count($request->pictures); $i++) { 
                    $pictures = new MenuPicture;
                    $pictures->url = $request->pictures[$i]['url'];
                    $this->picture()->save($pictures);
                }
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function showMenu($id){
        try {
            $data = $this->where('id', $id)->with('picture')->get();
            return $data;
            //code...
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function destroyMenu($id){
        try {
            //code...
            return $this->findOrFail($id)->delete();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateMenu($request, $id){
        $this->find($id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'menu_category_id' => $request->menu_category_id,
        ]);
        return true;
    }
}
