<?php

/**
 * Extended to display delivery date and time
 * @author Robert
 */
class Polcode_Shipping_Model_Sales_Order 
    extends Mage_Sales_Model_Order
{
    
    /**
     * Check to display delivery date time in admin
     * @return boolean
     */
    public function displayDeliveryDateTimeInterval() 
    {
        if ( $this->getPolcodeDeliveryDate() != null &&
             $this->getPolcodeShippingId() != null) {
            return true;
        }
        return false;
    }
    
    /**
     * Returns display version of selected delivery date and interval
     * @return type
     */
    public function getDisplayDeliveryDateTimeInterval()
    {
        $shippingDate = $this->getPolcodeDeliveryDate();
        $shippingId = $this->getPolcodeShippingId();
        
        return  Mage::helper('polcodeshipping')->getDisplaySelectedDeliveryDateTime( $shippingDate, $shippingId ); 
    }
}
