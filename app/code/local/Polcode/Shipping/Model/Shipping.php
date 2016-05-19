<?php

/**
 * Description of Shipping
 *
 * @author rmroz
 */
class Polcode_Shipping_Model_Shipping
    extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('polcodeshipping/shipping');
    }
}
