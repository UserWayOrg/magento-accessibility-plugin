<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Model\Preferences;

class EmbedState implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => \Userway\Widget\Model\Preferences::STATE_ENABLED, 'label' => __('Script injected')],
            ['value' => \Userway\Widget\Model\Preferences::STATE_DISABLED, 'label' => __('Script not present')]
        ];
    }
}
