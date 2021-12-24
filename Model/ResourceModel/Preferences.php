<?php
/*
 *  * @category Magento-2 UserWay Widget Module
 *  * @package Userway_Widget
 *  * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Model\ResourceModel;

class Preferences extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb implements
    \Userway\Widget\Api\Model\ResourceModel\Preferences
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    private $dateTime;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var \Magento\Framework\App\Cache\Manager
     */
    private $cacheManager;

    /**
     * Preferences constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $currentDate
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $currentDate,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\App\Cache\Manager $cacheManager
    ) {
        parent::__construct($context);
        $this->dateTime = $currentDate;
        $this->objectManager = $objectManager;
        $this->cacheManager = $cacheManager;
    }

    /**
     *
     */
    protected function _construct()
    {
        $this->_init(
            \Userway\Widget\Api\DB\PreferencesInterface::TABLE,
            \Userway\Widget\Api\DB\PreferencesInterface::ID
        );
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $object->setUpdatedTime($this->dateTime->gmtDate());
        if ($object->isObjectNew()) {
            $object->setCreatedTime($this->dateTime->gmtDate());
        }
        return parent::_beforeSave($object);
    }

    /**
     * @param int $storeId
     * @param int $state
     * @return mixed|Preferences
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function create($storeId, $state)
    {
        $model = $this->objectManager->create(\Userway\Widget\Model\Preferences::class);
        $model->setState($state);
        $model->setStore($storeId);
        $this->save($model);
        return $model;
    }

    /**
     * @param $storeId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function exist($storeId)
    {
        $connection = $this->getConnection();
        $select = $connection->select();
        $select->from($this->getMainTable())->where('store_id = ?', $storeId);
        return (bool)$connection->fetchOne($select);
    }

    /**
     * @param int $id
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function fetch($id)
    {
        $idField = \Userway\Widget\Api\DB\PreferencesInterface::ID;
        $connection = $this->getConnection();
        $select = $connection->select();
        $select->from($this->getMainTable())->where("${idField} = ?", $id);
        return $connection->fetchRow($select);
    }

    /**
     * @param int $id
     * @param int $accountId
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function enable($id, $accountId, $state = \Userway\Widget\Api\Model\Preferences::STATE_ENABLED)
    {
        $idField = \Userway\Widget\Api\DB\PreferencesInterface::ID;
        $connection = $this->getConnection();
        $connection->update($this->getMainTable(), [
            \Userway\Widget\Api\DB\PreferencesInterface::STATE_FIELD => $state,
            \Userway\Widget\Api\DB\PreferencesInterface::ACCOUNT_ID_FIELD => $accountId,
        ], [
            "${idField} = ?" => $id
        ]);
        $this->cacheManager->flush($this->cacheManager->getAvailableTypes());
        return $this->fetch($id);
    }

    /**
     * @param int $id
     * @param int $state
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function toggleState($id, $state)
    {
        $recordState = (int)$state === 1
            ? \Userway\Widget\Api\Model\Preferences::STATE_ENABLED : \Userway\Widget\Api\Model\Preferences::STATE_DISABLED;
        $idField = \Userway\Widget\Api\DB\PreferencesInterface::ID;
        $connection = $this->getConnection();
        $connection->update($this->getMainTable(), [
            \Userway\Widget\Api\DB\PreferencesInterface::STATE_FIELD => $recordState
        ], [
            "${idField} = ?" => $id
        ]);
        $this->cacheManager->flush($this->cacheManager->getAvailableTypes());
        return $this->fetch($id);
    }

    /**
     * @param int $storeId
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function fetchByStore($storeId)
    {
        $storeIdField = \Userway\Widget\Api\DB\PreferencesInterface::STORE_ID_FIELD;
        $connection = $this->getConnection();
        $select = $connection->select();
        $select->from($this->getMainTable())->where("${storeIdField} = ?", $storeId);
        return $connection->fetchRow($select);
    }

    /**
     * @param int $storeId
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteByStore($storeId)
    {
        $storeIdField = \Userway\Widget\Api\DB\PreferencesInterface::STORE_ID_FIELD;
        $this->getConnection()->delete($this->getMainTable(), "${storeIdField} = $storeId");
    }
}
