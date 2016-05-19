<?php

/**
 * Description of Polcode_Shipping_Model_Carrier
 *
 * @author rmroz
 */
class Polcode_Shipping_Model_Carrier extends Mage_Shipping_Model_Carrier_Abstract 
implements Mage_Shipping_Model_Carrier_Interface {
    
    protected $_code = 'polcodeshipping';
    
    public function getAllowedMethods()
    {
        $methods = Mage::helper('polcodeshipping')->nextWeekDates();
        return $methods;
    }
    
    
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) 
        {
            return false;
        }
 
        $result = Mage::getModel('shipping/rate_result');
 
        foreach($this->getAllowedMethods() as $methodName => $methodTitle)
        {            
            
            $weekdayName = date( "l", strtotime($methodTitle));
            
            $method = Mage::getModel('shipping/rate_result_method');
            
            
            
            $method->setCarrier($this->_code);
            $method->setMethod($methodName);
            $method->setCarrierTitle($this->getConfigData('title'));
            $method->setMethodTitle($methodTitle . ' ' . $weekdayName);
            
            
            $method->setPrice(10);
            $method->setCost(25);
            $result->append($method);
        }
 
        return $result;
    }
    
    
    
    
}
