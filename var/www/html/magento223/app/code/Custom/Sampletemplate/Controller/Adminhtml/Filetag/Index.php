<?php
namespace Custom\Sampletemplate\Controller\Adminhtml\Filetag;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
	private $resultPageFactory;
	public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Custom_Sampletemplate::manage');
    }

    public function execute(){
    	$resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(
            'Custom_Sampletemplate::filetag_manage'
        )->addBreadcrumb(
            __('FileTag'),
            __('FileTag')
        )->addBreadcrumb(
            __('Manage FileTag'),
            __('Manage FileTag')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('FileTag'));
        return $resultPage;
    }
}