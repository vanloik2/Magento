<?php
namespace Dev\Banner\Setup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
/**
 * Class InstallData
 * @package Vendor\Module\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;
    /**
     * InstallData constructor.
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }
    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'simple_test',
            [
                'type' => 'text',
                'group' => 'Product Details',
                'label' => 'Bss Simple Test',
                'input' => 'text',
                'backend' => '',
                'frontend' => '',
                'required' => false,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible' => false,
                'user_defined' => false,
                'searchable' => true,
                'filterable' => true,
                'comparable' => true,
                'filterable_in_search' => true,
                'is_html_allowed_on_front' => false,
                'used_for_promo_rules' => true,
                'visible_on_front' => false,
                'used_for_sort_by' => true,
                'unique' => false,
                'default' => '',
                'used_in_product_listing' => true,
                'source' => '',
                'option' => '',
                'sort_order' => 10,
                'apply_to' => 'simple,configurable,virtual,bundle,downloadable,grouped'
            ]
        );
        $setup->endSetup();
    }
}
