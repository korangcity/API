<?php

namespace App\Services\Order;

use App\Models\Order;

abstract class AbstractUpdateOrder
{

    protected $order;
    protected $product;
    protected $count;

    protected $next;

    protected $oldProducts;
    protected $oldCounts;

    public function __construct($order, $product, $count)
    {
        $this->product = $product;
        $this->count = $count;

        $this->order = $order;
    }

    public function setNext(AbstractUpdateOrder $next): void
    {
        $this->next = $next;
    }

    public function goToNext()
    {
        return $this->next ? $this->next->execute() : true;
    }

    abstract public function execute();

    /**
     * @param mixed $oldProducts
     */
    public function setOldProducts($oldProducts): void
    {
        $this->oldProducts = $oldProducts;
    }

    /**
     * @return mixed
     */
    public function getOldProducts()
    {
        return $this->oldProducts;
    }

    /**
     * @return mixed
     */
    public function getOldCounts()
    {
        return $this->oldCounts;
    }

    /**
     * @param mixed $oldCounts
     */
    public function setOldCounts($oldCounts): void
    {
        $this->oldCounts = $oldCounts;
    }
}
