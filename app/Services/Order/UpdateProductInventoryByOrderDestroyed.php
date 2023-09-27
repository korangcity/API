<?php

namespace App\Services\Order;

class UpdateProductInventoryByOrderDestroyed
{

    private $products;
    private $counts;

    public function __construct($products,$counts)
    {
        $this->products = $products;
        $this->counts = $counts;
    }

    public function execute()
    {
        foreach ($this->products as $key => $product) {
            $product->inventory += $this->counts[$key];
            $product->save();
        }
    }
}
