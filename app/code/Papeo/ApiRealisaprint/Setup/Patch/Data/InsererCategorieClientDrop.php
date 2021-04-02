<?php


namespace Papeo\ApiRealisaprint\Setup\Patch\Data;


use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;


class InsererCategorieClientDrop implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $_moduleDataSetup;
    /**
     * @var CustomerSetupFactory
     */
    private CustomerSetupFactory $_customerSetupFactory;

    /**
     * InsererCategorieClient constructor.
     */
    public function __construct(

        CustomerSetupFactory $customerSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup,
        Config $eavModelConfig,
        CustomerRepository $customerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )

    {
        $this->_customerSetupFactory = $customerSetupFactory;
        $this->_moduleDataSetup = $moduleDataSetup;
        $this->_eavModelConfig = $eavModelConfig;
        $this->_customerRepository = $customerRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;


    }


    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $customerSetup = $this->_customerSetupFactory->create(["setup" => $this->_moduleDataSetup]);
        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'custom_dropdown',
            //Attribue Options

            [
           'label' => 'Custom Dropdown',
            'system' => 0,
            'position' => 710,
            'sort_order' => 710,
            'visible' => true,
            'note' => '',
            'type' => 'int',
            'input' => 'select',
            'source' => 'Papeo\ApiRealisaprint\Model\Customdropdown',
                'default' => 0

            ]);


           $customerAttribute = $this->_eavModelConfig->getAttribute(Customer::ENTITY, "custom_dropdown");

             $customerAttribute->addData([
            'attribute_set_id' => 1,
            'attribute_group_id' => 1,
            'used_in_forms' => ['adminhtml_customer'],
        ]);


        $customerAttribute->save();
        //je souhaite assigner la valeur 3 à tous les clients

        $customers = $this->_customerRepository->getList($this->_searchCriteriaBuilder->create());
        foreach ($customers->getItems() as $customer) {
            $customer =
            //calcul CA
            $customer->setData("custom_dropdown",3);
            $customer->save();

    }



    }




}
