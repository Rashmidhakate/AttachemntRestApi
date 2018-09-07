<?php

/**
 
 *
 * @category Sampletemplate
 * @package Custom_Sampletemplate
 * @copyright Copyright (c) 2018 MagePrince
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince
 */

namespace Custom\Sampletemplate\Block\Adminhtml;

/**
 * Class Filetag
 * @package Custom\Sampletemplate\Block\Adminhtml
 */
class Template extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    public function _construct()
    {
        $this->_controller = 'adminhtml_template';
        $this->_blockGroup = 'Custom_Sampletemplate';
        $this->_headerText = __('Template ');
        $this->_addButtonLabel = __('Add New Template');
        parent::_construct();
        if ($this->_isAllowedAction('Custom_Sampletemplate::save')) {
            $this->buttonList->update('add', 'label', __('Add New Template'));
        } else {
            $this->buttonList->remove('add');
        }
    }
    
    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    public function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
