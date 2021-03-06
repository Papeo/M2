<?php


namespace Papeo\Formation2\Model\ResourceModel\Compta
;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Papeo\Formation2\Model\Ventes;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Ventes::class,\Papeo\Formation2\Model\ResourceModel\Compta::class);
    }

}
