<?php
namespace Custom\Sampletemplate\Model;
class Template extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Custom\Sampletemplate\Model\ResourceModel\Template');
    }
}

