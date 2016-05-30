<?php

/**
 * Extended to display delivery date and time
 * @author Robert
 */
class Polcode_Shipping_Model_Sales_Order 
    extends Mage_Sales_Model_Order
{
    
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
