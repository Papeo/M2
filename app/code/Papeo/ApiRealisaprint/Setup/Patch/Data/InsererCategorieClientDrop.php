<?php


namespace Papeo\ApiRealisaprint\Setup\Patch\Data;


use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;


class InsererCategorieClient implements DataPatchInterface
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
        Config $eavModelConfig
    )

    {
        $this->_customerSetupFactory = $customerSetupFactory;
        $this->_moduleDataSetup = $moduleDataSetup;
        $this->_eavModelConfig = $eavModelConfig;


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
        $customerSetup->addAttribute(Customer::ENTITY, "Categorie_client",
            //Attribue Options

            [
                'type' => 'varchar',
                'label' => 'Categorie_client',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'position' => 999,
                'system' => 0,
                'default' => "toto"
            ]);

        $customerAttribute = $this->_eavModelConfig->getAttribute(Customer::ENTITY, "Categorie_client");

             $customerAttribute->addData([
            'attribute_set_id' => 1,
            'attribute_group_id' => 1,
            'used_in_forms' => ['adminhtml_customer'],
        ]);

        //$customerSetup->setData("Categorie_client", "toto");
        $customerAttribute->save();
    }


    // je souhaite initialiser la valeur de catégorie client, pour tous les clients.

    // $customers = $this->_customerRepostory->getList();


}
