<?php


namespace Papeo\Formation2\Model\ResourceModel\Cadeau;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Papeo\Formation2\Model\Cadeau;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Cadeau::class,\Papeo\Formation2\Model\ResourceModel\Cadeau::class);
    }

}
