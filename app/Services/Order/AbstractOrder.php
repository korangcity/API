<?php

namespace App\Services\Order;

use App\Models\Product;
use App\Models\User;

abstract class AbstractOrder
{
    protected $product;
    protected $count;

    protected $next;
    protected User $user;

    public function __construct($product, $count, User $user)
    {
        $this->product = $product;
        $this->count = $count;
        $this->user = $user;
    }

    /**
     * @param mixed $next
     */
    public function setNext(AbstractOrder $next): void
    {
        $this->next = $next;
    }

    public function goToNext()
    {
        return $this->next ? $this->next->execute() : true;
    }

    abstract public function execute();

}
