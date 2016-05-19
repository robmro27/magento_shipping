<?php

/**
 * Description of Shipping
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Adminhtml_Shipping extends Mage_Adminhtml_Block_Widget_Grid_Container {
    
    public function __construct()
    {
        $this->_blockGroup = 'polcodeshipping';
        $this->_controller = 'adminhtml_shipping';
        $this->_headerText = $this->__('Polcode Shipping');
         
        parent::__construct();
    }
    
}
