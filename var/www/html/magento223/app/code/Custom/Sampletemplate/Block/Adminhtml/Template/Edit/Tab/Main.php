<?php

/**
 * MageCustom
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
 * @category MageCustom
 * @package Custom_Productattach
 * @copyright Copyright (c) 2018 MageCustom
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MageCustom
 */

namespace Custom\Sampletemplate\Block\Adminhtml\Template\Edit\Tab;

/**
 * Class Main
 * @package Custom\Productattach\Block\Adminhtml\Productattach\Edit\Tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    private $systemStore;

    /**
     * @var \Magento\Customer\Model\ResourceModel\Group\Collection
     */
    private $customerCollection;

    /**
     * Main constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param \Magento\Customer\Model\ResourceModel\Group\Collection $customerCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerCollection,
        \Custom\Sampletemplate\Model\Filetagoption $filetagCollection,
        \Magento\Catalog\Ui\Component\Product\Form\Categories\Options $categoryTree,
        array $data = []
    ) {
        $this->systemStore = $systemStore;
        $this->storeManagerInterface = $storeManagerInterface;
        $this->customerCollection = $customerCollection;
        $this->filetagCollection = $filetagCollection;
        $this->categoryTree = $categoryTree;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    public function _prepareForm()
    {   
        /** @var $model \Tutorial\SimpleNews\Model\News */
        $model = $this->_coreRegistry->registry('sampletemplate');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('template_main_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Template Information')]
        );

        if ($model->getId()) {
            $fieldset->addField('template_id', 'hidden', ['name' => 'template_id']);
        }
        $fieldset->addField(
            'filetag_id',
            'select',
            [
                'name' => 'filetag_id',
                'label' => __('Filetag'),
                'title' => __('Active'),
                'values' => $this->filetagCollection->toOptionArray()
            ]
        );
        $fieldset->addField(
            'template_name',
            'text',
            [
                'name' => 'template_name',
                'label' => __('Template Name'),
                'title' => __('Template Name'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'files',
            'file',
            [
                'name' => 'file',
                'title' => __('File'),
                'label' => __('File'),
                'note' => 'Upload file less than 5 MB',
            ]
        );
        if($model->getFile()){
            $fieldset->addType(
                'uploadedfile',
                \Custom\Sampletemplate\Block\Adminhtml\Template\Renderer\Template::class
            );

            $fieldset->addField(
                'file',
                'uploadedfile',
                [
                    'name'  => 'uploadedfile',
                    'label' => __('Uploaded File'),
                    'title' => __('Uploaded File'),
                ]
            );
        }

        $fieldset->addField(
            'store',
            'multiselect',
            [
                'name' => 'store[]',
                'label' => __('Store'),
                'title' => __('Store'),
                'required' => true,
                'value' => [0],
                'values' => $this->systemStore->getStoreValuesForForm(false, true)
            ]
        );

        $this->_eventManager->dispatch('adminhtml_template_edit_tab_main_prepare_form', ['form' => $form]);

        if ($model->getId()) {
            $form->setValues($model->getData());
        }
        
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Template Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Template Information');
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
    public function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
