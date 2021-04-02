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

class PaysColumn extends \Magento\Ui\Component\Listing\Columns\Column
{


    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {


                $item[$this->getData('name')] = $this->getCodePays($item);


            }

            return $dataSource;

        }
    }


    private function getCodePays($item)
    {
        $correspondances =[
            'US' => 'Etats-Unis',
            'FR' => 'France'
        ];

        if(isset($item["country_id"]) && isset($correspondances[$item["country_id"]])){

            return $correspondances[$item["country_id"]];
        }
        else {
            return "NC";
        }
    }

}
