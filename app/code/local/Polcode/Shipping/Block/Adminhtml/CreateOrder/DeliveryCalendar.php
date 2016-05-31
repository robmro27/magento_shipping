<?php

/**
 * Description of DeliveryCalendar
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Adminhtml_CreateOrder_DeliveryCalendar 
    extends Mage_Adminhtml_Block_Sales_Order_Create_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('sales_order_create_delivery_calendar_form');
    }
    
    
    
    
    
}
