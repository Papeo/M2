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

class DateColumn extends \Magento\Ui\Component\Listing\Columns\Column
{


    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {


                $item[$this->getData('name')] = $this->formatDate($item);


            }

            return $dataSource;

        }
    }


    private function formatDate($item)
    {


        $date = date_create($item['created_at']);
        $date= date_format($date, 'd/m/Y');


           // return $item["created_at"];
            return $date;
        }
      //  else {
         //   return "NC";
      //  }
  //  }

}
