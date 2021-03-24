<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Model;

class Preferences extends \Magento\Framework\Model\AbstractModel implements
    \Magento\Framework\DataObject\IdentityInterface,
    \Userway\Widget\Api\Model\Preferences
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init(\Userway\Widget\Model\ResourceModel\Preferences::class);
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @ingeritdoc
     * @return Preferences
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @ingeritdoc
     * @return int
     */
    public function getState()
    {
        return $this->getData(self::STATE_FIELD);
    }

    /**
     * @ingeritdoc
     * @return Preferences
     */
    public function setState($state)
    {
        return $this->setData(self::STATE_FIELD, $state);
    }

    /**
     * @ingeritdoc
     * @return Preferences
     */
    public function getStore()
    {
        return $this->getData(self::STORE_ID_FIELD);
    }

    /**
     * @param integer $store
     * @return Preferences
     */
    public function setStore($store)
    {
        return $this->setData(self::STORE_ID_FIELD, $store);
    }
}
