<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_name'=>$this->user->name,
            'product_name'=>$this->products()->pluck('name'),
            'count'=>$this->products_count,
            'date'=>$this->created_at
        ];
    }


}
