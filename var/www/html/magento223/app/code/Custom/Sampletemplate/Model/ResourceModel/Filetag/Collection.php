<?php
namespace Custom\Sampletemplate\Model\ResourceModel\Filetag;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'filetag_id';
    protected function _construct()
    {
        $this->_init('Custom\Sampletemplate\Model\Filetag','Custom\Sampletemplate\Model\ResourceModel\Filetag');
    }
}