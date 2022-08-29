<?php

namespace Mastering\SampleModule\Setup;

use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $table = $installer->getConnection()->newTable(
            $installer->getTable('mastering_sample_item')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Item ID'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            '255',
            ['nullable' => false],
            'Item Name'
        )->addIndex(
            $installer->getIdxName('mastering_sample_item', ['name']),
            'Name'
        )->setComment(
            'Sample Item'
        );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
