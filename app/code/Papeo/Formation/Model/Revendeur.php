<?php


namespace Papeo\Formation\Model;

use Magento\Framework\Model\AbstractModel;

// Abstract permet d'acceder aux méthodes save, create
class Revendeur extends AbstractModel
{
    public function _construct()
    {

        $this->_init(\Papeo\Formation\Model\ResourceModel\Revendeur::class);
    }
}
