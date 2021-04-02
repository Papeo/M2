<?php


namespace Papeo\Formation2\Model\ResourceModel\ApiRealisaprint;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Papeo\ApiRealisaprint\Model\ApiRealisaprint;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(ApiRealisaprint::class,\Papeo\Formation2\Model\ResourceModel\ApiRealisaprint::class);
    }

}
