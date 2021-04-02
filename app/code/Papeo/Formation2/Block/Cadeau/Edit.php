<?php


namespace Papeo\Formation2\Block\Cadeau;



use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Papeo\Formation2\Model\CadeauRepository;


class Edit extends Template
{

    /**
     * @var CollectionFactory
     */
    private $_customerCollectionFactory;
    /**
     * @var CadeauRepository
     */
    private $_cadeauRepository;

    public function __construct(CollectionFactory $customerCollectionFactory,
                                CadeauRepository $cadeauRepository, Template\Context $context, array $data = [])
    {

        $this->_customerCollectionFactory = $customerCollectionFactory;
        $this->_cadeauRepository = $cadeauRepository;

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

    public function getMonCadeau() {
        $id = $this->getRequest()->getParam("id",false);

        return $this->_cadeauRepository->getById($id);
    }



}
