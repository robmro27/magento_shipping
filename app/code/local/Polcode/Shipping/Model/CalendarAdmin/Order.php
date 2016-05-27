<?php

/**
 * Calendar Day Interval Order
 * @author rmroz
 */
class Polcode_Shipping_Model_CalendarAdmin_Order {
    
    /**
     * Url to  order view
     * @var string 
     */
    private $url;
    
    /**
     * Increment id
     * @var string 
     */
    private $incrementId;
    
    /**
     * 
     * @param int $entityId
     * @param string $incrementId
     */
    public function __construct( $entityId, $incrementId ) {
        
        $this->url = Mage::helper('adminhtml')->getUrl("adminhtml/sales_order/view", array('order_id'=> $entityId));
        
        $this->incrementId = $incrementId;
        
    }
    
    /**
     * Returns url to view order
     * @return type
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Returns display number for order
     * @return type
     */
    public function getIncrementId() {
        return $this->incrementId;
    }


    
}
