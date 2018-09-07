<?php 
namespace Custom\Sampletemplate\Block\Adminhtml\Template;
 
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected $_coreRegistry = null;
 
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
 
    protected function _construct()
    {
        $this->_objectId = 'template_id';
        $this->_blockGroup = 'Custom_Sampletemplate';
        $this->_controller = 'adminhtml_template';
 
        parent::_construct();
 
        $this->buttonList->update('save', 'label', __('Save Event'));
        $this->buttonList->update('delete', 'label', __('Delete Event'));
 
        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
                ]
            ],
            -100
        );
 
    }
 
 
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('sampletemplate')->getId()) {
            return __(
                "Edit sampletemplate '%1'",
                $this->escapeHtml($this->_coreRegistry->registry('sampletemplate')->getTitle())
            );
        } else {
            return __('New sampletemplate');
        }
    }
}