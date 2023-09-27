<?php

namespace App\Services\Order;

use App\Models\Product;

class CheckUpdateProductInventory extends AbstractUpdateOrder
{
    public function execute()
    {

        $oldProducts = $this->order->products()->pluck('_id')->toArray();

        $oldCounts = $this->order->products_count;

        foreach ($this->product as $key => $item) {

            if (!in_array($item->id, $oldProducts))
                $count = (int)$this->count[$key];
            else
                $count = ((int)$this->count[$key] - (int)$oldCounts[array_search($item->id, $oldProducts)]);

            $product_inventory = $item->inventory;
            $checkInventory = [];
            if (((int)$product_inventory <= 0) or ($count > 0 and $count > (int)$product_inventory)) {
                $checkInventory[] = false;
            }
        }

        return !in_array(false, $checkInventory) ? $this->goToNext() : false;
    }

}
