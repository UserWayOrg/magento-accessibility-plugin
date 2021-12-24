<?php
/*
 *  * @category Magento-2 UserWay Widget Module
 *  * @package Userway_Widget
 *  * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Ui\Component\Listing\Column\PreferencesGrid;

class State extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @param string | number $state
     * @return bool
     */
    protected function isStateEnabled($state)
    {
        return (int)$state === \Userway\Widget\Api\Model\Preferences::STATE_ENABLED;
    }

    /**
     * @param string $stateTitle
     * @param string $htmlClassname
     * @return string
     */
    protected function generateStateTag($stateTitle, $htmlClassname)
    {
        return "<span class=\"userway-state userway-state--{$htmlClassname}\">{$stateTitle}</span>";
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item[$fieldName])) {
                    if ($this->isStateEnabled($item[\Userway\Widget\Api\Model\Preferences::STATE_FIELD])) {
                        $html = $this->generateStateTag(__('Live'), 'state-live');
                    } else {
                        $html = $this->generateStateTag(__('Not Live'), 'not-state-live');
                    }
                    $item[$fieldName] = $html;
                }
            }
        }

        return $dataSource;
    }
}
