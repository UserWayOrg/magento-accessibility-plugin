<?php
/*
 *  * @category Magento-2 UserWay Widget Module
 *  * @package Userway_Widget
 *  * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Setup;


class UpgradeData implements \Magento\Framework\Setup\UpgradeDataInterface
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * UpgradeData constructor.
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->objectManager = $objectManager;
        $this->storeManager = $storeManager;
    }

    /**
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     */
    public function upgrade(
        \Magento\Framework\Setup\ModuleDataSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        $setup->startSetup();

        $storeManagerDataList = $this->storeManager->getStores();
        $model = $this->objectManager->create(\Userway\Widget\Model\ResourceModel\Preferences::class);
        foreach ($storeManagerDataList as $store) {
            if (!$model->exist($store->getId())) {
                $model->create($store->getId(), \Userway\Widget\Api\Model\Preferences::STATE_DISABLED);
            }
        }

        $setup->endSetup();
    }
}
