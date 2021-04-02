<?php


namespace Papeo\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class InsererFournisseurPatch implements DataPatchInterface
{


    /**
     * InsererFournisseurPatch constructor.
     */
    public function __construct(

        \Papeo\ApiRealisaprint\Model\FournisseurFactory $fournisseurFactory,
        \Papeo\Formation2\Model\ResourceModel\ApiRealisaprint\Fournisseur $fournisseurResourceModel)

{
    $this->_fournisseurFactory = $fournisseurFactory;
    $this->_fournisseurResourceModel = $fournisseurResourceModel;
}



    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        //on insère un fournisseur dans la table papeo_fournisseur
        $fournisseur = $this->_fournisseurFactory->create();
        $fournisseur->setData("code_fournisseur", "EXA");
        $fournisseur->setData("libelle_fournisseur", "Exaprint");

        $this->_fournisseurResourceModel->save($fournisseur);
    }
}
