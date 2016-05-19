<?php

class Polcode_Shipping_Model_Resource_Shipping_Collection 
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    
    protected function _construct() {
        $this->_init('polcodeshipping/shipping');
    }


}
