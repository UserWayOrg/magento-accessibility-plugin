<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Api\Model;

interface Preferences extends \Userway\Widget\Api\DB\PreferencesInterface
{
    /**
     * @const int
     */
    const STATE_DISABLED = 0;
    /**
     * @const int
     */
    const STATE_ENABLED = 1;
    /**
     * @const string
     */
    const CACHE_TAG = 'userway_preferences';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param string $id
     * @return \Userway\Widget\Model\Preferences
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getState();

    /**
     * @param string $state
     * @return \Userway\Widget\Model\Preferences
     */
    public function setState($state);

    /**
     * @return int
     */
    public function getStore();

    /**
     * @param string $store
     * @return \Userway\Widget\Model\Preferences
     */
    public function setStore($store);
}
