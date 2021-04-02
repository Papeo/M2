<?php


namespace Papeo\Formation2\Block\Adminhtml\Ventes;



use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Papeo\Formation2\Model\ResourceModel\Cadeau;
use Magento\Sales\Model\OrderRepository;

class ListeVentes extends Template
{
    /**
     * @var CollectionFactory
     */
    private CollectionFactory $_customerCollectionFactory;
    /**
     * @var \Papeo\Formation2\Model\ResourceModel\Ventes\CollectionFactory
     */
    private $_ventesCollectionFactory;
    /**
     * @var OrderRepository
     */
    private OrderRepository $_orderRepository;
    private \Magento\Framework\Api\SearchCriteria $_searchCriteria;

    public function __construct(CollectionFactory $customerCollectionFactory,
                                \Papeo\Formation2\Model\ResourceModel\Ventes\CollectionFactory $ventesCollectionFactory,
                                \Magento\Framework\Api\SearchCriteria $searchCriteria,
                                OrderRepository $orderRepository,

                                Template\Context $context, array $data = [])
    {

        $this->_customerCollectionFactory = $customerCollectionFactory;
        $this->_ventesCollectionFactory = $ventesCollectionFactory;
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria = $searchCriteria;
        parent::__construct($context, $data);


    }

    public function getMesClients()
    {
        // $searchCriteria = $this->_searchCriteria;
        // ancienne méthode
        // $mesClients = $this->_customer->getCollection();

        $mesClients = $this->_customerCollectionFactory->create();
        // ancienne méthode
        //return $mesClients->getItems();
        //nouvelle méthode
        return $mesClients;

    }


    public function getMesVentes() {

        return $this->_ventesCollectionFactory->create();


    }
}
