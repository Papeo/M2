<?php


namespace Papeo\Formation2\Model;


use Papeo\Formation2\Api\CadeauRepositoryInterface;
use Papeo\Formation2\Helper\Papeo;

class CadeauRepository implements CadeauRepositoryInterface
{
    public function __construct(

        \Papeo\Formation2\Model\CadeauFactory $cadeauFactory,
        \Papeo\Formation2\Model\ResourceModel\Cadeau $cadeauResourceModel,
        \Papeo\Formation2\Model\ResourceModel\Cadeau\CollectionFactory $cadeauCollectionFactory,
        Papeo $papeo)

    {
        $this->_cadeauFactory = $cadeauFactory;
        $this->_cadeauResourceModel = $cadeauResourceModel;
        $this->_cadeauCollectionFactory = $cadeauCollectionFactory;
        $this->_papeo = $papeo;
    }

    public function getById($id)
    {

        $cadeau = $this->_cadeauFactory->create();
        // le load attend en param l'objet vide à charger, et la valeur de la clé primaire.
        $this->_cadeauResourceModel->load($cadeau, $id);
        return $cadeau;

    }

    public function getList()
    {
        $cadeau = $this->_cadeauCollectionFactory->create();
        return $cadeau;
    }

    public function deleteById($id)
    {
        $cadeau = $this->getById($id);
        $this->_cadeauResourceModel->delete($cadeau);

    }

    public function saveData(array $data) {
        $cadeau = $this->_cadeauFactory->create();
        $cadeau->addData($data);
        $this->save($cadeau);
    }

    // resourceModel est respo. de la traduction en mySql, donc : écriture, lecture, suppression (requete)
    // collection manipule plusieurs modèles où il y a les données.
    public function save($cadeau)
    {
        $this->_cadeauResourceModel->save($cadeau);

    }


    public function calculeSurface($hauteur, $largeur)
    {
    return $this->_papeo->calculeSurface($hauteur,$largeur);
    }
}
