<?php


namespace Papeo\Fidelite\Model;



class VentesRepository
{
    public function __construct(

        \Papeo\Fidelite\Model\Ventesfactory $ventesFactory,
        \Papeo\Fidelite\Model\ResourceModel\Ventes $ventesResourceModel
        //,
    //    \Papeo\Fidelite\Model\ResourceModel\Cadeau\CollectionFactory $ventesCollectionFactory
    )

    {
        $this->_ventesFactory = $ventesFactory;
        $this->_ventesResourceModel = $ventesResourceModel;
       // $this->_ventesCollectionFactory = $ventesCollectionFactory;
           }





    // resourceModel est respo. de la traduction en mySql, donc : écriture, lecture, suppression (requete)
    // collection manipule plusieurs modèles où il y a les données.
    public function save($ventes)
    {
        $this->_ventesResourceModel->save($ventes);

    }



}
