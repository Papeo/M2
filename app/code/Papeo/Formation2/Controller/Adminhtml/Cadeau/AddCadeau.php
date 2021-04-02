<?php


namespace Papeo\Formation2\Controller\Cadeau;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Papeo\Formation2\Model\CadeauFactory;

class AddCadeau extends \Magento\Framework\App\Action\Action
{

    /**
     * @var CadeauFactory
     */
    private CadeauFactory $_cadeauFactory;

    public function __construct(Context $context, CadeauFactory $cadeauFactory, ManagerInterface $messageManager)
    {
        parent::__construct($context);
        $this->_cadeauFactory = $cadeauFactory;
        $this->_messageManager = $messageManager;
    }

    /**
     * Booking action
     *
     * @return void
     */



    public function execute()
    {
        // 1. POST request : Get booking data
        $post = (array) $this->getRequest()->getPost();


        if (!empty($post)) {
            // Retrieve your form data
            $nom_cadeau   = $post['nom_cadeau'];
            $customer_id   = $post['customer_id'];

            $cadeau= $this->_cadeauFactory->create();
            $cadeauFactoryTab = [];
            $cadeau->addData(
                [
                    "nom_cadeau"=>$nom_cadeau,
                    "customer_id"=>$customer_id

                ]);

            $cadeau->save();

            // Doing-something with...

            // Display the succes form validation message
            $this->messageManager->addSuccessMessage("L'enregistrement a été ajouté");

            // Redirect to your form page (or anywhere you want...)
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect = $this->_redirect('http://www.papeo.org/papeoformation2/cadeau/liste');

            return $resultRedirect;

            //$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            //$url = $this->_redirect->getRefererUrl();

            //$resultRedirect->setUrl($url);



        }
        // 2. GET request : Render the booking page
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }



}
