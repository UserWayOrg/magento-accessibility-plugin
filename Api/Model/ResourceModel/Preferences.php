<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Api\Model\ResourceModel;

interface Preferences
{
    /**
     * @param integer $storeId
     * @param integer $state
     * @return \Userway\Widget\Model\ResourceModel\Preferences
     */
    public function create($storeId, $state);
}
