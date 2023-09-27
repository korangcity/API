<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\Product;

class UpdateEditdOrder extends AbstractUpdateOrder
{
    public function execute()
    {
        $newProducts = $this->product->pluck('_id')->toArray();
        $newCounts = $this->count;

        $oldProducts = $this->getOldProducts();
        $oldCounts = $this->getOldCounts();

        $array_diff_products = array_diff($oldProducts->toArray(), $newProducts);
        $array_diff_products1 = array_diff($newProducts, $oldProducts->toArray());
        $array_diff_counts = array_diff((array)$newCounts, (array)$oldCounts);

        if (!empty($array_diff_products)) {
            foreach ($array_diff_products as $array_diff_product) {
                $indexOFArray = array_search($array_diff_product, $oldProducts);
                $deletedProductCount = $oldCounts[$indexOFArray];
                $product = Product::find($array_diff_product);
                $product->inventory += (int)$deletedProductCount;
                $product->save();
            }
        }

        if (!empty($array_diff_products1)) {
            foreach ($array_diff_products1 as $item) {
                $indexOFArray = array_search($item, $newProducts);
                $addedProductCount = $newCounts[$indexOFArray];
                $product = Product::find($addedProductCount);
                $product->inventory -= (int)$addedProductCount;
                $product->save();
            }
        }

        if (!empty($array_diff_counts)) {
            foreach ($array_diff_counts as $array_diff_count) {
                $indexOFArray = array_search($array_diff_count, $newCounts);
                $addedNewCountProduct = $newProducts[$indexOFArray];
                $oldCountItem = $oldCounts[$indexOFArray];
                $product = Product::find($addedNewCountProduct);

                if ((int)$array_diff_count > (int)$oldCountItem)
                    $product->inventory -= ((int)$array_diff_count - (int)$oldCountItem);
                else
                    $product->inventory += ((int)$oldCountItem - (int)$array_diff_count);

                $product->save();
            }
        }

        return $this->goToNext();
    }
}
