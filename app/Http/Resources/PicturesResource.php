<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PicturesResource extends JsonResource
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
            // 'menu_id' => $this->menu_id,
            'url' => $this->url
        ];
    }
}
