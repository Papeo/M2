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

class TxTva extends \Magento\Ui\Component\Listing\Columns\Column
{


    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {


                $item[$this->getData('name')] = $this->getTauxTva($item);


            }

            return $dataSource;

        }
    }


    private function getTauxTva($item)
    {
        $correspondances =[
            '1' => '20%',
            '2' => '5,5%',
            '3' => '2,1%'
        ];

        if(isset($item["tax_id"]) && isset($correspondances[$item["tax_id"]])){

            return $correspondances[$item["tax_id"]];
        }
        else {
            return "Export";
        }
    }

}
