<?php

/**
 * Description of Edit
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Adminhtml_ShippingExcludes_Edit 
extends Mage_Adminhtml_Block_Widget_Form_Container
{
    
    /**
     * Init class
     */
    public function __construct()
    {  
        $this->_blockGroup = 'polcodeshipping';
        $this->_controller = 'adminhtml_shippingexcludes';
     
        parent::__construct();
     
        $this->_updateButton('save', 'label', $this->__('Save Shipping Exclude'));
        $this->_updateButton('delete', 'label', $this->__('Delete Shipping Exclude'));
    }  
     
    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {  
        if (Mage::registry('polcodeshipping')->getId()) {
            return $this->__('Edit Shipping Exclude');
        }  
        else {
            return $this->__('New Shipping Exclude');
        }  
    }  
    
}
