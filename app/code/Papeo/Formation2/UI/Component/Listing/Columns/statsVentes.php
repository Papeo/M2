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

class statsVentes extends \Magento\Ui\Component\Listing\Columns\Column
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
                                \Magento\Sales\Model\ResourceModel\Order\CollectionFactory  $orderCollectionFactory, array $components = [], array $data = []

    )
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->_cadeauRepository= $cadeauRepository;
        $this->_customerRepository=$customerRepository;
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria = $searchCriteria;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_orderCollectionFactory = $orderCollectionFactory;

    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {


                $customer = $this->_customerRepository->getById($item["customer_id"]);


                //  $item[$this->getData('name')] = $customer->getFirstname();
                $item['email'] = $customer->getEmail();
                $item['name'] = $customer->getFirstname();

                $customerOrder = $this->_orderCollectionFactory->create()->addFieldToFilter('customer_id', $item['customer_id']);
                $item[$this->getData('name')] = count($customerOrder);//Value which you want to display

                $total = $this->_orderRepository->get($item['customer_id']);
                $item['total']  =$total->getBaseGrandTotal();

                //recup CA Total
                $ca = $this->_orderRepository->get($item['customer_id']);
                $item['ca']  =$total->getItems($item['customer_id']);

                $array = [];

                if (array_key_exists($item['customer_id'],  $array) == true)
                    $array[$item['customer_id']] += $item['ca'];
                else
                    $array[$item['customer_id']] = $item['ca'];
//print_r($array);
                //$ca = $this->_orderRepository->getList('$item["customer_id"]');
                //$item['ca'] = $ca->getTotalCount();

                //echo $item['ca']."<br>";
                //echo $item["customer_id"];

            }

        }



        return $dataSource;

    }


    private function prepareItem($item)
    {

    }

}
