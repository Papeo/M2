<?php


namespace Papeo\Formation2\Model\Rewrite;


class Product extends \Magento\Catalog\Model\Product
{
    public function getName()
    {
        return str_replace("a","#",parent::getName());
    }

}
