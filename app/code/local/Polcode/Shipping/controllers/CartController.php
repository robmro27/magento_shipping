<?php

require_once 'Mage/Checkout/controllers/CartController.php';

/**
 * Description of CartController
 *
 * @author rmroz
 */
class Polcode_Shipping_CartController extends Mage_Checkout_CartController {
    
    
    /**
     * If update total than if no shipping to delivery date
     */
    public function estimateUpdatePostAction()
    {
        
        parent::estimateUpdatePostAction();
        
        $estimateMethod = $this->getRequest()->get('estimate_method');
        if ( $estimateMethod != Polcode_Shipping_Model_Carrier::get_code() ) {
            
            $cart = Mage::getModel('checkout/cart')->getQuote();
            $cart->getShippingAddress()->setPolcodeShippingId();
            $cart->getShippingAddress()->setPolcodeDeliveryDate();
            $cart->save();
            
        }
        
        
        
    }
    
}
