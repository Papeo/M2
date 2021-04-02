<?php

namespace Papeo\Formation2\Controller\Ventes;

// Toute classe e controller Front Office doit hériter de la casllse ci-dessous
//class Liste extends Magento\Framework\App\Action\Action
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Papeo\Formation2\Model\Ventes;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\App\ResponseInterface;


class Liste extends Action
{

    /**
     * @var PageFactory
     */
    private $_pageFactory;

        private \Papeo\Formation2\Model\VentesFactory $_ventesFactory;
    private \Papeo\Formation2\Model\ResourceModel\Ventes $_ventesResourceModel;

    public function __construct(Context $context, PageFactory $pageFactory,
                                \Papeo\Formation2\Model\VentesFactory $ventesFactory,
                                \Papeo\Formation2\Model\ResourceModel\Ventes $ventesResourceModel)
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_ventesFactory = $ventesFactory;
        $this->_ventesResourceModel = $ventesResourceModel;
    }

    public function execute() {


             $ventes= $this->_ventesFactory->create();

        return $this->_pageFactory->create("");

    }

    // Creer un formulaire de création d'un objet. Liste et Modif, supprim. "Controleur de post", methode Post
    //$block->getUrl
    // surcharge nom des catégories à traiter avec *



}
