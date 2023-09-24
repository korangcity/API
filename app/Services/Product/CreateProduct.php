<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Http\Request;

class CreateProduct
{

    public function execute(Request $request)
    {
        $inputs=[
            'name'=>sanitize($request->name),
            'price'=>sanitize($request->price),
            'inventory'=>sanitize($request->inventory),
        ];

        Product::create($inputs);
        return true;
    }

}
