<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class RegisterOrder extends AbstractOrder
{
    public function execute()
    {
        $total_price = $this->getTotalPrice($this->count, $this->product);
        $ids=$this->product->pluck('_id')->toArray();
        $input = [
            'user_id' => $this->user->id,
            'products_count' => $this->count,
            'total_price' => $total_price,
        ];
        $order = Order::create($input);
        $order->products()->sync($ids);
        return $this->goToNext();
    }

    private function getTotalPrice($counts,$products)
    {
        foreach ($products as $key => $product) {
            $total_prices[] = $counts[$key] * $product->price;
        }
        return array_sum($total_prices);
    }


}
