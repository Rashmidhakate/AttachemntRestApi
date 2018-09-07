<?php
namespace Custom\Sampletemplate\Model;

use Magento\Framework\Data\OptionSourceInterface;

class Filetagoption implements \Magento\Framework\Option\ArrayInterface
{

	public $collectionFactory;

    public function __construct(
    	\Custom\Sampletemplate\Model\ResourceModel\Filetag\CollectionFactory $collectionFactory
    	)
    {
        $this->collectionFactory = $collectionFactory;
    }

	public function toOptionArray()
	{
		$collection = $this->collectionFactory->create();
		$options = [];
        foreach ($collection as $value) {
            $options[] = [
            	'label' => $value->getFiletagName(),
            	'value'=>$value->getFiletagId()
            ];
        }
        return $options;
	}
}

