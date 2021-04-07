<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Api\Block;


interface FrameInterface
{
    /**
     * @return string
     */
    public function getFrameUrl();

    /**
     * @return string
     */
    public function getRecordId();

    /**
     * @return string
     */
    public function getEnableUrl();

    /**
     * @return string
     */
    public function getToggleEnableUrl();
}
