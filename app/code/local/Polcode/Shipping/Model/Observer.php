<?php

class Polcode_Shipping_Model_Observer
{
    public function saveDeliveryDatetime($observer)
    {
        $postData = $observer->getRequest()->getPost();
 
        
        if(isset($postData['polcode_shipping_id']))
        {
            $shippingId = (empty($postData['polcode_shipping_id']['interval'])) ? NULL : $postData['polcode_shipping_id']['interval'];
            $observer->getQuote()->getShippingAddress()->setPolcodeShipppingId($shippingId); 
        }
    }
    
    
    public function copyPolcodeShippingIdToQuote($observer)
    {
        $observer->getQuote()->getShippingAddress()->setPolcodeShippingId($observer->getOrder()->getPolcodeShippingId());
    }
    
} 