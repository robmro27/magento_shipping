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
        
        if(isset($postData['polcode_delivery_date']))
        {
            $deliveryDate = (empty($postData['polcode_delivery_date'])) ? NULL : $postData['polcode_delivery_date'];
            $observer->getQuote()->getShippingAddress()->setPolcodeDeliveryDate($deliveryDate); 
        }
    }
    
    
    public function copyPolcodeShippingIdToQuote($observer)
    {
        $observer->getQuote()->getShippingAddress()->setPolcodeShippingId($observer->getOrder()->getPolcodeShippingId());
        $observer->getQuote()->getShippingAddress()->setPolcodeDeliveryDate($observer->getOrder()->getPolcodeDeliveryDate());
    }
    
} 