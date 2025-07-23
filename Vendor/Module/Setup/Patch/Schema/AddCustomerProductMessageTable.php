<?php

namespace Vendor\Module\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class AddCustomerProductMessageTable implements SchemaPatchInterface
{
    private $schemaSetup;

    public function __construct(SchemaSetupInterface $schemaSetup)
    {
        $this->schemaSetup = $schemaSetup;
    }

    public function apply()
    {
        $this->schemaSetup->startSetup();

        if (!$this->schemaSetup->tableExists('vendor_customer_product_message')) {
            $table = $this->schemaSetup->getConnection()
                ->newTable($this->schemaSetup->getTable('vendor_customer_product_message'))
                ->addColumn('entity_id', Table::TYPE_INTEGER, null, [
                    'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true
                ], 'Entity ID')
                ->addColumn('customer_id', Table::TYPE_INTEGER, null, ['nullable' => false], 'Customer ID')
                ->addColumn('product_id', Table::TYPE_INTEGER, null, ['nullable' => false], 'Product ID')
                ->addColumn('message', Table::TYPE_TEXT, null, ['nullable' => false], 'Message')
                ->addColumn('created_at', Table::TYPE_TIMESTAMP, null, ['default' => Table::TIMESTAMP_INIT], 'Created At');

            $this->schemaSetup->getConnection()->createTable($table);
        }

        $this->schemaSetup->endSetup();
        return $this;
    }

    public static function getDependencies() { return []; }
    public function getAliases() { return []; }
}
