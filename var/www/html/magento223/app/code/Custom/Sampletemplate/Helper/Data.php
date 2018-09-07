<?php

/**
 * MagePrince
 * Copyright (C) 2018 Mageprince
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html
 *
 * @category MagePrince
 * @package Prince_Productattach
 * @copyright Copyright (c) 2018 MagePrince
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince
 */

namespace Custom\Sampletemplate\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Media path to extension images
     *
     * @var string
     */
    const MEDIA_PATH    = 'filetag/images/';

    /**
     * @var \Magento\Framework\Filesystem\Directory\WriteInterface
     */
    private $mediaDirectory;

    /**
     * @var \Magento\Framework\Filesystem
     */
    private $filesystem;

    /**
     * File Uploader factory
     *
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    private $fileUploaderFactory;
    
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Magento\Backend\Model\UrlInterface
     */
    private $backendUrl;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Backend\Model\UrlInterface $backendUrl
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Backend\Model\UrlInterface $backendUrl,
        \Magento\Framework\View\Element\Template $template,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->backendUrl = $backendUrl;
        $this->template = $template;
        $this->filesystem = $filesystem;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->fileUploaderFactory = $fileUploaderFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }
    

    /**
     * Return the base media directory for Productattach Item images
     *
     * @return string
     */
    public function getBaseDir()
    {
        $path = $this->filesystem->getDirectoryRead(
            DirectoryList::MEDIA
        )->getAbsolutePath(self::MEDIA_PATH);
        return $path;
    }
    
    /**
     * Return the Base URL for Productattach Item images
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl(
            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
        ) . self::MEDIA_PATH;
    }

    public function getCategoryTree(){
        return $this->template->getLayout()
                ->createBlock('Custom\Sampletemplate\Block\Adminhtml\Category\Categorytree')
                ->setTemplate('Custom_Sampletemplate::category/tree.phtml')
                ->toHtml();
                // $this->template->getLayout()
                // ->createBlock('Magento\Catalog\Block\Adminhtml\Category\Tree')
                // ->setTemplate('Magento_Catalog::catalog/category/tree.phtml')
                // ->toHtml();
    }   
    
    
}
