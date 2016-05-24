<?php
require_once 'Mage/Checkout/controllers/OnepageController.php';
class Polcode_Shipping_OnepageController extends Mage_Checkout_OnepageController
{   
    public function deliverydateAction()
    {
               
        $id = $this->getRequest()->getParams('polcode_shipping_id')['interval'];
        $interval = Mage::getModel('polcodeshipping/shipping')->load($id);
        
        $weekdayName = Mage::helper('polcodeshipping')->weekdays()[$interval['weekday']];
        $date = date('Y-m-d', strtotime("next " . $weekdayName));
        
        $cart = Mage::getModel('checkout/cart')->getQuote();
        $cart->getShippingAddress()
             ->setCollectShippingRates(true)
             ->setShippingMethod('polcodeshipping_standard')
             ->setPolcodeShippingId($id)
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
}
