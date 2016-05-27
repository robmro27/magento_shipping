<?php

/**
 * Calendar day
 * @author rmroz
 */
class Polcode_Shipping_Model_CalendarAdmin_Day {
    
    /**
     * Date of day
     * @var type 
     */
    private $date;
    
    /**
     * Weekday name 
     * @var type 
     */
    private $weekday;
    
    
    /**
     * Time Intervals
     * @var type 
     */
    private $intervals;
    
    
    /**
     * Fills intervals
     * @param \DateTime $date
     */
    public function __construct(\DateTime $date ) {
        
        $this->date = $date;
        
        $this->weekday = date('l', strtotime($this->date->format('Y-m-d')));
        
        // get intervals with orders for this date
        $ordersIntervals =
                Mage::getModel('sales/order')
                    ->getCollection()
                    ->addFieldToFilter('polcode_delivery_date', array('eq' => $this->date->format('Y-m-d'),'date' => true,))
                    ->addFieldToFilter('polcode_shipping_id', array('notnull' => true));
        
        $ordersIntervals
                ->getSelect()
                ->reset(Zend_Db_Select::COLUMNS)
                ->columns(['main_table.polcode_delivery_date',
                           'main_table.polcode_shipping_id',
                           'main_table.entity_id',
                           'main_table.increment_id',])
                ->join(array('ps' => 'polcode_shipping'), 'main_table.polcode_shipping_id = ps.id', array('hour_start','hour_end','weekday'));
        
        
        // add interval if no exist and fill it with order
        foreach ( $ordersIntervals as $data ) {
            
            $interval = $this->addInterval($data);
            
            $order = new Polcode_Shipping_Model_CalendarAdmin_Order( $data['entity_id'], $data['increment_id'] );
            $interval->addOrder($order);
            
        }
        
    }
    
    /**
     * Add interval or return existing one
     * @param array $data
     * @return Polcode_Shipping_Model_Calendar_Interval
     */
    private function addInterval( $data ) 
    {
        
        if ( !isset( $this->intervals[$data['polcode_shipping_id']] ) ) {
            $this->intervals[$data['polcode_shipping_id']] = new Polcode_Shipping_Model_CalendarAdmin_Interval( $data['hour_start'], $data['hour_end'] );
        }
        
        return $this->intervals[$data['polcode_shipping_id']];
        
        
    }
    
    /**
     * Returns date
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Returns weekdayname
     * @return string
     */
    public function getWeekday() {
        return $this->weekday;
    }

    /**
     * Returns Intervals
     * @return Polcode_Shipping_Model_Calendar_Interval[]
     */
    public function getIntervals() {
        return $this->intervals;
    }

    
}
