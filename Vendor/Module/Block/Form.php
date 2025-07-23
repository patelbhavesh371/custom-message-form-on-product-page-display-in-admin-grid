<?php

namespace Vendor\Module\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Block\Account\AuthorizationLink;
use Magento\Framework\Registry;

class Form extends Template
{
    protected $authLink;
    protected $registry;

    public function __construct(
        Template\Context $context,
        AuthorizationLink $authLink,
        Registry $registry,
        array $data = []
    ) {
        $this->authLink = $authLink;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Check if the customer is logged in
     *
     * @return bool
     */
    public function isCustomerLoggedIn()
    {
        return $this->authLink->isLoggedIn();
    }

    /**
     * Get current product ID from registry
     *
     * @return int|null
     */
    public function getProductId()
    {
        $product = $this->registry->registry('current_product');
        return $product ? (int) $product->getId() : null;
    }

    /**
     * Get form action URL
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('customform/index/post');
    }

    /**
     * Get login URL
     *
     * @return string
     */
    public function getLoginUrl()
    {
        return $this->getUrl('customer/account/login');
    }
}
