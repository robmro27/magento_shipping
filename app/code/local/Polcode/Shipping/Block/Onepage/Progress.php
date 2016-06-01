<?php

/**
 * Extend right progress of OnePage so it display choosen 
 * delivery date and time 
 */
class Polcode_Shipping_Block_Onepage_Progress extends Mage_Checkout_Block_Onepage_Progress
{
    
    /**
     * Flag to display delivery date time
     * @return boolean
     */
    public function displayDeliveryDatetime()
    {
        if($this->getQuote()->getShippingAddress()->getPolcodeShippingId() != null && 
           $this->getQuote()->getShippingAddress()->getPolcodeDeliveryDate() != null) {
            return true;
        }
        return false;
    }
 
    /**
     * Return display string of delivery date and time
     * @return string
     */
    public function getDisplayDeliveryDatetime()
    {   
        $shippingDate = $this->getQuote()->getShippingAddress()->getPolcodeDeliveryDate();
        $shippingId = $this->getQuote()->getShippingAddress()->getPolcodeShippingId();
                
        return Mage::helper('polcodeshipping')->getDisplaySelectedDeliveryDateTime( $shippingDate, $shippingId ); 
    }
}