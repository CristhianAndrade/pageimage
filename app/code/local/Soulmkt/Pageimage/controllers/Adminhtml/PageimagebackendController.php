<?php
class Soulmkt_Pageimage_Adminhtml_PageimagebackendController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
       $this->loadLayout();
	   $this->_title($this->__("Manage Page Image"));
	   $this->renderLayout();
    }
	
	public function deleteImageAction()
    {
    	$id = $this->getRequest()->getParam('id');
    	$page = $this->_getPage($id);
		
		if($page->getImage())
		{
			$file = Mage::getBaseDir('media').DS.'pageimage'.DS.$page->getImage();	
			
			if(unlink($file))
			{
				$page->delete();
				$message = $this->__('Image deleted'); 
				Mage::getSingleton('adminhtml/session')->addSuccess($message);
			} 
			else
			{
				$message = $this->__('Could not delete the image');
				Mage::getSingleton('adminhtml/session')->addError($message);
			}
		}
		else
		{
			$message = $this->__('The page does not exist');
			Mage::getSingleton('adminhtml/session')->addError($message);
		}
		
		Mage::app()->getResponse()->setRedirect(Mage::helper('adminhtml')->getUrl("pageimage/adminhtml_pageimagebackend/index"));	
	}
	
	public function uploadImageAction()
    {
    	if(isset($_FILES['imagem']['name']) and (file_exists($_FILES['imagem']['tmp_name']))) {
 	 		try {
			    $uploader = new Varien_File_Uploader('imagem');
			    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); // or pdf or anything
				$uploader->setAllowRenameFiles(false);
	 
			    // setAllowRenameFiles(true) -> move your file in a folder the magento way
			    // setAllowRenameFiles(true) -> move your file directly in the $path folder
	   			$uploader->setFilesDispersion(false);
	    		$path = Mage::getBaseDir('media') . DS .'pageimage';
	            
				$path2 = $_FILES['imagem']['name'];
				$ext = pathinfo($path2, PATHINFO_EXTENSION); 
				$new_name = uniqid().'.'.$ext;
				
	    		$uploader->save($path, $new_name);
				
	 			$id = $this->getRequest()->getParam('id');
    			$page = $this->_getPage($id);
				
				if($page->getId_page())
				{
					$page->setImage($new_name);
				}
				else {
					$page->setId_page($id);
					$page->setImage($new_name);
					$page->setEnable(1);
					$page->setDescription("");
				} 
				
				$page->save();
				
				$message = $this->__('Inserted image'); 
				Mage::getSingleton('adminhtml/session')->addSuccess($message);
				Mage::app()->getResponse()->setRedirect(Mage::helper('adminhtml')->getUrl("pageimage/adminhtml_pageimagebackend/index"));	
	
			
	    		
  			}catch(Exception $e) {
 				
				$message = $this->__('Could not insert the image');
				Mage::getSingleton('adminhtml/session')->addError($message);
				Mage::app()->getResponse()->setRedirect(Mage::helper('adminhtml')->getUrl("pageimage/adminhtml_pageimagebackend/index"));
	
  			}
		}
		else
		{
			$message = $this->__('Erro no arquivo selecionado');
			Mage::getSingleton('adminhtml/session')->addError($message);
			Mage::app()->getResponse()->setRedirect(Mage::helper('adminhtml')->getUrl("pageimage/adminhtml_pageimagebackend/index"));	
		}
	}
	
	protected function _getPage($id)
	{
		$page = Mage::getModel('pageimage/pageimage')->load($id, 'id_page');
		return $page;
	}
}