<?php

class Polcode_Shipping_Model_Observer
{
    
    /**
     * Save Shipping Method
     * @param type $observer
     */
    public function saveDeliveryDatetime($observer)
    {
        $postData = $observer->getRequest()->getPost();
 
        // save shipping interval id
        if(isset($postData['polcode_shipping_id']))
        {
            $shippingId = (empty($postData['polcode_shipping_id']['interval'])) ? NULL : $postData['polcode_shipping_id']['interval'];
            $observer->getQuote()->getShippingAddress()->setPolcodeShipppingId($shippingId); 
        }
        
        // save delivery date
        if(isset($postData['polcode_delivery_date']))
        {
            $deliveryDate = (empty($postData['polcode_delivery_date'])) ? NULL : $postData['polcode_delivery_date'];
            $observer->getQuote()->getShippingAddress()->setPolcodeDeliveryDate($deliveryDate); 
        }
    }
    
    /**
     * Copy to quote from order
     * @param type $observer
     */
    public function copyPolcodeShippingIdQuote($observer)
    {
        $observer->getQuote()->getShippingAddress()->setPolcodeShippingId($observer->getOrder()->getPolcodeShippingId());
        $observer->getQuote()->getShippingAddress()->setPolcodeDeliveryDate($observer->getOrder()->getPolcodeDeliveryDate());
    }
    
} 