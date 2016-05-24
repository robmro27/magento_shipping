<?php

/**
 * Extend right progress of OnePage so it display choosen 
 * delivery date and time 
 */
class Polcode_Shipping_Block_Onepage_Progress extends Mage_Checkout_Block_Onepage_Progress
{
    
    /**
     * 
     * @return boolean
     */
    public function displayDeliveryDatetime()
    {
        if($this->getQuote()->getShippingAddress()->getPolcodeShippingId() != null) {
            return true;
        }
        return false;
    }
 
    /**
     * 
     * @return type
     */
    public function getDisplayDeliveryDatetime()
    {
        $shippingId = $this->getQuote()->getShippingAddress()->getPolcodeShippingId();
        $shipping = Mage::getModel('polcodeshipping/shipping')->load($shippingId);
        
        return Mage::helper('polcodeshipping')->weekdays()[$shipping->getWeekday()] . ' ' . $shipping->getHourStart() . '-' . $shipping->getHourEnd(); 
    }
}