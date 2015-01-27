<?php  

class Soulmkt_Pageimage_Block_Adminhtml_Pageimagebackend extends Mage_Adminhtml_Block_Template {
	
	public function getAllCsmPage()
	{
		$collection = Mage::getModel('cms/page')->getCollection();
		$collection->setFirstStoreFlag(true);
		
		if(count($collection))
		{
			return $collection;
		}
	}
	
	protected function _getPage($id)
	{
		$page = Mage::getModel('pageimage/pageimage')->load($id, 'id_page');
		return $page;
	}
	
	public function checkExistsImage($id)
	{
		$page = $this->_getPage($id);
		if($page->getImage())
			return true;
		else
			return false;
	} 
	
	
	public function getRow($id, $title)
	{
		$html = 	'<div class="row" '.$this->getImage($id).'>'; 
		$html .= 	'<span class="title">'.$this->__($title).'</span>';
							
		if($this->checkExistsImage($id))
		{
			$html .= '<a href="'.Mage::helper("adminhtml")->getUrl("pageimage/adminhtml_pageimagebackend/deleteimage",  array("id"=>$id)).'" title="'.$this->__('Remove Image').'" class="add remove-image"></a>';
		}else{
			$html .=  '<a href="javascript:document.getElementById(\'fl-'.$id.'\').click(); " title="'.$this->__('Add Image').'" class="add add-image"></a>';
								
			$html .=			'<form style="display: none" id="fm-'.$id.'" action="'.Mage::helper("adminhtml")->getUrl("pageimage/adminhtml_pageimagebackend/uploadimage").'" method="post" enctype="multipart/form-data">';
			$html .=				'<input onchange="document.getElementById(\'fm-'.$id.'\').submit();" type="file" id="fl-'.$id.'" name="imagem" />';
			$html .=				'<input type="hidden" value="'.$id.'" name="id" />';
			$html .=				'<input type="hidden" name="form_key" value="'.Mage::getSingleton('core/session')->getFormKey().'" />'; 
			$html .=			'</form>';
								
		}
	
			$html .=	'</div>';
			return $html;
	} 
	
	
	public function getImage($id)
	{
		$page = $this->_getPage($id);
		$url_no_image =  $this->getSkinUrl('images/pageimage/picture.jpg');
		
		if($page->getId_page())
		{
			return 'style="background: url('.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'pageimage/'.$page->getImage().') 
			no-repeat top center ;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			"'; 
		}
		else
			return 'style="background: url('.$url_no_image.') #eeeeee no-repeat center ;"';
	}
	
}