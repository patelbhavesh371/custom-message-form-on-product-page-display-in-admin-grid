<?php

namespace Vendor\Module\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Vendor\Module\Model\MessageFactory;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Controller\Result\RedirectFactory;

class Post extends Action
{
    protected $customerSession;
    protected $messageFactory;
    protected $formKeyValidator;
    protected $resultRedirectFactory;

    public function __construct(
        Context $context,
        Session $customerSession,
        MessageFactory $messageFactory,
        Validator $formKeyValidator,
        RedirectFactory $resultRedirectFactory
    ) {
        $this->customerSession = $customerSession;
        $this->messageFactory = $messageFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$this->formKeyValidator->validate($this->getRequest())) {
            $this->messageManager->addErrorMessage(__('Invalid form key.'));
            return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        }

        if (!$this->customerSession->isLoggedIn()) {
            $this->messageManager->addErrorMessage(__('You must be logged in.'));
            return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        }

        try {
            $post = $this->getRequest()->getPostValue();

            if (!empty($post['product_id']) && !empty($post['message'])) {
                $model = $this->messageFactory->create();
                $model->setData([
                    'customer_id' => $this->customerSession->getCustomerId(),
                    'product_id' => (int) $post['product_id'],
                    'message' => strip_tags($post['message']),
                ]);
                $model->save();

                $this->messageManager->addSuccessMessage(__('Your message has been submitted.'));
            } else {
                $this->messageManager->addErrorMessage(__('Invalid form submission.'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred while saving your message.'));
            $this->_objectManager->get(\Psr\Log\LoggerInterface::class)->critical($e);
        }

        return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
    }
}
