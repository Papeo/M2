<?php


namespace Papeo\Formation\Model\ResourceModel\Revendeur;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Papeo\Formation\Model\Revendeur;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Revendeur::class,\Papeo\Formation\Model\ResourceModel\Cadeau::class);
    }

}
