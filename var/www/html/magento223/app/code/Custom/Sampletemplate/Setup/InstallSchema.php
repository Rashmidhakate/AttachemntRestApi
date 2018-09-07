<?php
namespace Custom\Sampletemplate\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (!$installer->tableExists('cp_filetag_manage')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('cp_filetag_manage'))
                ->addColumn(
                    'filetag_id',
                    Table::TYPE_INTEGER,
                    10,
                    ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true]
                )
                ->addColumn('filetag_name', Table::TYPE_TEXT, 255, ['nullable' => false])
                ->addColumn('filetag_logo', Table::TYPE_TEXT, 255, ['nullable' => false])
                ->setComment('CP Filetag manage table');

            $installer->getConnection()->createTable($table);
        }

        if (!$installer->tableExists('cp_sampletemplate_manage')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('cp_sampletemplate_manage'))
                ->addColumn(
                    'template_id',
                    Table::TYPE_INTEGER,
                    10,
                    ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true]
                )
                ->addColumn('filetag_id', Table::TYPE_INTEGER, 10, ['nullable' => false, 'unsigned' => true])
                ->addColumn('template_name', Table::TYPE_TEXT, 255, ['nullable' => false])
                ->addColumn('category', Table::TYPE_TEXT, 255, ['nullable' => false], 'Magento Category Id')
                ->addColumn('store',\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,['nullable' => true,'default' => null],'Store')
                ->addColumn('file', Table::TYPE_TEXT, 255, ['nullable' => false])
                ->addForeignKey(
                    $installer->getFkName(
                        'cp_filetag_manage',
                        'filetag_id',
                        'cp_sampletemplate_manage',
                        'filetag_id'
                    ),
                    'filetag_id',
                    $installer->getTable('cp_filetag_manage'),
                    'filetag_id',
                    Table::ACTION_CASCADE
                )
                ->setComment('CP Sample Template manage table');

            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
