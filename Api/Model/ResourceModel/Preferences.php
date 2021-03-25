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

    /**
     * @param $storeId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function exist($storeId);

    /**
     * @param int $id
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function fetch($id);

    /**
     * @param int $storeId
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function fetchByStore($storeId);

    /**
     * @param int $storeId
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteByStore($storeId);

    /**
     * @param int $id
     * @param int $accountId
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function enable($id, $accountId);
}
