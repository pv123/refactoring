<?php

namespace Refactoring\Products;
use Refactoring\Products\Product;

class ProductManager {

    /**
     * @throws \Exception
     */
    public function decrementCounter(Product $product) {

        if ($product->price !== null && $product->price->getSign() > 0) {
            if ($product->counter === null) {
                throw new \Exception("null counter");
            }
            
            if ($product->counter < 0) {
                throw new \Exception("Negative counter");
            }
            
            return $product->counter - 1;
        } else {
            throw new \Exception("Invalid price");
        }
    }

    /**
     * @throws \Exception
     */
    public function incrementCounter($product) {
        if ($product->price !== null && $product->price->getSign() > 0) {
            if ($product->counter === null) {
                throw new \Exception("null counter");
            }

            if ($product->counter + 1 < 0) {
                throw new \Exception("Negative counter");
            }

            return $product->counter + 1;
        } else {
            throw new \Exception("Invalid price");
        }
    }
    
    public function changePriceTo(?BigDecimal $newPrice, Product $product)
    {
        if ($product->counter === null) {
            throw new \Exception("null counter");
        }

        if ($product->counter > 0) {
            if ($newPrice === null) {
                throw new \Exception("new price null");
            }

            return $newPrice;
        }
    }

}
