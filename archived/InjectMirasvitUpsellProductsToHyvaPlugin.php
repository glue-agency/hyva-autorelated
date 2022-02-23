<?php

declare(strict_types=1);

namespace Glue\HyvaAutorelated\Plugin;

use Mirasvit\Related\Api\Data\BlockInterface;

class InjectMirasvitUpsellProductsToHyvaPlugin
{
    protected $layoutPosition = 'inject_upsell';

    protected $blockRepository;

    protected $productFinderService;

    public function __construct(
        \Mirasvit\Related\Repository\BlockRepository $blockRepository,
        \Mirasvit\Related\Service\ProductFinderService $productFinderService
    ){
        $this->blockRepository      = $blockRepository;
        $this->productFinderService = $productFinderService;
    }

    public function afterGetLinkedItems($object, $items)
    {
        $block = $this->getBlock();

        if (!$block) {
            return $items;
        }

        return $this->productFinderService->getProducts($block)->getItems();
    }

    protected function getBlock(): ?BlockInterface
    {
        /** @var BlockInterface $block */
        $block = $this->blockRepository->getCollection()
            ->addFieldToFilter(BlockInterface::IS_ACTIVE, 1)
            ->addFieldToFilter(BlockInterface::LAYOUT_POSITION, $this->layoutPosition)
            ->getFirstItem();

        return $block->getId() ? $block : null;
    }

}
