<?php

/**
 * Description of Onepage
 *
 * @author rmroz
 */
class Polcode_Shipping_Model_Checkout_Onepage extends Mage_Checkout_Model_Type_Onepage
{
    public function saveBilling($data, $customerAddressId)
    {
        $polcodeShippingId = $this->getQuote()->getShippingAddress()->getPolcodeShippingId();
        $polcodeDeliveryDate = $this->getQuote()->getShippingAddress()->getPolcodeDeliveryDate();
        
        
        
        $returnValue = parent::saveBilling($data, $customerAddressId);
        $this->getQuote()->getShippingAddress()
             ->setPolcodeShippingId($polcodeShippingId)
             ->setPolcodeDeliveryDate($polcodeDeliveryDate)
             ->save();
        return $returnValue;
    }
}
