<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\MenuCategory;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'status' => $this->status,
            'pictures' => PicturesResource::collection($this->picture)
            // 'category' => MenuCategory::where('id', $this->menu_category_id)->get()[0]
        ];
    }
}
