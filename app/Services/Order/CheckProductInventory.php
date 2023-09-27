<?php

namespace App\Services\Order;

use App\Models\Product;

class CheckProductInventory extends AbstractOrder
{
    public function execute()
    {
        foreach ($this->product as $key => $item) {

            $product_inventory = $item->inventory;
            $checkInventory = [];
            if (((int)$product_inventory <= 0) or ((int)$this->count[$key] > (int)$product_inventory)) {
                $checkInventory[] = false;
            }
        }

        return !in_array(false, $checkInventory) ? $this->goToNext() : false;
    }

}
