<?php
namespace Custom\Sampletemplate\Block\Adminhtml\Filetag\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\Object;
use Magento\Store\Model\StoreManagerInterface;

class Filetag extends \Magento\Framework\Data\Form\Element\AbstractElement
{
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
        \Magento\Framework\Registry $registry
    ) {
        $this->dataHelper = $dataHelper;
        $this->assetRepo = $assetRepo;
        $this->helper = $helper;
        $this->urlBuilder = $urlBuilder;
        $this->coreRegistry = $registry;
    }

  public function getElementHtml(){
    $mediaUrl = $this->dataHelper->getBaseUrl();
    $fileValue = $this->getValue();
    $fileUrl =  $mediaUrl.'/'.$fileValue;
    $file = "<img src='".$fileUrl."' width='50px' height='50px'/>";
    $file .= '<a href="'.$fileUrl.'" target="_blank" download>Open File</a>';
    $attachId = $this->coreRegistry->registry('filetag_id');
    $file .= "<a href='".$this->urlBuilder->getUrl(
                'sampletemplate/filetag/deletefile', $param = ['filetag_id' => $attachId])."'>
                <div style='color:red;'>DELETE FILE</div></a>";;
    
    return $file;
  }
}