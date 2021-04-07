<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Ui\Component\Listing\Column\PreferencesGrid;

class SiteName extends \Magento\Ui\Component\Listing\Columns\Column
{

    /**
     * @return \Magento\Store\Model\StoreManagerInterface
     */
    protected function getStoreManager()
    {
        return \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Store\Model\StoreManagerInterface::class);
    }

    /**
     * @param string | int $storeId
     * @return string
     */
    protected function getStoreUrl($storeId)
    {
        return parse_url($this->getStoreManager()->getStore($storeId)->getBaseUrl())['host'];
    }

    /**
     * @param string | int $storeId
     * @return string
     */
    protected function getStoreName($storeId)
    {
        return $this->getStoreManager()->getStore($storeId)->getName();
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $storeUrl = $this->getStoreUrl($item[\Userway\Widget\Api\Model\Preferences::STORE_ID_FIELD]);
                $storeName = $this->getStoreName($item[\Userway\Widget\Api\Model\Preferences::STORE_ID_FIELD]);
                $item['siteName'] = "{$storeUrl} ({$storeName})";
            }
        }

        return $dataSource;
    }
}
