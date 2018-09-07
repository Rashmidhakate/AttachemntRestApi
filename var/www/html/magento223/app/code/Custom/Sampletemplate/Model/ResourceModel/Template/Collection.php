<?php
namespace Custom\Sampletemplate\Model\ResourceModel\Template;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection 
{
	protected $_idFieldName = 'template_id';
    protected function _construct()
    {
        $this->_init('Custom\Sampletemplate\Model\Template','Custom\Sampletemplate\Model\ResourceModel\Template');
    }
    protected function _initSelect()
	{
		parent::_initSelect();
		$this->getSelect()->joinLeft(
		    ['selection' => $this->getTable('cp_filetag_manage')],
		    'main_table.filetag_id = selection.filetag_id',
		    ['*']
		);
	}
}