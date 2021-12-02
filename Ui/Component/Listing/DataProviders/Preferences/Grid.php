<?php
/*
 *  * @category Magento-2 UserWay Widget Module
 *  * @package Userway_Widget
 *  * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Ui\Component\Listing\DataProviders\Preferences;

class Grid extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * Grid constructor.
     * @param string $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param \Userway\Widget\Model\ResourceModel\Preferences\CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name = '',
        $primaryFieldName,
        $requestFieldName,
        \Userway\Widget\Model\ResourceModel\Preferences\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, \Userway\Widget\Api\DB\PreferencesInterface::ID, $requestFieldName, $meta, $data);
    }
}
