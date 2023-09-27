<?php

namespace App\Services\Order;

use Illuminate\Http\Request;

class UpdateOrder extends AbstractUpdateOrder
{
    public function execute()
    {
        $total_price = $this->getTotalPrice($this->count, $this->product);
        $ids = $this->product->pluck('_id')->toArray();
        $input = [
            'products_count' => $this->count,
            'total_price' => $total_price,
        ];
        $this->order->update($input);
        $this->order->products()->sync($ids);

        return $this->goToNext();

    }


    private function getTotalPrice($counts, $products)
    {
        foreach ($products as $key => $product) {
            $total_prices[] = $counts[$key] * $product->price;
        }
        return array_sum($total_prices);
    }

}
