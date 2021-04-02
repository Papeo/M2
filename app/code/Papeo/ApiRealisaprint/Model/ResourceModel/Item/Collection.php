<?php


namespace Papeo\ApiRealisaprint\Model\ResourceModel\Item;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Papeo\ApiRealisaprint\Model\Item;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Item::class,\Papeo\ApiRealisaprint\Model\ResourceModel\Item::class);
    }

}
