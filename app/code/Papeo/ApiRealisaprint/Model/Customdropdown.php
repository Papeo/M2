<?php


namespace Papeo\ApiRealisaprint\Model;


class Customdropdown extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions()
    {
        $type = [];
        $type[] = [
            'value' => '',
            'label' => '--Select--'
        ];
        $type[] = [
            'value' => 4,
            'label' => 'Bon client'
        ];
        $type[] = [
            'value' => 3,
            'label' => 'Mauvais client'
        ];

        $type[] = [
            'value' => 5,
            'label' => 'Super client'
        ];
        return $type;
    }

    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }
}
