<?php

require_once 'Mage/Checkout/controllers/CartController.php';

/**
 * Description of CartController
 *
 * @author rmroz
 */
class Polcode_Shipping_CartController extends Mage_Checkout_CartController {
    
    /**
     * If update total update shipping methods and calendar dates
     */
    public function estimateUpdatePostAction()
    {
        parent::estimateUpdatePostAction();
        
        $polcodeShippingId = null;
        $polcodeShippingDate = null;
        
        $estimateMethod = $this->getRequest()->get('estimate_method');
        if ( $estimateMethod == Polcode_Shipping_Model_Carrier::$codeMethod ) {
            
            $polcodeShippingId =  $this->getRequest()->get('polcode_shipping_id');
            $calendarInterval = Mage::getModel('polcodeshipping/shipping')->load($polcodeShippingId);
            $polcodeShippingDate = Mage::helper('polcodeshipping')->getDateForNextWeekDay( $calendarInterval['weekday'] );
            
        } 
        
        $cart = Mage::getModel('checkout/cart')->getQuote();
        $cart->getShippingAddress()->setPolcodeShippingId($polcodeShippingId);
        $cart->getShippingAddress()->setPolcodeDeliveryDate($polcodeShippingDate);
        $cart->save();
    }
    
}
