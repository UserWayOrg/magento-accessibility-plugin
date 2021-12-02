<?php
/*
 *  * @category Magento-2 UserWay Widget Module
 *  * @package Userway_Widget
 *  * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Controller\Adminhtml\Preferences;

class Toggle extends \Magento\Backend\App\Action implements \Userway\Widget\Api\Controller\ControllerInterface
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
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

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
            $result = \Userway\Widget\Api\Controller\RestControllerInterface::ACTION_FAIL;
            $recordId = (int)$this->getRequest()->getParam(
                \Userway\Widget\Api\Controller\RestControllerInterface::REQUEST_BODY_PARAM_RECORD_ID
            );
            $state = $this->getRequest()->getParam(
                \Userway\Widget\Api\Controller\RestControllerInterface::REQUEST_BODY_PARAM_STATE,
                \Userway\Widget\Api\Model\Preferences::STATE_DISABLED
            );
            if ($recordId > 0) {
                $this->preferencesResourceModel->toggleState($recordId, $state);
                $result = \Userway\Widget\Api\Controller\RestControllerInterface::ACTION_SUCCESS;
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
