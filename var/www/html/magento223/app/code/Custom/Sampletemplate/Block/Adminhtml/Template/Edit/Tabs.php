<?php

namespace Custom\Sampletemplate\Block\Adminhtml\Template\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('template_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Template Information'));
    }
}
