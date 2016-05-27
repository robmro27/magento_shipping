<?php

/**
 * Front calendar
 * @author rmroz
 */
class Polcode_Shipping_Model_CalendarFront_Calendar {
    
    
    /**
     * Intervals
     * @var type 
     */
    private $intervals;
    
    
    /**
     * Qty of orders placed for next week intervals
     * @var array
     */
    private $ordersCountForNextWeekIntervals = null;
    
    
    /**
     * Storage of excludes
     * @var array
     */
    private $excludesCollection = null;
    
    
    /**
     *
     * @var Polcode_Shipping_Model_CalendarFront_Day[] 
     */
    private $days = null;
    
    
    
    /**
     * Fills calendar with dates
     */
    public function __construct() {
        
        $dates = Mage::helper('polcodeshipping')->nextWeekDates();
        
        foreach ( $dates as $date ) {
            $day = new Polcode_Shipping_Model_CalendarFront_Day($date);
            foreach ( $this->getIntervals() as $interval ) {
                if ( $interval['weekday'] == date('w', strtotime($day->getDate())) ) {
                    $day->addInterval($interval);
                }
            }
            $this->days[] = $day;
        }
        
    }
    
    
    /**
     * Returns intervals grouped by weekday
     * @return type
     */
    public function getIntervals() {
        
        if ( $this->intervals == null ) {
            $shippingIntervals = Mage::getModel('polcodeshipping/shipping');
            foreach ($shippingIntervals->getCollection()->getData() as $interval) {
               
                if ( !$this->isLimitReached($interval) && 
                     !$this->isIntervalExcluded($interval) ) {
                    $this->intervals[] = $interval;   
                }           
            }
        }
        
        return $this->intervals;
    }
    
    
    /**
     * Check if orders limit is reached
     * @param array $interval
     * @return boolean
     */
    private function isLimitReached( array $interval ) 
    {
        if ( $this->getOrdersCountForNextWeekInterval($interval['id']) < $interval['order_limit'] ) {
            return false;
        }
        return true;
    }
    
    
    
    /**
     * Returns orders count grouped by shipping interval
     * needed for check if limit was reached
     * @return type
     */
    private function getOrdersCountForNextWeekIntervals() 
    {
        if ( $this->ordersCountForNextWeekIntervals == null ) {
        
            $nextWeekDates = Mage::helper('polcodeshipping')->nextWeekDates();
            
            $ordersCountForNextWeekIntervals =
                Mage::getModel('sales/order')
                    ->getCollection()
                    ->addFieldToFilter('polcode_delivery_date', array('from' => reset($nextWeekDates),'date' => true,))
                    ->addFieldToFilter('polcode_delivery_date', array('to' => end($nextWeekDates), 'date' => true,))
                    ->addFieldToFilter('polcode_shipping_id', array('notnull' => true));
            
            $ordersCountForNextWeekIntervals
                    ->getSelect()
                    ->reset(Zend_Db_Select::COLUMNS)
                    ->columns('`main_table`.polcode_delivery_date,
                               `main_table`.polcode_shipping_id,
                                count(*) as qty')
                    ->group('polcode_shipping_id');
            
            $this->ordersCountForNextWeekIntervals =  $ordersCountForNextWeekIntervals;  
        }
            
        return  $this->ordersCountForNextWeekIntervals;   
    }
    
    
    /**
     * Returns orders placed for next week interval by interval id
     * @param int $intervalId
     * @return int
     */
    private function getOrdersCountForNextWeekInterval( $intervalId ) 
    {
        foreach ( $this->getOrdersCountForNextWeekIntervals() as $interval ) {
            
            if ( $interval['polcode_shipping_id'] == $intervalId ) {
                return $interval['qty'];
            }
            
        }
    }
    
    
    /**
     * Check if interval is excluded
     * @param array $interval
     * @return boolean
     */
    public function isIntervalExcluded( array $interval ) 
    {
        
        $date = Mage::helper('polcodeshipping')->getDateForNextWeekDay($interval['weekday']);
        $excludes = $this->getExcludesCollectionByDate($date);
            
        $intervalDateFrom = new \DateTime($date. ' ' . $interval['hour_start']);
        $intervalDateTo = new \DateTime($date. ' ' . $interval['hour_end']);
            
        foreach ( $excludes as $exclude ) {
            
            $excludeDateFrom = new \DateTime($exclude['date']. ' '. $exclude['hour_start']);
            $excludeDateTo = new \DateTime($exclude['date']. ' ' .$exclude['hour_end']);
            
            if ( 
                    ( $excludeDateFrom >= $intervalDateFrom &&
                      $excludeDateFrom <= $intervalDateTo ) ||
                    ( $excludeDateTo >= $intervalDateFrom &&
                      $excludeDateTo <= $intervalDateTo )
               ) 
            {
                return true;
            }
           
        }
        
        return false;
        
    }
    

    /**
     * Return array of excludes
     * @return type
     */
    public function getExcludesCollection() {
        
        if ($this->excludesCollection == null) {
            $excludeModel = Mage::getModel('polcodeshipping/shippingexcludes')->getCollection();
            foreach ( $excludeModel as $exclude ) {
                 $this->excludesCollection[] = $exclude->getData();
            }
        }
        
        return $this->excludesCollection;
        
    }
    
    /**
     * Return array of excludes by date
     * @param type $date
     * @return type
     */
    public function getExcludesCollectionByDate( $date ) {
    
        $arr = [];
        foreach ( $this->getExcludesCollection() as $exclude ) {
            if ( $exclude['date'] == $date ) {
                $arr[] = $exclude;
            }
        }
        return $arr;
        
    }
    
    
    /**
     * Returns days for calendar
     * @return type
     */
    public function getDays() {
        
        return $this->days;
        
    }


    
}
