<?php
namespace Vendor\Module\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Message extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('vendor_customer_product_message', 'entity_id');
    }
}
