<?php

declare(strict_types=1);

namespace Glue\HyvaAutorelated\Plugin;

class InjectAmastyRelatedProductsToHyvaPlugin
{
    public function __construct(
        \Amasty\Mostviewed\Plugin\Community\Related $relatedProduct
    ){
        $this->relatedProduct = $relatedProduct;
    }

    public function afterGetLinkedItems($object, $items)
    {
        $items = $this->relatedProduct->afterGetItems($object, $items);

        return $items;
    }
}
