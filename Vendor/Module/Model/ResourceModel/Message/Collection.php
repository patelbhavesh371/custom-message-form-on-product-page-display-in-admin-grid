<?php
namespace Vendor\Module\Model\ResourceModel\Message;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(
            \Vendor\Module\Model\Message::class,
            \Vendor\Module\Model\ResourceModel\Message::class
        );
    }
}
