<?php


namespace Papeo\Formation2\UI\Component\Listing\Columns\NomDuClientColumn;


use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class NomDuClientColumn extends \Magento\UI\Component\Listing\Columns\Column
{

    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);


}

    public function prepare()
    {
        return "toto";

    }
}
