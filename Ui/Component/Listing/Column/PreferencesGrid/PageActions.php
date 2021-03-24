<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Ui\Component\Listing\Column\PreferencesGrid;

class PageActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @const string
     */
    const EDIT_PAGE_URL = 'userway/preferences/edit';

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items']) && is_array($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                $id = $item[\Userway\Widget\Api\DB\PreferencesInterface::ID] ?? 'X';
                $item[$name]['view'] = [
                    'href' => $this->getContext()->getUrl(self::EDIT_PAGE_URL, ['id' => $id]),
                    'label' => __('Edit')
                ];
            }
        }
        return $dataSource;
    }
}
