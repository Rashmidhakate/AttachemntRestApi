<?php

namespace Custom\Sampletemplate\Block\Adminhtml\Filetag\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('filetag_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('FileTag Information'));
    }
}
