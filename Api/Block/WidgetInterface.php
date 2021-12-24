<?php
/*
 *  * @category Magento-2 UserWay Widget Module
 *  * @package Userway_Widget
 *  * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Api\Block;


interface WidgetInterface
{
    /**
     * @return string
     */
    public function getScriptUrl();

    /**
     * @return string
     */
    public function getInlineScript();

    /**
     * @return string
     */
    public function getDataAccount();

    /**
     * @return string
     */
    public function getInlineScriptUrl();

    /**
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function isStoreWidgetEnabled();
}
