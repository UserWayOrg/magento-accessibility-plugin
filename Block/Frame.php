<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Block;

class Frame extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * Frame constructor.
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Element\Template\Context $context
     */
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Element\Template\Context $context
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    private function getHost($address)
    {
        $parseUrl = parse_url(trim($address));
        return trim($parseUrl['host'] ? $parseUrl['host'] : array_shift(explode('/', $parseUrl['path'], 2)));
    }

    /**
     * @return string
     */
    public function getFrameUrl()
    {
        $currentModel = $this->coreRegistry->registry('currentRecord');
        $store = $this->storeManager->getStore($currentModel['store_id']);
        $params = [
            'storeId' => $currentModel['store_id'],
            'storeUrl' => $this->getHost($store->getBaseUrl()),
            'siteId' => 12466,
            'merchUwSsoToken' => 'Bearer%20eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJ7XCJzc29Vc2VySWRcIjpcIjVmMDc2NWIyOGJjOTEyM2EzNjkxNWZiZFwiLFwiYWNjb3VudENvZGVcIjpcIkxMbmpGaFNUVHdcIixcInVzZXJUeXBlXCI6XCJTSVRFX1VTRVJcIixcInVzZXJuYW1lXCI6XCJkZXYrMUB1c2Vyd2F5Lm9yZ1wiLFwiZmlyc3ROYW1lXCI6XCJRQVwiLFwibGFzdE5hbWVcIjpcIkRFVlwiLFwidGFyZ2V0U3NvVXNlcklkXCI6XCI1ZjA3NjViMjhiYzkxMjNhMzY5MTVmYmRcIixcInRhcmdldEFjY291bnRDb2RlXCI6XCJMTG5qRmhTVFR3XCIsXCJsb2dpblNjb3Blc1wiOltcIldJREdFVF9TQ09QRVwiXSxcImxvZ2luVHlwZVwiOlwiVVNFUl9MT0dJTlwiLFwiYXV0aG9yaXRpZXNcIjpbe1wiYXV0aG9yaXR5XCI6XCJST0xFX1VTRVJcIn1dLFwiYWNjb3VudE5vbkV4cGlyZWRcIjp0cnVlLFwiYWNjb3VudE5vbkxvY2tlZFwiOnRydWUsXCJjcmVkZW50aWFsc05vbkV4cGlyZWRcIjp0cnVlLFwiZW5hYmxlZFwiOnRydWV9IiwiZXhwIjoxNjE3Mjk1NDkyfQ.3EYKabQ751xXxE_DtokpOpkakVse4hHknA-JayaXdBUwU5mNiUT7dWuBthfv_wTMetH1UGU2uKaY6c-KBCqjVg'
        ];
        $iframeQueryParams = implode('&', array_map(
            function ($v, $k) {
                return sprintf("%s=%s", $k, $v);
            },
            $params,
            array_keys($params)
        ));
        return "https://qa.userway.dev/apps/magento?${iframeQueryParams}";
    }
}
