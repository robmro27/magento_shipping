<?php

require_once 'Mage/Checkout/controllers/CartController.php';

/**
 * Description of CartController
 *
 * @author rmroz
 */
class Polcode_Shipping_CartController extends Mage_Checkout_CartController {
    
    /**
     * Polcode shipping method code
     */
    const SHIPPING_CODE = 'polcodeshipping_standard';
    
    /**
     * If update total update shipping methods and calendar dates
     */
    public function estimateUpdatePostAction()
    {
        parent::estimateUpdatePostAction();
        
        $polcodeShippingId = null;
        $polcodeShippingDate = null;
        
        $estimateMethod = $this->getRequest()->get('estimate_method');
        if ( $estimateMethod == self::SHIPPING_CODE ) {
            $polcodeShippingDate = $this->getRequest()->get('polcode_delivery_date');
            $polcodeShippingId =  $this->getRequest()->get('polcode_shipping_id');
        } 
        
        $cart = Mage::getModel('checkout/cart')->getQuote();
        $cart->getShippingAddress()->setPolcodeShippingId($polcodeShippingId);
        $cart->getShippingAddress()->setPolcodeDeliveryDate($polcodeShippingDate);
        $cart->save();
    }
    
}
