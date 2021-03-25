<?php
/*
 * @category Magento-2 UserWay Widget Module
 * @package Userway_Widget
 * @copyright Copyright (c) 2021
 */

namespace Userway\Widget\Controller\Adminhtml\Preferences;


class Edit extends \Magento\Backend\App\Action implements \Userway\Widget\Api\Controller\ControllerInterface
{
    /**
     * @const string
     */
    const ADMIN_RESOURCE = 'Userway_Widget::preferences';
    /**
     * @const string
     */
    const ADMIN_PAGE_ID = 'Userway_Widget::block';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @var \Userway\Widget\Model\ResourceModel\Preferences
     */
    private $preferencesResourceModel;

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Userway\Widget\Model\ResourceModel\Preferences $preferencesResourceModel
    ) {
        parent::__construct($context);

        $this->coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
        $this->preferencesResourceModel = $preferencesResourceModel;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(self::ADMIN_PAGE_ID);
        $resultPage->getConfig()->getTitle()->set(__('UserWay Widget') . ' / ' . __('Edit'));
        $model = $this->preferencesResourceModel->fetch($this->getRequest()->getParam('id'));
        $this->coreRegistry->register('currentRecord', $model);
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
