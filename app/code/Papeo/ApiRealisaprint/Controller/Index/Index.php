<?php

namespace Papeo\ApiRealisaprint\Controller\Index;
use Magento\Framework\App\Action\Context;
use Magento\Sales\Model\ResourceModel\Order;
use Papeo\ApiRealisaprint\Helper\RecuperationFichier;
use Papeo\ApiRealisaprint\Helper\TestEmail;
use Papeo\ApiRealisaprint\Helper\ApiExpedition;



class Toto extends \Magento\Framework\App\Action\Action
{

    /**
     * @var RecuperationFichier
     */
    private RecuperationFichier $_recuperationFichier;
    /**
     * @var ApiExpedition
     */
    private ApiExpedition $_apiExpedition;

    /**
     * @var Order
     */
    private Order $_orderResourceModel;
    /**
     * @var Order\CollectionFactory
     */
    private Order\CollectionFactory $_orderCollectionFactory;

    public function __construct(Context $context, RecuperationFichier $recuperationFichier, ApiExpedition $apiExpedition,
    RecuperationFichier $tracking_link,
    Testemail $testEmail,

    \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory, Order $orderResourceModel)
        {
            parent::__construct($context);
            $this->_recuperationFichier = $recuperationFichier;
            $this->_apiExpedition = $apiExpedition;
            $this->_recuperationFichier = $tracking_link;
            $this->_testEmail = $testEmail;
            $this->_orderCollectionFactory = $orderCollectionFactory;
            $this->_orderResourceModel = $orderResourceModel;

        }


    public function execute() {

       // $this->_testEmail->sendEmail();





        $infoTrack = $this->_recuperationFichier->recupTracking();


            $tracking_number =  $infoTrack->{'product'}->{'tracking_number'};
            $tracking_link = $infoTrack->{'product'}->{'tracking_link'};
        $ref_order_realisaprint = $infoTrack->{'ref_order_realisaprint'};

echo $tracking_number."///". $tracking_link."//".$ref_order_realisaprint;
           // exit("");

            //Charger la commande avec le n° de commande fournisseur

        /**
         * @var \Magento\Sales\Model\ResourceModel\Order\Collection $collectionCommandes;
         */
        $collectionCommandes = $this->_orderCollectionFactory->create();

        //construction de la partie where (On renseigne la table et un tableau pour le type de condition)
        //si je veux un like = ["like" => "%".$ref_order_realisaprint]);
        $collectionCommandes->addFieldToFilter("numero_commande_fournisseur",$ref_order_realisaprint);
     //   exit("df");
        if($collectionCommandes->count()==1) {

            // on va lire l'enregistrement
            $commande = $collectionCommandes->getFirstItem();

            //sauvergarder la commande
            $commande->setData("url_transporteur",$tracking_link);
            $this->_orderResourceModel->save($commande);

            $this->_apiExpedition->createShipment($commande->getId(),$tracking_number);
        }else {
            exit ("commande non trouvée");
        }






    }
}


