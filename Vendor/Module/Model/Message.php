<?php
namespace Vendor\Module\Model;

use Magento\Framework\Model\AbstractModel;

class Message extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Vendor\Module\Model\ResourceModel\Message::class);
    }
}
