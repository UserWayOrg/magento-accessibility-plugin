<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Api\Controller;

interface RestControllerInterface
{
    /**
     * @return int
     */
    const ACTION_SUCCESS = 200;
    /**
     * @return int
     */
    const ACTION_FAIL = 0;
    /**
     * @return string
     */
    const REQUEST_BODY_PARAM_RECORD_ID = 'recordId';
    /**
     * @return string
     */
    const REQUEST_BODY_PARAM_STATE = 'state';
    /**
     * @return string
     */
    const REQUEST_BODY_PARAM_ACCOUNT_ID = 'accountId';
}
