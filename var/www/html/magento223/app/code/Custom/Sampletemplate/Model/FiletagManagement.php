<?php
namespace Custom\Sampletemplate\Model;

use \Custom\Sampletemplate\Api\Data\FiletagDataInterface;
 
class FiletagManagement implements \Custom\Sampletemplate\Api\FiletagInterface {
 
    
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\Api\ExtensibleDataObjectConverter $extensibleDataObjectConverter,
      \Custom\Sampletemplate\Model\ResourceModel\Filetag\CollectionFactory $collectionFactory
    ) {
        $this->_objectManager = $objectManager;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
        $this->collectionFactory = $collectionFactory;
    }
 
    
    public function getFiletagData($Id) {
        $resultPage = $this->collectionFactory->create();
        $resultPage->addFieldToFilter('filetag_id',array('in'=>$Id));
        return $resultPage->getData();
    }

    public function create(FiletagDataInterface $data){
        $customDataArray = $this->extensibleDataObjectConverter
        ->toNestedArray($data, [], 'Custom\Sampletemplate\Api\Data\FiletagDataInterface');        
        //Saving custom data in the table
        $customModel=$this->_objectManager->create('Custom\Sampletemplate\Model\Filetag');
        $customModel->setData($customDataArray);
        $customModel->save();
        return $data;
    }

    public function delete($id){
        if(!$this->_objectManager->create('Custom\Sampletemplate\Model\Filetag')->load($id)->getData()){
            throw new InputException(__("Invalid ID provided",$id));
        }
        else{
            $this->_objectManager->create('Custom\Sampletemplate\Model\Filetag')->load($id)->delete();
            return true;
        }
    }

    public function update(FiletagDataInterface $data){
        $id=$data->getFiletagId();
        if(!$this->_objectManager->create('Custom\Sampletemplate\Model\Filetag')->load($id)->getData()){
            throw new InputException(__("Invalid ID provided",$id));
        }
        else{
            $customDataArray = $this->extensibleDataObjectConverter
            ->toNestedArray($data, [], 'Custom\Sampletemplate\Api\Data\FiletagDataInterface');
            //Updating custom data in the table
            $customModel = $this->_objectManager->create('Custom\Sampletemplate\Model\Filetag')->load($id);
            $customModel->setData($customDataArray);
            $customModel->save();
        }
        return $data;
    }  
}