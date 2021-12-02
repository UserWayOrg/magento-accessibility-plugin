<?php
/*
 *  * @category Magento-2 UserWay Widget Module
 *  * @package Userway_Widget
 *  * @copyright Copyright (c) 2021
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
        return 'https://cdn.qa.userway.dev/widget.js';
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getInlineScript()
    {
        return '
            <script>
                window._userway_config = {
                    account: "'.  $this->getDataAccount() .'"
                }
            </script>
            <script>
                !function(){function t(){var t=document.createElement("iframe");t.title="Scanning alert",t.setAttribute("style","width:100%!important;height:100%!important;position:fixed!important;left:0!important;right:0!important;top:0!important;bottom:0!important;z-index:999999"),document.body.appendChild(t),t.src=n+"scan_error.html"}try{var e=document.getElementsByTagName("html")[0],i="data-uw-w-loader";if(e&&e.hasAttribute(i))return;e.setAttribute(i,"")}catch(t){}var n="https://cdn.userway.org/widgetapp/",a=n+"2021-11-26/widget_app_base_1637931784622.js",o=n+"2021-11-26/widget_app_1637931784622.js";if(location.origin&&location.origin.indexOf(".webaim.")>-1||location.origin&&location.origin.indexOf("acsbace")>-1)setTimeout(function(){t()},1e3);else{if(!new RegExp("(bot|crawler)","i").test(navigator.userAgent)){var r=window._userway_config;navigator.userAgent.match(/mobile/i)&&r&&("false"===r.mobile||!1===r.mobile)||(function(){try{UserWayWidgetApp={},(Object.keys(localStorage).filter(function(t){return 0===t.indexOf("userway-s")}).length>0||/Edge\/|Trident\/|MSIE/.test(navigator.userAgent))&&(a=o,UserWayWidgetApp.lazyLoaded=!0)}catch(t){}}(),function(t,e){var i=document.body||document.head,n=document.createElement("script");n.onload=function(){e&&e()},n.src=t,n.id="a11yWidgetSrc",i.appendChild(n)}(a))}}}();
            </script>
        ';
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getDataAccount()
    {
        $model = $this->preferences->fetchByStore($this->_storeManager->getStore()->getId());
        return $model[\Userway\Widget\Api\Model\Preferences::ACCOUNT_ID_FIELD];
    }
}
