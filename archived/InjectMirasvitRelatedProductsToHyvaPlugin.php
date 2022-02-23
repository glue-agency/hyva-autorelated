<?php

declare(strict_types=1);

namespace Glue\HyvaAutorelated\Plugin;

use Mirasvit\Related\Api\Data\BlockInterface;

class InjectMirasvitRelatedProductsToHyvaPlugin
{
    protected $layoutPosition = 'inject_related';

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
        //DISABLED
        return $items;
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
