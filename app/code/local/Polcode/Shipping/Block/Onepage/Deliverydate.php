<?php

/**
 * Description of Deliverydate
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Onepage_Deliverydate extends Mage_Checkout_Block_Onepage_Abstract
{
    
    private $nextWeekDays;
    private $intervalsByDays;
    
    protected function _prepareLayout() 
    {
        $this->nextWeekDays = Mage::helper('polcodeshipping')->nextWeekDates();
        
        
        
        
        $shippingIntervals = Mage::getModel('polcodeshipping/shipping');
        foreach ($shippingIntervals->getCollection()->getData() as $interval) {
            $this->intervalsByDays[$interval['weekday']][] = $interval;
        }
        
        
        
    }
    
    public function __construct()
    {
        $this->setTemplate('polcode/shipping/checkout/onepage/shipping_method/deliverydate.phtml');     
    }
 
    public function getPostUrl()
    {
        return Mage::getUrl('checkout/onepage/deliverydate', array('_secure'=>true)); 
    }

    public function getNextWeekDays() {
        return $this->nextWeekDays;
    }
    
    public function getIntervalsByDays() {
        return $this->intervalsByDays;
    }
    
}
