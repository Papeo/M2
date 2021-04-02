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

class ComptaColumn extends \Magento\Ui\Component\Listing\Columns\Column
{


    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {


                $item[$this->getData('name')] = $this->getCodeCompta($item);


            }

            return $dataSource;

        }
    }


    private function getCodeCompta($item)
    {
        $correspondances =[
            'checkmo' => '411200'
        ];

        if(isset($item["payment_method"]) && isset($correspondances[$item["payment_method"]])){

            return $correspondances[$item["payment_method"]];
        }
        else {
            return "NC";
        }
    }

}
