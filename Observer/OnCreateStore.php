<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */
namespace Userway\Widget\Observer;

class OnCreateStore implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * OnCreateStore constructor.
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $store = $observer->getData('data_object');
        if (!$store instanceof \Magento\Store\Model\Store) {
            return;
        }

        if (!$store->hasDataChanges()) {
            return;
        }

        if ($store->isObjectNew()) {
            $model = $this->objectManager->create(\Userway\Widget\Model\ResourceModel\Preferences::class);
            $model->create($store->getId(), \Userway\Widget\Api\Model\Preferences::STATE_DISABLED);
        }
    }
}
