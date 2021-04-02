<?php


namespace Papeo\ApiRealisaprint\Model;

use Magento\Framework\Model\AbstractModel;

// Abstract permet d'acceder aux méthodes save, create
class Fournisseur extends AbstractModel
{
    public function _construct()
    {

        $this->_init(\Papeo\ApiRealisaprint\Model\ResourceModel\Fournisseur::class);
    }
}
