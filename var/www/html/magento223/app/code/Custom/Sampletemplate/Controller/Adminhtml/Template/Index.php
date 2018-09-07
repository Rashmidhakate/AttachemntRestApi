<?php
namespace Custom\Sampletemplate\Controller\Adminhtml\Template;

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
            'Custom_Sampletemplate::sampletemplate_manage'
        )->addBreadcrumb(
            __('SampleTemplate'),
            __('SampleTemplate')
        )->addBreadcrumb(
            __('Manage SampleTemplate'),
            __('Manage SampleTemplate')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('SampleTemplate'));
        return $resultPage;
    }
}