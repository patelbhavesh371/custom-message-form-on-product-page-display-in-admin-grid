<?php
namespace Vendor\Module\Controller\Adminhtml\Message;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(Action\Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Vendor_Module::messages');
        $resultPage->getConfig()->getTitle()->prepend(__('Customer Product Messages'));
        return $resultPage;
    }
}
