<?php

namespace Refactoring\Products;

use Refactoring\Products\Product;

class ProductFormatter {

    public function replaceCharFromDesc(?string $charToReplace, ?string $replaceWith, Product $product): array {
        if ($product->longDesc === null || empty($product->longDesc) || $product->desc === null || empty($product->desc)) {
            throw new \Exception("null or empty desc");
        }

        $product->longDesc = str_replace($charToReplace, $replaceWith, $product->longDesc);
        $product->desc = str_replace($charToReplace, $replaceWith, $product->desc);

        return [
            'longDesc' => $product->longDesc,
            'desc' => $product->desc
        ];
    }

    public function formatDesc(Product $product): string {
        if (($product->longDesc === null || empty($product->longDesc)) && ($product->desc === null || empty($product->desc))) {
            throw new \Exception("null or empty desc");
        }

        if (($product->longDesc !== null || !empty($product->longDesc)) && (!$product->desc === null || !empty($product->desc))) {
            return $product->desc . " *** " . $product->longDesc;
        } elseif (($product->longDesc === null || empty($product->longDesc)) && ($product->desc !== null || !empty($product->desc))) {
            return $product->desc;
        } elseif (($product->longDesc !== null || !empty($product->longDesc)) && ($product->desc === null || empty($product->desc))) {
            return $product->longDesc;
        }
    }

}
