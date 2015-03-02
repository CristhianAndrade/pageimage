<?php

class Soulmkt_Pageimage_Block_GetBlock extends Mage_Adminhtml_Block_Template {


	const ENABLED       	= 	'soulmkt_pageimage/pageimage/enabled';
    const OPACITY  	= 	'soulmkt_pageimage/pageimage/opacity';


	public function enabled()
	{
	 	return Mage::getStoreConfigFlag(self::ENABLED);
	}

	public function getOpacity($type)
	{
		$value = Mage::getStoreConfig(self::OPACITY);

		if(empty($value) || $value == null)
			$value = 100;

		if($type == 100)
		 	return $value;
		else
			return $value / 100;
	}

	protected function _getHtml($id)
	{
		$html = '<a href="#" class="mirror-toggle"><img title="'.$this->__('View Image').'" alt="'.$this->__('View Image').'" src="'.$this->getSkinUrl('images/pageimage/search-pageimage.png').'" /></a>';
		$html .= '<div class="mirror" style="opacity:'.$this->getOpacity(1).'; filter: alpha(opacity='.$this->getOpacity(100).'); "><img title="'.$this->__('Background').'" alt="'.$this->__('Background').'" src="'.$this->getImage($id).'" /></div> ';
		return $html;
	}

	public function checkpage()
	{
		$cmsPage = Mage::getSingleton('cms/page')->getIdentifier();

		if($cmsPage)
		{
			if($this->getCheckImage($cmsPage))
				return $this->_getHtml($cmsPage);
			else
				return false;
		}
		else
		{

			$fullActionName = Mage::app()->getFrontController()->getAction()->getFullActionName();
			if ('checkout_onepage_index' == $fullActionName) {

			    /**** Checkout  ****/
			   	$id = 'pf-pageimage-checkout';
			   	if($this->getCheckImage($id))
					return $this->_getHtml($id);
				else
					return false;
			}


			elseif ('checkout_cart_index' == $fullActionName) {
				  /**** cart ****/
			   	$id = 'pf-pageimage-cart';
			   	if($this->getCheckImage($id))
					return $this->_getHtml($id);
				else
					return false;
			}

			elseif ('catalog_category_view' == $fullActionName) {
				  /**** category ****/
			   	$id = 'pf-pageimage-cat';
			   	if($this->getCheckImage($id))
					return $this->_getHtml($id);
				else
					return false;
			}

			elseif ('catalog_product_view' == $fullActionName) {
				  /**** product ****/
			   	$id = 'pf-pageimage-view';
			   	if($this->getCheckImage($id))
					return $this->_getHtml($id);
				else
					return false;
			}


			elseif ('contacts_index_index' == $fullActionName) {
				  /**** contacts ****/
			   	$id = 'pf-pageimage-contacts';
			   	if($this->getCheckImage($id))
					return $this->_getHtml($id);
				else
					return false;
			}


			elseif ('checkout_onepage_success' == $fullActionName) {
				  /**** success ****/
			   	$id = 'pf-pageimage-checkout-success';
			   	if($this->getCheckImage($id))
					return $this->_getHtml($id);
				else
					return false;
			}

			elseif ('customer_account_login' == $fullActionName) {
			     /**** Login ****/
			   	$id = 'pf-pageimage-login';
			   	if($this->getCheckImage($id))
					return $this->_getHtml($id);
				else
					return false;
			}

			elseif ('customer_account_logoutSuccess' == $fullActionName) {

				 /**** logout ****/
			   	$id = 'pf-pageimage-logout-success';
			   	if($this->getCheckImage($id))
					return $this->_getHtml($id);
				else
					return false;

			}

			elseif ('customer_account_create' == $fullActionName) {
			     /**** Account create ****/
			   	$id = 'pf-pageimage-create-account';
			   	if($this->getCheckImage($id))
					return $this->_getHtml($id);
				else
					return false;
			}
			elseif (0 === strpos($fullActionName, 'catalogsearch_')) {

				 //**** Search ****/
			   	$id = 'pf-pageimage-search';
			   	if($this->getCheckImage($id))
					return $this->_getHtml($id);
				else
					return false;
			}

			elseif (0 === strpos($fullActionName, 'customer_account_')
			 || 0 === strpos($fullActionName, 'customer_address_')
			 || 0 === strpos($fullActionName, 'wishlist_')
			 || 0 === strpos($fullActionName, 'newsletter_manage_')
			 || 0 === strpos($fullActionName, 'review_customer_')
			 || 0 === strpos($fullActionName, 'sales_order_')
			) {

				 //**** Account pages ****/
			   	$id = 'pf-pageimage-account';
			   	if($this->getCheckImage($id))
					return $this->_getHtml($id);
				else
					return false;

			}

		}
	}

	protected function _getPage($id)
	{
		$page = Mage::getModel('pageimage/pageimage')->load($id, 'id_page');
		return $page;
	}

	public function getImage($id)
	{
		$page = $this->_getPage($id);
		return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'pageimage/'.$page->getImage();

	}

	public function getCheckImage($id)
	{
		$page = $this->_getPage($id);

		if($page->getId_page() && $page->getImage())
			return true;
		else
			return false;
	}

}
