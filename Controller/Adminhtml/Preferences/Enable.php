<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Controller\Adminhtml\Preferences;

class Enable extends \Magento\Backend\App\Action implements \Userway\Widget\Api\Controller\ControllerInterface
{
    /**
     * @const string
     */
    const ADMIN_RESOURCE = 'Userway_Widget::preferences';
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultJsonFactory;

    /**
     * @var \Userway\Widget\Model\ResourceModel\Preferences
     */
    private $preferencesResourceModel;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    private $jsonHelper;

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }

    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Userway\Widget\Model\ResourceModel\Preferences $preferencesResourceModel,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::__construct($context);

        $this->resultJsonFactory = $resultJsonFactory;
        $this->logger = $logger;
        $this->preferencesResourceModel = $preferencesResourceModel;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $response = $this->resultJsonFactory->create();
        try {
            $result = 0;
            $recordId = (int)$this->getRequest()->getParam('recordId');
            $accountId = $this->getRequest()->getParam('accountId');
            if ($recordId > 0 && $accountId !== '') {
                $this->preferencesResourceModel->enable($recordId, $accountId);
                $result = 200;
            }
            $response->setData(['result' => $result]);
            return $response;
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $response->setData(['exception' => $e->getMessage()]);
            return $response;
        }
    }
}
