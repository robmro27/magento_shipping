<?php
require_once 'Mage/Checkout/controllers/OnepageController.php';
class Polcode_Shipping_OnepageController extends Mage_Checkout_OnepageController
{   
    public function deliverydateAction()
    {
        $date = null;       
        
        $shippingMethod = $this->getRequest()->getParams('shipping_method')['interval'];
        $polcodeShippingId = $this->getRequest()->getParams('polcode_shipping_id')['interval'];
        
        echo '<pre>';
        print_r($this->getRequest()->getParams('polcode_shipping_id'));
        echo '</pre>';
        die;
        
        if ( $polcodeShippingId ) {
            $shippingMethod = 'polcodeshipping_standard';
        }
        
        
        if ( $shippingMethod == 'polcodeshipping_standard' ) {
            $date = $this->getDayDateByShippingId($polcodeShippingId);
        }
        
        
        
        

        $cart = Mage::getModel('checkout/cart')->getQuote();
        
        $cart->collectTotals();
        
        $cart->getShippingAddress()
             ->setCollectShippingRates(true)
             ->setShippingMethod($shippingMethod)
             ->setPolcodeShippingId($polcodeShippingId)
             ->setPolcodeDeliveryDate($date);
        
        if (!isset($result['error'])) {
            $result['goto_section'] = 'shipping_method';
            $result['update_section'] = array(
                'name' => 'shipping-method',
                'html' => $this->_getShippingMethodsHtml()
            );
        }
        
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }
    
    
    private function getDayDateByShippingId( $id ) 
    {
        $interval = Mage::getModel('polcodeshipping/shipping')->load( $id );
        return Mage::helper('polcodeshipping')->getDateForNextWeekDay( $interval['weekday'] );
    }
    
}
