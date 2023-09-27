<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class EditOrder
{
    public function execute(Request $request)
    {

        $inputData = $this->sanitizeInputData($request);
        $products = Product::whereIn('_id', $inputData['product_id'])->get();
        $user = User::find($inputData['user_id']);
        $order = Order::find($inputData['order_id']);

        $oldProducts=$order->products()->pluck('_id');
        $oldCounts=$order->products_count;

        $checkProductInventory = new CheckUpdateProductInventory($order,$products, $inputData['count']);
        $updateOrder=new UpdateOrder($order,$products, $inputData['count']);
        $updateEditedOrder=new UpdateEditdOrder($order,$products,$inputData['count']);

        $checkProductInventory->setNext($updateOrder);
        $updateOrder->setNext($updateEditedOrder);

        $updateEditedOrder->setOldProducts($oldProducts);
        $updateEditedOrder->setOldCounts($oldCounts);

        $check = $checkProductInventory->execute();
//        return $check;

        return $check == false ? false : true;

    }

    private function sanitizeInputData(Request $request)
    {
        $order_id = sanitize($request->order_id);
        $user_id = sanitize($request->user_id);
        $product_ids = sanitize($request->product_id);
        $counts = sanitize($request->count);

        return ['order_id' => $order_id, 'user_id' => $user_id, 'product_id' => $product_ids, 'count' => $counts];
    }
}
