<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Block;

class Frame extends \Magento\Framework\View\Element\Template implements \Userway\Widget\Api\Block\FrameInterface
{
    const FRAME_URL = 'https://qa.userway.dev';

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;

    /**
     * Frame constructor.
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Element\Template\Context $context
     */
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\View\Element\Template\Context $context
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->storeManager = $storeManager;
        $this->request = $request;
        parent::__construct($context);
    }

    private function getHost($address)
    {
        $parseUrl = parse_url(trim($address));
        $parseUrlParts = explode('/', $parseUrl['path'], 2);
        return trim($parseUrl['host'] ?: array_shift($parseUrlParts));
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getFrameUrl()
    {
        $preferencesModel = $this->coreRegistry->registry('currentRecord');
        $store = $this->storeManager->getStore(
            $preferencesModel[\Userway\Widget\Api\DB\PreferencesInterface::STORE_ID_FIELD]
        );

        $frameUrlParams = [
            'storeUrl' => $this->getHost($store->getBaseUrl()),
        ];

        if ($preferencesModel[\Userway\Widget\Api\DB\PreferencesInterface::ACCOUNT_ID_FIELD]) {
            $frameUrlParams[\Userway\Widget\Api\DB\PreferencesInterface::ACCOUNT_ID_FIELD]
                = $preferencesModel[\Userway\Widget\Api\DB\PreferencesInterface::ACCOUNT_ID_FIELD];
        }

        if ($preferencesModel[\Userway\Widget\Api\DB\PreferencesInterface::STATE_FIELD]) {
            $frameUrlParams['active']
                = (bool)$preferencesModel[\Userway\Widget\Api\DB\PreferencesInterface::STATE_FIELD] ? 'true' : 'false';
        } else {
            $frameUrlParams['active'] = 'false';
        }

        $queryParams = implode('&', array_map(
            static function ($v, $k) {
                return sprintf("%s=%s", $k, $v);
            },
            $frameUrlParams,
            array_keys($frameUrlParams)
        ));
        return self::FRAME_URL . '/api/apps/magento/?' . $queryParams;
    }

    /**
     * @return string
     */
    public function getRecordId()
    {
        return $this->request->getParam('id');
    }

    /**
     * @return string
     */
    public function getEnableUrl()
    {
        return $this->getUrl('userway/preferences/enable');
    }

    /**
     * @return string
     */
    public function getToggleEnableUrl()
    {
        return $this->getUrl('userway/preferences/toggle');
    }
}
