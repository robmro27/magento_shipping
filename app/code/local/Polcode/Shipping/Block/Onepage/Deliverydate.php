<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Deliverydate
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Onepage_Deliverydate extends Mage_Checkout_Block_Onepage_Abstract
{
    public function __construct()
    {
        $this->setTemplate('polcodeshipping/checkout/onepage/shipping_method/deliverydate.phtml');     
    }
 
    public function getPostUrl()
    {
        return Mage::getUrl('deliverytime/index/ajax', array('_secure'=>true)); 
    }
}
