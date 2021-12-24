<?php
/*
 *  * @category Magento-2 UserWay Widget Module
 *  * @package Userway_Widget
 *  * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Ui\Component\Listing\Column\PreferencesGrid;

class EmbedState extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @param string $state
     * @return bool
     */
    protected function isStateEnabled($state)
    {
        return $state && $state !== '';
    }

    /**
     * @param string $stateTitle
     * @param string $htmlClassname
     * @return string
     */
    protected function generateStateTag($stateTitle, $htmlClassname)
    {
        return "<span class=\"userway-embed-state userway-embed-state--{$htmlClassname}\">{$stateTitle}</span>";
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if ($this->isStateEnabled($item[\Userway\Widget\Api\Model\Preferences::ACCOUNT_ID_FIELD])) {
                    $html = $this->generateStateTag(__('Script injected'), 'state-injected');
                } else {
                    $html = $this->generateStateTag(__('Script not present'), 'not-not-injected');
                }
                $item['embed_state'] = $html;
            }
        }

        return $dataSource;
    }
}
