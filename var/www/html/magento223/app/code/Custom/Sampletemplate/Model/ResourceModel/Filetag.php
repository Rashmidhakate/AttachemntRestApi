<?php
namespace Custom\Sampletemplate\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Filetag extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('cp_filetag_manage','filetag_id');
    }
}

