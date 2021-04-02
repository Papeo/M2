<?php


namespace Papeo\Formation2\Model;

use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\AbstractResource;

// Abstract permet d'acceder aux méthodes save, create
class Ventes extends AbstractModel
{

    /**
     * @var CustomerRepository
     */
    private $_customerRepository;

    public function _construct()
    {

        $this->_init(\Papeo\Formation2\Model\ResourceModel\Ventes::class);
    }

    public function __construct(\Magento\Framework\Model\Context $context,
                                CustomerRepository $customerRepository,
                                \Magento\Framework\Registry $registry, AbstractResource $resource = null, \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null, array $data = [])
    {
        $this->_customerRepository = $customerRepository;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function getCustomer() {
        return $this->_customerRepository->getById($this->getData("customer_id"));



    }
}

