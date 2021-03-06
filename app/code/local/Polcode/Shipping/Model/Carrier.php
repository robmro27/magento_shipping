<?php


/**
 * Shipping carrier for polcode shipping
 *
 * @author rmroz
 */
class Polcode_Shipping_Model_Carrier extends Mage_Shipping_Model_Carrier_Abstract 
implements Mage_Shipping_Model_Carrier_Interface {
    
    
    
    protected $_code = 'polcodeshipping';
    
    public static $codeMethod = 'polcodeshipping_standard';
    
    
    public function getAllowedMethods()
    {
        $methods = array('standard' => 'Standard');  
        return $methods;
    }
    
    /**
     * Returns calculated price for delivery date
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return boolean|Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {     
        if (!$this->getConfigFlag('active'))  {
            return false;
        } 
        
        // shipping model
        $shippingId = Mage::getModel('checkout/cart')->getQuote()->getShippingAddress()->getPolcodeShippingId();
        $shippingModel = Mage::getModel('polcodeshipping/shipping')->load($shippingId);
        
        $result = Mage::getModel('shipping/rate_result');
        foreach($this->getAllowedMethods() as $methodName => $methodTitle) {      
            
            $method = Mage::getModel('shipping/rate_result_method');
            $method->setCarrier($this->_code);
            $method->setMethod($methodName);
            $method->setCarrierTitle($this->getConfigData('title'));
            $method->setMethodTitle($methodTitle);
            $method->setPrice($shippingModel->getData()['cost']);
            $result->append($method);
        }
 
        return $result;
    }
    
}
