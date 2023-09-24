<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($item){
            return [
                'name'=>$item->name,
                'price'=>$item->price,
                'inventory'=>$item->inventory
            ];
        });
    }

    public function with($request)
    {
        return [
            'status' => true
        ];
    }
}
