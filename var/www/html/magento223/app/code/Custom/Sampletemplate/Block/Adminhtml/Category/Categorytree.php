<?php
namespace Custom\Sampletemplate\Block\Adminhtml\Category;

use Custom\Sampletemplate\Model\Template\Tree;

class Categorytree extends \Magento\Framework\View\Element\Template implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
  
    protected $_template = 'category/tree.phtml';
    protected $store;
    protected $_storeCategories = [];
    protected $_dataCollectionFactory;
    protected $topMenu;

    protected $_wysiwygConfig;
    protected $_helper;
    protected $_categoryHelper;
    protected $_tree;
    protected $_category;
    protected $_registry;
    
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Model\Category $category,
        \Magento\Framework\Data\CollectionFactory $dataCollectionFactory,
        \Magento\Theme\Block\Html\Topmenu $topMenu,
        \Magento\Catalog\Model\Indexer\Category\Flat\State $categoryFlatState,
        Tree $tree,
        \Custom\Sampletemplate\Model\TemplateFactory $templateFactory,
        array $data = []
        ) 
    {
        $this->_dataCollectionFactory = $dataCollectionFactory;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_categoryHelper = $categoryHelper; 
        $this->storeManager = $context->getStoreManager(); 
        $this->topMenu = $topMenu;
        $this->categoryFlatConfig = $categoryFlatState;
        $this->_tree = $tree;    
        $this->_category = $category;
        $this->_registry= $registry;
        $this->templateFactory = $templateFactory;
        parent::__construct($context,$data);
    }

    public function getCategoryHelper()
    {
        return $this->_categoryHelper;
    }

    public function getHtml()
    {
        return $this->topMenu->getHtml();
    }

    public function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true)
    {
        $node = $this->_tree->getRootNode($this->_category);
        return $this->_tree->getTree($node);
    }   

    public function getSelectedCategories()
    {
        $id=$this->_registry->registry('sampletemplate');
        $image_id=$id->getId();
        $customimage=$this->templateFactory->create();
        $collection=$customimage->getCollection()->addFieldToFilter('template_id',$image_id);
        return $collection;
    }
    
    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('General Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('General Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
}
