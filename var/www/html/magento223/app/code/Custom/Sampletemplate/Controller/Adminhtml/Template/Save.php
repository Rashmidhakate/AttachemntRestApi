<?php
namespace Custom\Sampletemplate\Controller\Adminhtml\Template;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;
use Magento\Framework\Filesystem;

class Save extends \Magento\Backend\App\Action
{
    protected $cacheTypeList;
    protected $jsHelper;

    const ADMIN_RESOURCE = 'Custom_Sampletemplate::save';
    protected $adapterFactory;
    protected $uploader;
    protected $filesystem;


    protected $_filesystem;
    protected $_storeManager;
    protected $_directory;
    protected $_imageFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Backend\Helper\Js $jsHelper,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploader,        
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Filesystem\Driver\File $file,
        \Magento\Framework\Image\AdapterFactory $imageFactory
    )
    {        
        $this->_storeManager = $storeManager;
        $this->_directory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_imageFactory = $imageFactory;
        $this->adapterFactory = $adapterFactory;
        $this->uploader = $uploader;
        $this->filesystem = $filesystem;
        $this->file = $file;
        $this->cacheTypeList = $cacheTypeList;
        parent::__construct($context);
        $this->jsHelper = $jsHelper;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $entity = implode(',',$data["entity_id"]);

        $file = $this->getRequest()->getFiles('file');
        
        if ($data) {
            $model = $this->_objectManager->create('Custom\Sampletemplate\Model\Template');

            $id = $this->getRequest()->getParam('template_id');
            if ($id) {
                $model->load($id);
            }
            if(isset($file["name"]) && !empty($file["name"])){
                if($file && $file["size"] < 5242880){
                    $target = $this->_directory->getAbsolutePath('template/images/');              
                    /** @var $uploader \Magento\MediaStorage\Model\File\Uploader */
                    $uploader = $this->uploader->create(
                        ['fileId' => 'file']
                    );
                    $uploader->setAllowedExtensions(
                        ['jpg', 'jpeg', 'gif', 'png','doc','pdf','xls','docx','zip','mp4','avi','mp3','txt','xlsx','vob','csv','gif']
                    );
                    $uploader->setAllowRenameFiles(true);
                    $uploader->save($target);
                    $this->file->changePermissions($target.'/'.$file["name"],0777);
                }
                else{
                    $this->messageManager->addError("Please Upload file less than 5MB");
                    return $resultRedirect->setPath('sampletemplate/template/edit', ['template_id' => $model->getId(), '_current' => true]);
                }
                $model->setFile($file["name"]);
            }
            $model->setFiletagId($data["filetag_id"]);
            $model->setTemplateName($data["template_name"]);
            $model->setCategory($entity);
            $model->setStore(implode(',',$data["store"]));
            
            try {
                $model->save();
                $this->cacheTypeList->invalidate('full_page');
                $this->messageManager->addSuccess(__('You saved this FileTag.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('sampletemplate/template/edit', ['template_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('sampletemplate/template/index');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Template.'));
            }

            return $resultRedirect->setPath('sampletemplate/template/edit', ['template_id' => $this->getRequest()->getParam('template_id')]);
        }
        return $resultRedirect->setPath('sampletemplate/template/index');
    }


}
