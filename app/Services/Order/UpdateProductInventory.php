<?php

namespace App\Services\Order;

class UpdateProductInventory extends AbstractOrder
{

    public function execute()
    {
        foreach ($this->product as $key => $item) {
            $item->inventory -= $this->count[$key];
            $item->save();
        }
        return $this->goToNext();
    }
}
