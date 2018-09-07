<?php
namespace Custom\Sampletemplate\Block\Adminhtml\Template\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\Object;
use Magento\Store\Model\StoreManagerInterface;

class Template extends \Magento\Framework\Data\Form\Element\AbstractElement
{

    public $collectionFactory;
  /**
     * @var \Magento\Framework\View\Asset\Repository
     */
    private $assetRepo;

    /**
     * @var \Custom\Sampletemplate\Helper\Data
     */
    private $dataHelper;

    /**
     * @var \Custom\Sampletemplate\Helper\Data
     */
    private $helper;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $urlBuider;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry = null;

    const MEDIA_PATH    = 'template/images/';

    const FILETAG_PATH    = 'filetag/images/';
    /**
     * @param \Magento\Framework\View\Asset\Repository $assetRepo
     * @param \Custom\Sampletemplate\Helper\Data $dataHelper
     * @param \Magento\Backend\Helper\Data $helper
     * @param \Magento\Framework\UrlInterface $urlBuilder
     */
    public function __construct(
        \Magento\Framework\View\Asset\Repository $assetRepo,
        \Custom\Sampletemplate\Helper\Data $dataHelper,
        \Magento\Backend\Helper\Data $helper,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Registry $registry,
        \Custom\Sampletemplate\Model\ResourceModel\Template\CollectionFactory $collectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->dataHelper = $dataHelper;
        $this->assetRepo = $assetRepo;
        $this->helper = $helper;
        $this->urlBuilder = $urlBuilder;
        $this->coreRegistry = $registry;
        $this->collectionFactory = $collectionFactory;
        $this->storeManager = $storeManager;
    }

  public function getElementHtml(){
    $mediaUrl = $this->storeManager->getStore()->getBaseUrl(
            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
        ) . self::MEDIA_PATH;
    $attachId = $this->coreRegistry->registry('template_id');
    $fileValue = $this->getValue();
    $collection = $this->collectionFactory->create();
    $items = $collection->addFieldToFilter('template_id', $attachId);
    foreach($items as $item){
        $fileTag = $this->storeManager->getStore()->getBaseUrl(
            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
        ) . self::FILETAG_PATH;
        
        if($item->getFiletagLogo()){
            $fileTagUrl =  $fileTag.'/'.$item->getFiletagLogo();
            $file = "<img src='".$fileTagUrl."' width='50px' height='50px'/>";
        }
    }
    echo $fileValue."<br>";
    $fileUrl =  $mediaUrl.'/'.$fileValue;
    $file .= '<a href="'.$fileUrl.'" target="_blank" download>Open File</a>';
    
    $file .= "<a href='".$this->urlBuilder->getUrl(
                'sampletemplate/template/deletefile', $param = ['template_id' => $attachId])."'>
                <div style='color:red;'>DELETE FILE</div></a>";;
    
    return $file;
  }
}