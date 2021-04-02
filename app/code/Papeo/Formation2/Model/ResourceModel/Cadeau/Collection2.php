<?php


namespace Papeo\Formation2\Model\ResourceModel\Ventes;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Papeo\Formation2\Model\Cadeau;

class Collection2 extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Ventes::class,\Papeo\Formation2\Model\ResourceModel\Ventes::class);
    }

}
