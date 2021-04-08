<?php


namespace Papeo\Fidelite\Model\ResourceModel\Ventes
;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Papeo\Fidelite\Model\Ventes;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Ventes::class,\Papeo\Fidelite\Model\ResourceModel\Ventes::class);
    }

}
