<?php
require_once 'Mage/Checkout/controllers/OnepageController.php';
class Polcode_Shipping_OnepageController extends Mage_Checkout_OnepageController
{   
    /**
     * Change Shipping Method 
     */
    public function changeShippngMethodAction()
    {
        $shippingMethod = $this->getRequest()->getParams()['params'];
       
        // set default shipping date interval
        if ( $shippingMethod == Polcode_Shipping_Model_Carrier::$codeMethod ) {
            
            $calendar = new Polcode_Shipping_Model_CalendarFront_Calendar();
            $calendarInterval = $calendar->getDays()[0]->getIntervals()[0];
            
            $polcodeShippingId = $calendarInterval['id'];
            $polcodeShippingDate = Mage::helper('polcodeshipping')->getDateForNextWeekDay( $calendarInterval['weekday'] );
            
        } 
        // reset shipping date interval
        else {
            $polcodeShippingId = null;
            $polcodeShippingDate = null;
        }
        
        $this->returnResult($shippingMethod, $polcodeShippingId, $polcodeShippingDate);
    }
    
    
    /**
     * Change Shipping Date
     */
    public function changeShippngDateAction()
    {
        
        $shippingMethod = Polcode_Shipping_Model_Carrier::$codeMethod;
        $polcodeShippingId = $this->getRequest()->getParams()['params'];
        
        $interval = Mage::getModel('polcodeshipping/shipping')->load($polcodeShippingId);
        
        $polcodeShippingDate = Mage::helper('polcodeshipping')->getDateForNextWeekDay( $interval['weekday'] );
        $this->returnResult($shippingMethod, $polcodeShippingId, $polcodeShippingDate);
    }
    
    

    /**
     * Sets shipping method and date into quote and refresh 
     * select shipping step in checkout
     * @param int $shippingMethod
     * @param int $polcodeShippingId
     * @param string $polcodeShippingDate
     */
    private function returnResult( $shippingMethod, $polcodeShippingId, $polcodeShippingDate )
    {
        
        $cart = Mage::getModel('checkout/cart')->getQuote();
        $cart->getShippingAddress()->setPolcodeShippingId($polcodeShippingId);
        $cart->getShippingAddress()->setPolcodeDeliveryDate($polcodeShippingDate);
        $cart->collectTotals();
        
        $cart->getShippingAddress()
             ->setCollectShippingRates(true)
             ->setShippingMethod($shippingMethod)
             ->setPolcodeShippingId($polcodeShippingId)
             ->setPolcodeDeliveryDate($polcodeShippingDate);
        
        if (!isset($result['error'])) {
            $result['goto_section'] = 'shipping_method';
            $result['update_section'] = array(
                'name' => 'shipping-method',
                'html' => $this->_getShippingMethodsHtml()
            );
        }
        
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }
    
}
