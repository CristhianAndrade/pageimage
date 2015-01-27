<?php
class Soulmkt_Pageimage_Model_Mysql4_Pageimage extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("pageimage/pageimage", "id_pageimage");
    }
}