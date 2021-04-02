<?php


namespace Papeo\ApiRealisaprint\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;
use \Papeo\ApiRealisaprint\Model\ResourceModel\Fournisseur;


class RenommerFournisseurExaprint implements DataPatchInterface
{


    /**
     * InsererFournisseurPatch constructor.
     */
    public function __construct(

        \Papeo\ApiRealisaprint\Model\FournisseurFactory $fournisseurFactory,
        \Papeo\ApiRealisaprint\Model\ResourceModel\Fournisseur $fournisseurResourceModel,
        \Papeo\ApiRealisaprint\Model\ResourceModel\Fournisseur\CollectionFactory $fournisseurCollectionFactory)

{
    $this->_fournisseurFactory = $fournisseurFactory;
    $this->_fournisseurResourceModel = $fournisseurResourceModel;
    $this->_fournisseurCollectionFactory = $fournisseurCollectionFactory;
}



    public static function getDependencies()
    {
        return [

            InsererFournisseurPatch::class

        ];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {

        /** @var   \Papeo\ApiRealisaprint\Model\ResourceModel\Fournisseur\Collection $fournisseurs */

        $fournisseurs = $this->_fournisseurCollectionFactory->create();

        $fournisseurs->addFieldToFilter("code_fournisseur", "EXA");

        if($fournisseurs->count() ==1) {

            $fournisseur = $fournisseurs->getFirstItem();
            $fournisseur->setData("code_fournisseur", "EXA2");
            $this->_fournisseurResourceModel->save($fournisseur);
        }


    }
}
