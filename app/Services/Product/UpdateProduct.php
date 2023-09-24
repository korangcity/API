<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Http\Request;

class UpdateProduct
{

    public function execute(Request $request)
    {
        $product=Product::find(sanitize($request->id));
        $product->name=sanitize($request->name);
        $product->price=sanitize($request->price);
        $product->inventory=sanitize($request->inventory);

        $product->save();

        return true;

    }

}
