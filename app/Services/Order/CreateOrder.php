<?php

namespace App\Services\Order;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CreateOrder
{

    public function execute(Request $request)
    {
        $inputData = $this->sanitizeInputData($request);
        $products = Product::whereIn('_id',$inputData['product_id'])->get();
        $user = User::find($inputData['user_id']);

        $checkProductInventory = new CheckProductInventory($products, $inputData['count'], $user);
        $registerOrder = new RegisterOrder($products, $inputData['count'], $user);
        $updateProductInventory = new UpdateProductInventory($products, $inputData['count'], $user);

        $checkProductInventory->setNext($registerOrder);
        $registerOrder->setNext($updateProductInventory);

        $check = $checkProductInventory->execute();
//        return $check;

        return $check == false ? false : true;

    }

    private function sanitizeInputData(Request $request)
    {
        $user_id = sanitize($request->user_id);
        $product_ids = sanitize($request->product_id);
        $counts = sanitize($request->count);

        return ['user_id' => $user_id, 'product_id' => $product_ids, 'count' => $counts];
    }

}
