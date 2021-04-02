<?php

namespace Papeo\ApiRealisaprint\Controller\Index;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Context;
use Magento\Sales\Model\ResourceModel\Order;
use Papeo\ApiRealisaprint\Helper\RecuperationFichier;
use Papeo\ApiRealisaprint\Helper\TestEmail;
use Papeo\ApiRealisaprint\Helper\ApiExpedition;
use Magento\Sales\Model\Order\ItemRepository;
use Magento\Framework\Api\Search\SearchCriteria;


class Index extends \Magento\Framework\App\Action\Action
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


    /**
     * @var \Papeo\ApiRealisaprint\Model\ResourceModel\Item\Collection
     */

    /**
     * @var SearchCriteriaBuilder
     */
    private $_searchCriteriaBuilder;
    /**
     * @var SearchCriteria
     */
    private $_searchCriteria;


    public function __construct(Context $context, RecuperationFichier $recuperationFichier, ApiExpedition $apiExpedition,
                                RecuperationFichier $tracking_link,
                                Testemail $testEmail,
                                ItemRepository $itemRepository, SearchCriteriaBuilder $searchCriteriaBuilder,
                                SearchCriteria $searchCriteria,

                                \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory, Order $orderResourceModel)
    {
        parent::__construct($context);
        $this->_recuperationFichier = $recuperationFichier;
        $this->_apiExpedition = $apiExpedition;
        $this->_recuperationFichier = $tracking_link;
        $this->_testEmail = $testEmail;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_orderResourceModel = $orderResourceModel;
        $this->_itemRepository = $itemRepository;
        $this->_searchCriteria = $searchCriteria;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;

    }


    public function execute()
    {

        // $this->_testEmail->sendEmail();

        $infoTrack = $this->_recuperationFichier->recupTracking();

        if (isset($infoTrack["ref_order_realisaprint"]) && isset($infoTrack["tracking_link"]) && isset($infoTrack["tracking_number"])){
            $ref_order_realisaprint = $infoTrack["ref_order_realisaprint"];
            $tracking_link = $infoTrack["tracking_link"];
            $tracking_number = $infoTrack["tracking_number"];
        }


//on récupère l'id de l'item
        $this->_searchCriteriaBuilder->addFilter("numero_commande_fournisseur", $ref_order_realisaprint);


        $items = $this->_itemRepository->getList($this->_searchCriteriaBuilder->create());
        echo "<pre>";
        //var_dump($item->getData("item_id"));

        //$recupItem = $item->getData();
        $items->getFirstItem();

        if ($items->count() == 1) {
       //    var_dump($items->getFirstItem()->getData());
            $item = $items->getFirstItem();
            $item->setData("url_transporteur", $tracking_link);
            $this->_itemRepository->save($item);
            echo $item->getData("url_transporteur");

            if ($item->getData("url_transporteur")) {
                $this->_apiExpedition->createShipment($item, $tracking_number, $tracking_link);


            }
            else {
                mail('studio@papeo.fr', 'Fichier déjà traité', 'lors de l expé, fichier déjà traité');

            }

        } else {

            mail('studio@papeo.fr', 'Erreur maj Réalisaprint', 'erreur du traitement de l expé de realisaprint sur le fichier Controller\Index
            Index !');

        }


    }


    //}
}


