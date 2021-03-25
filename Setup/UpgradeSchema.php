<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Setup;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
{
    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function upgrade(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        if (0 < version_compare($context->getVersion(), '0.0.0')) {
            $this->createPreferencesTable($installer);
        }

        $installer->endSetup();
    }

    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface $schemaSetup
     * @throws \Zend_Db_Exception
     */
    private function createPreferencesTable(\Magento\Framework\Setup\SchemaSetupInterface $schemaSetup)
    {
        if (!$schemaSetup->tableExists(\Userway\Widget\Api\DB\PreferencesInterface::TABLE)) {
            $connection = $schemaSetup->getConnection();
            $table = $connection
                ->newTable($schemaSetup->getTable(\Userway\Widget\Api\DB\PreferencesInterface::TABLE))
                ->addColumn(
                    \Userway\Widget\Api\DB\PreferencesInterface::ID,
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        \Magento\Framework\DB\Ddl\Table::OPTION_IDENTITY => true,
                        \Magento\Framework\DB\Ddl\Table::OPTION_NULLABLE => false,
                        \Magento\Framework\DB\Ddl\Table::OPTION_PRIMARY => true,
                        \Magento\Framework\DB\Ddl\Table::OPTION_UNSIGNED => true
                    ]
                )->addColumn(
                    \Userway\Widget\Api\DB\PreferencesInterface::STORE_ID_FIELD,
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    [
                        'identity' => false,
                        'nullable' => false,
                        'primary' => false,
                        'unsigned' => true
                    ]
                )->addColumn(
                    \Userway\Widget\Api\DB\PreferencesInterface::ACCOUNT_ID_FIELD,
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'identity' => false,
                        'nullable' => true,
                        'primary' => false,
                        'unsigned' => true
                    ]
                )->addColumn(
                    \Userway\Widget\Api\DB\PreferencesInterface::STATE_FIELD,
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    [
                        'identity' => false,
                        'nullable' => true,
                        'primary' => false,
                        'unsigned' => true
                    ]
                )->addColumn(
                    \Userway\Widget\Api\DB\PreferencesInterface::CREATE_TIME_FIELD,
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP
                )->addColumn(
                    \Userway\Widget\Api\DB\PreferencesInterface::UPDATE_TIME_FIELD,
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP
                )->addForeignKey(
                    $schemaSetup->getFkName(
                        \Userway\Widget\Api\DB\PreferencesInterface::TABLE,
                        \Userway\Widget\Api\DB\PreferencesInterface::STORE_ID_FIELD,
                        'store',
                        \Userway\Widget\Api\DB\PreferencesInterface::STORE_ID_FIELD
                    ),
                    \Userway\Widget\Api\DB\PreferencesInterface::STORE_ID_FIELD,
                    $schemaSetup->getTable('store'),
                    \Userway\Widget\Api\DB\PreferencesInterface::STORE_ID_FIELD,
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )->setComment('UserWay stores preferences table');
            $schemaSetup->getConnection()->createTable($table);
        }
    }
}
