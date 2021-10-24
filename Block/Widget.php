<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Block;

class Widget extends \Magento\Framework\View\Element\Template implements \Userway\Widget\Api\Block\WidgetInterface
{
    /**
     * @var \Userway\Widget\Model\ResourceModel\Preferences
     */
    private $preferences;

    /**
     * Widget constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Userway\Widget\Model\ResourceModel\Preferences $preferences
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Userway\Widget\Model\ResourceModel\Preferences  $preferences
    )
    {
        $this->preferences = $preferences;
        parent::__construct($context);
    }

    /**
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function isStoreWidgetEnabled()
    {
        $model = $this->preferences->fetchByStore($this->_storeManager->getStore()->getId());

        return isset($model[\Userway\Widget\Api\Model\Preferences::STATE_FIELD])
            && (int)$model[\Userway\Widget\Api\Model\Preferences::STATE_FIELD] === \Userway\Widget\Api\Model\Preferences::STATE_ENABLED
            && isset($model[\Userway\Widget\Api\Model\Preferences::ACCOUNT_ID_FIELD])
            && (string)$model[\Userway\Widget\Api\Model\Preferences::ACCOUNT_ID_FIELD] !== '';
    }

    /**
     * @return string
     */
    public function getScriptUrl()
    {
        return 'https://cdn.qa.userway.dev/widget.js?account=' . $this->getDataAccount();
    }

    /**
     * @return string
     */
    public function getDataAccount()
    {
        $model = $this->preferences->fetchByStore($this->_storeManager->getStore()->getId());
        return $model[\Userway\Widget\Api\Model\Preferences::ACCOUNT_ID_FIELD];
    }
}
