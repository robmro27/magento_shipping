<?php

/**
 * Description of Calendar
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Calendar extends  Mage_Core_Block_Template {
    
    private $calendar = null;
    
    protected function _prepareLayout() {
        
        parent::_prepareLayout();
        $this->calendar = new Polcode_Shipping_Model_CalendarFront_Calendar();
        
    }
    
    public  function getCalendar() {
        return $this->calendar;
    }
    
}
