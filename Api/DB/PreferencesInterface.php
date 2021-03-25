<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Api\DB;

interface PreferencesInterface
{
    /**
     * @const string
     */
    const TABLE = 'uw_preferences';
    /**
     * @const string
     */
    const ID = 'preference_id';
    /**
     * @const string
     */
    const CREATE_TIME_FIELD = 'created_time';
    /**
     * @const string
     */
    const UPDATE_TIME_FIELD = 'updated_time';
    /**
     * @const string
     */
    const STATE_FIELD = 'state';
    /**
     * @const string
     */
    const STORE_ID_FIELD = 'store_id';
    /**
     * @const string
     */
    const ACCOUNT_ID_FIELD = 'account_id';
}
