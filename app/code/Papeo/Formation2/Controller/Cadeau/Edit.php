<?php

namespace Papeo\Formation2\Controller\Cadeau;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Papeo\Formation2\Model\Cadeau;
use Papeo\Formation2\Model\CadeauFactory;

class Update extends \Magento\Framework\App\Action\Action
{


    /**
     * @var CadeauFactory
     */
    private CadeauFactory $_cadeauFactory;
    private \Papeo\Formation2\Model\ResourceModel\Cadeau\CollectionFactory $_cadeauCollectionFactory;
    /**
     * @var Cadeau
     */
    private Cadeau $_cadeau;

    public function __construct(Context $context, CadeauFactory $cadeauFactory, ManagerInterface $messageManager, Cadeau $cadeau, Cadeau $cadeauRepository)
    {
        parent::__construct($context);
        $this->_cadeauFactory = $cadeauFactory;
        $this->_messageManager = $messageManager;
        $this->_cadeau = $cadeau;
        $this->_cadeauRepository = $cadeauRepository;

    }

    /**
     * Booking action
     *
     * @return void
     */


    public function execute()
    {
        // 1. GET request : Get booking data
        $id = $this->getRequest()->getParam("id", false);
        $nom_client = $this->getRequest()->getParam("nom_client", false);
        $nom_cadeau = $this->getRequest()->getParam("nom_cadeau", false);

        // Chqrge lq donnée
        //$cadeau = $this->_cadeau->load($id);// Charge cadeau a partir ID
        //echo $cadeau->getData("nom_cadeau");
        //echo $cadeau->getData("nom_client");
        //echo $id."//".$nom_cadeau;



        // Envoie lq donnée vers pqge contenant for,ulaire ,aj

        //$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        //$url = $this->_redirect->getRefererUrl();

        //$resultRedirect->setUrl($url);


        // 2. GET request : Render the booking page
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }


}
