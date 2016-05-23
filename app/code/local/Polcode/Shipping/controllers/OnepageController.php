<?php
require_once 'Mage/Checkout/controllers/OnepageController.php';
class Polcode_Shipping_OnepageController extends Mage_Checkout_OnepageController
{   
    public function deliverydateAction()
    {
        
        $cart = Mage::getModel('checkout/cart')->getQuote();
        $address = $cart->getShippingAddress()->setCollectShippingRates(true);
        
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
