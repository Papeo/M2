<?php


namespace Papeo\Formation2\Ui\Component\Listing\Columns;


use Magento\Framework\Api\Search\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Sales\Model\OrderRepository;
use Papeo\Formation2\Model\CadeauRepository;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Ui\Component\Listing\Columns\Column;

class TvaClientColumn extends \Magento\Ui\Component\Listing\Columns\Column
{

    /**
     * @var SearchCriteriaBuilder
     */
    private $_searchCriteriaBuilder;
    /**
     * @var SearchCriteria
     */
    private $_searchCriteria;
    /**
     * @var OrderRepository
     */
    private $_orderRepository;
    /**
     * @var CustomerRepository
     */
    private $_customerRepository;
    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    private $_orderCollectionFactory;

    public function __construct(CadeauRepository $cadeauRepository,
                                CustomerRepository $customerRepository,
                                SearchCriteriaBuilder $searchCriteriaBuilder, OrderRepository $orderRepository, SearchCriteria $searchCriteria,
                                ContextInterface $context, UiComponentFactory $uiComponentFactory,
                                \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory, array $components = [], array $data = []

    )
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->_cadeauRepository = $cadeauRepository;
        $this->_customerRepository = $customerRepository;
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria = $searchCriteria;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_orderCollectionFactory = $orderCollectionFactory;

    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {


                $custom_id = $item["customer_id"];


                if (!empty($custom_id)) {
                    $customer = $this->_customerRepository->getById(intval($item["customer_id"]));

                   //var_dump($customer);




                    $item['tvaclient'] = $customer->getTaxvat();
                    $item['nom'] = $customer->getFirstname() . ' ' . $customer->getLastname();
                  // $item['adresse'] = $customer->getAddresses(['countryId']);
                   // $item['pays'] = $customer->getDefaultShipping();

                }






            }

        }


        return $dataSource;

    }


    private function prepareItem($item)
    {

    }

}
