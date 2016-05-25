<?php

/**
 * Description of Shipping
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Adminhtml_ShippingExcludes extends Mage_Adminhtml_Block_Widget_Grid_Container {
    
    public function __construct()
    {
        $this->_blockGroup = 'polcodeshipping';
        $this->_controller = 'adminhtml_shippingexcludes';
        $this->_headerText = $this->__('Polcode Shipping Excludes');
         
        parent::__construct();
    }
    
}
