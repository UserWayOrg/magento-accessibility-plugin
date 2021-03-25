<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Userway\Widget\Api\DB\PreferencesInterface;
use Zend_Db_Exception;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @inheritDoc
     * @throws Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        $this->createPreferencesTable($installer);
        $installer->endSetup();
    }

    /**
     * @param SchemaSetupInterface $schemaSetup
     * @throws Zend_Db_Exception
     */
    private function createPreferencesTable(SchemaSetupInterface $schemaSetup)
    {
        if (!$schemaSetup->tableExists(PreferencesInterface::TABLE)) {
            $connection = $schemaSetup->getConnection();
            $table = $connection
                ->newTable($schemaSetup->getTable(PreferencesInterface::TABLE))
                ->addColumn(
                    PreferencesInterface::ID,
                    Table::TYPE_INTEGER,
                    null,
                    [
                        Table::OPTION_IDENTITY => true,
                        Table::OPTION_NULLABLE => false,
                        Table::OPTION_PRIMARY => true,
                        Table::OPTION_UNSIGNED => true
                    ]
                )->addColumn(
                    PreferencesInterface::STORE_ID_FIELD,
                    Table::TYPE_SMALLINT,
                    null,
                    [
                        'identity' => false,
                        'nullable' => false,
                        'primary' => false,
                        'unsigned' => true
                    ]
                )->addColumn(
                    PreferencesInterface::ACCOUNT_ID_FIELD,
                    Table::TYPE_TEXT,
                    255,
                    [
                        'identity' => false,
                        'nullable' => true,
                        'primary' => false,
                        'unsigned' => true
                    ]
                )->addColumn(
                    PreferencesInterface::STATE_FIELD,
                    Table::TYPE_SMALLINT,
                    null,
                    [
                        'identity' => false,
                        'nullable' => true,
                        'primary' => false,
                        'unsigned' => true
                    ]
                )->addColumn(
                    PreferencesInterface::CREATE_TIME_FIELD,
                    Table::TYPE_TIMESTAMP
                )->addColumn(
                    PreferencesInterface::UPDATE_TIME_FIELD,
                    Table::TYPE_TIMESTAMP
                )->addForeignKey(
                    $schemaSetup->getFkName(
                        PreferencesInterface::TABLE,
                        PreferencesInterface::STORE_ID_FIELD,
                        'store',
                        PreferencesInterface::STORE_ID_FIELD
                    ),
                    PreferencesInterface::STORE_ID_FIELD,
                    $schemaSetup->getTable('store'),
                    PreferencesInterface::STORE_ID_FIELD,
                    Table::ACTION_CASCADE
                )->setComment('UserWay stores preferences table');

            $schemaSetup->getConnection()->createTable($table);
        }
    }
}
