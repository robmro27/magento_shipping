<?php

class Polcode_Shipping_Model_Resource_Shipping
    extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct() {
        $this->_init('polcodeshipping/shipping', 'id');
    }
}