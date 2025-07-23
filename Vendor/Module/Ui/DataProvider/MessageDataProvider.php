<?php
namespace Vendor\Module\Ui\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Vendor\Module\Model\ResourceModel\Message\CollectionFactory;

class MessageDataProvider extends AbstractDataProvider
{
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
    	
        $items = $this->collection->getItems();
	    $data = [];

	    foreach ($items as $item) {
	        $data[] = $item->getData();
	    }

	    return [
	        'items' => $data,
	        'totalRecords' => $this->collection->getSize()
	    ];
    }
}
