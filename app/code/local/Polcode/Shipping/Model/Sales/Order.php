<?php

/**
 * Description of Order
 *
 * @author Robert
 */
class Polcode_Shipping_Model_Sales_Order 
    extends Mage_Sales_Model_Order
{
    public function getDisplayDeliveryDateTimeInterval()
    {
        $interval = Mage::getModel('polcodeshipping/shipping')->load($this->getPolcodeShippingId());
        
        echo $this->getPolcodeDeliveryDate() . ' ' . 
             $interval->getHourStart() . '-' . 
             $interval->getHourEnd();
    }
}
