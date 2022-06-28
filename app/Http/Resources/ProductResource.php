<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,                
            'description'   => $this->description,
            'image'         => $this->image,
            'brand'         => $this->brand,
            'price'         => $this->price,
            'price_sale'    => $this->price_sale,
            'category'      => $this->category,
            'stock'         => $this->stock,
        ];
    }
}
