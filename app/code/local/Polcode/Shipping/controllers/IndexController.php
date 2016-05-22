<?php

class Polcode_Shipping_IndexController extends Mage_Core_Controller_Front_Action
{
    public function DeliverydateAction()
    {
        $price = $this->getRequest()->getPost('price');
 
        $cart = Mage::getModel('checkout/cart')->getQuote();
        $cart->setDeliveryPrice($price);
        
        if (!isset($result['error'])) {
            $result['reload'] = 'shipping_method';
            $result['update_section'] = array(
                'name' => 'shipping-method',
                'html' => $this->_getShippingMethodsHtml()
            );
        }
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }
    
}