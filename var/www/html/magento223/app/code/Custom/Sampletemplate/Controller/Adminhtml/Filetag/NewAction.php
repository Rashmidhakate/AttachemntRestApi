<?php

namespace Custom\Sampletemplate\Controller\Adminhtml\Filetag;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\ResponseInterface;

class NewAction extends Action
{
    const ADMIN_RESOURCE = 'Custom_Sampletemplate::save';
    protected $resultForwardFactory;
    public function __construct(Action\Context $context, ForwardFactory $resultForwardFactory)
    {
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
