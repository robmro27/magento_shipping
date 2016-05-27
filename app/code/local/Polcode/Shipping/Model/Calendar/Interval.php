<?php

/**
 * Calendar Day Interval
 * @author rmroz
 */
class Polcode_Shipping_Model_Calendar_Interval {
    
    
    /**
     * Interval start time
     * @var type 
     */
    private $hourStart = null;
    
    /**
     * Interval stop time
     * @var type 
     */
    private $hourEnd = null;
    
    /**
     * 
     * @param int $hourFrom
     * @param int $hourTo
     */
    public function __construct( $hourStart, $hourEnd ) {
        
        $this->hourStart = $hourStart;
        $this->hourEnd = $hourEnd;
        
    }
    
    /**
     * Orders 
     * @var Polcode_Shipping_Model_Calendar_Order 
     */
    private $orders = null;
    
    /**
     * Add order
     * @param Polcode_Shipping_Model_Calendar_Order $order
     */
    public function addOrder( Polcode_Shipping_Model_Calendar_Order $order ) {
        
        $this->orders[] = $order;
        
    }
    
    /**
     * Returns hour start
     * @return int
     */
    public function getHourStart() {
        return $this->hourStart;
    }

    /**
     * Returns hour end
     * @return int
     */
    public function getHourEnd() {
        return $this->hourEnd;
    }

    /**
     * Returns orders
     * @return Polcode_Shipping_Model_Calendar_Order[]
     */
    public function getOrders() {
        return $this->orders;
    }


    
}
