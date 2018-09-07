<?php

namespace Custom\Sampletemplate\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable('cp_filetag_manage'); 
        $secondTableName = $setup->getTable('cp_sampletemplate_manage'); 
        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            //$tableName = $installer->getTable('cp_newsmodule');
            $fullTextIntex = array('filetag_name'); // Column with fulltext index, you can put multiple fields
            $setup->getConnection()->addIndex(
                $tableName,
                $setup->getIdxName($tableName, $fullTextIntex, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullTextIntex,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );

            $fullText = array('template_name'); 
            $setup->getConnection()->addIndex(
                $secondTableName,
                $setup->getIdxName($tableName, $fullTextIntex, \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                $fullText,
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );

        } 
        $setup->endSetup();
    }
}