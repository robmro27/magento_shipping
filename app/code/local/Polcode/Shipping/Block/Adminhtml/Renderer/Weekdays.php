<?php

/**
 * Description of Weekdays
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Adminhtml_Renderer_Weekdays 
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    
    public function render(\Varien_Object $row) {
        $val = $this->_getValue($row);
        return Mage::helper('polcodeshipping')->weekdays()[$val];
    }
    
    
    
}
