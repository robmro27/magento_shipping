<?php

/**
 * Description of Deliverydate
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Onepage_Deliverydate extends Mage_Checkout_Block_Onepage_Abstract
{
    
    private $price = 0;
    
    protected function _prepareLayout() {
        
        $this->price = 10;
        
    }
    
    public function __construct()
    {
        $this->setTemplate('polcode/shipping/checkout/onepage/shipping_method/deliverydate.phtml');     
    }
 
    public function getPostUrl()
    {
        return Mage::getUrl('checkout/onepage/deliverydate', array('_secure'=>true)); 
    }
    
    public function getPrice() {
        return $this->price;
    }


    
    
}
