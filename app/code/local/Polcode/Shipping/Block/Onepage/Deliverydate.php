<?php

/**
 * Description of Deliverydate
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Onepage_Deliverydate extends Mage_Checkout_Block_Onepage_Abstract
{
    
    /**
     * Calendar
     * @var Polcode_Shipping_Model_CalendarFront_Calendar 
     */
    private $calendar = null;
    
    
    protected function _prepareLayout() 
    {
        $this->calendar = new Polcode_Shipping_Model_CalendarFront_Calendar();
    }
    
    
    public function __construct()
    {
        $this->setTemplate('polcode/shipping/checkout/onepage/shipping_method/deliverydate.phtml');     
    }
 
    
    public function getPostUrl()
    {
        return Mage::getUrl('checkout/onepage/deliverydate', array('_secure'=>true)); 
    }

    
    
    public function getCalendar() 
    {    
        return $this->calendar;   
    }


    
    
    
    
    
    
    
}
