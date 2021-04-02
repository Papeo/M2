<?php


namespace Papeo\ApiRealisaprint\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Fournisseur extends AbstractDb {

    public function _construct()   {
        // permet de faire le lien ente les requetes SQL et la classe Objet Revendeur de Magento
        // Les paramètres sont la table et la clé primaire.
    $this->_init("papeo_fournisseur","fournisseur_id");
    }
}

