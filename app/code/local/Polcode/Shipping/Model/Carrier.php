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
        $methods = array('standard' => 'Standard');  
        return $methods;
    }
    
    
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {     
        if (!$this->getConfigFlag('active'))  {
            return false;
        } 
        
        // shipping model
        $shippingModel = Mage::getModel('polcodeshipping/shipping');
        
        // set default 
        $datetime = new DateTime();
        $datetime->modify('+1 day');
        $tomorrow =  $datetime->format('N');
        $default = $shippingModel->getCollection()->addFieldToFilter('weekday', $tomorrow)
                                                  ->getFirstItem();
        
        $weekdayName = Mage::helper('polcodeshipping')->weekdays()[$default['weekday']];
        $defaultDate = date('Y-m-d', strtotime("next " . $weekdayName));
        
       
        $cart = Mage::getModel('checkout/cart')->getQuote();
        if ( !$cart->getShippingAddress()->getPolcodeShippingId() ||
             !$cart->getShippingAddress()->getPolcodeDeliveryDate())  {
            $cart->getShippingAddress()->setPolcodeShippingId($default->getId());
            $cart->getShippingAddress()->setPolcodeDeliveryDate($defaultDate);
        }
        
        $shippingId = $cart->getShippingAddress()->getPolcodeShippingId();
        $shippingModel = $shippingModel->load($shippingId);
        
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
