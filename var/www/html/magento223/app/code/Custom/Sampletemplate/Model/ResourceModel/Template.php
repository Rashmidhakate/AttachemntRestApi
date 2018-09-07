<?php
namespace Custom\Sampletemplate\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Template extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('cp_sampletemplate_manage','template_id');
    }
}

