<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Observer;

use Magento\Framework\Event\Observer;

class OnStoreDelete implements \Magento\Framework\Event\ObserverInterface
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
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if ($store = $observer->getData('store')) {
            $model = $this->objectManager->create(\Userway\Widget\Model\ResourceModel\Preferences::class);
            $model->deleteByStore($store->getId());
        }
    }
}
