<?php


namespace Papeo\ApiRealisaprint\Model\ResourceModel\Fournisseur;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Papeo\ApiRealisaprint\Model\Fournisseur;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Fournisseur::class,\Papeo\ApiRealisaprint\Model\ResourceModel\Fournisseur::class);
    }

}
