<?php


namespace Papeo\Formation2\Block\Cadeau;



use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Papeo\Formation2\Model\ResourceModel\Cadeau;
use Magento\Sales\Model\OrderRepository;

class UpdatePost extends Template
{
    /**
     * @var CollectionFactory
     */
    private CollectionFactory $_customerCollectionFactory;
    /**
     * @var \Papeo\Formation2\Model\ResourceModel\Cadeau\CollectionFactory
     */
    private $_cadeauCollectionFactory;
    /**
     * @var OrderRepository
     */
    private OrderRepository $_orderRepository;
    private \Magento\Framework\Api\SearchCriteria $_searchCriteria;

      public function __construct(CollectionFactory $customerCollectionFactory,
                                \Papeo\Formation2\Model\ResourceModel\Cadeau\CollectionFactory $cadeauCollectionFactory,
                                \Magento\Framework\Api\SearchCriteria $searchCriteria,
                                OrderRepository $orderRepository,

                                Template\Context $context, array $data = [])
    {

        $this->_customerCollectionFactory = $customerCollectionFactory;
        $this->_cadeauCollectionFactory = $cadeauCollectionFactory;
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria = $searchCriteria;
        parent::__construct($context, $data);


    }

    public function getMesClients()
    {

        $mesClients = $this->_customerCollectionFactory->create();
        return $mesClients;

    }

    public function getMesCommandes() {
        $searchCriteria = $this->_searchCriteria;
        $mesCommandes = $this->_orderRepository->getList($searchCriteria);

        return $mesCommandes->getItems();
    }


    public function getMesCadeaux() {

        return $this->_cadeauCollectionFactory->create();


    }
}
