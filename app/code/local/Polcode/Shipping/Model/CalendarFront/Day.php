<?php

/**
 * Front Calendar Day
 * @author rmroz
 */
class Polcode_Shipping_Model_CalendarFront_Day {
    
    /**
     * Day date
     * @var string 
     */
    private $date = null;
    
    /**
     * Weekday name
     * @var string 
     */
    private $weekdayName = null;
    
    /**
     * Day of month
     * @var type 
     */
    private $dayOfMonth = null;
    
    /**
     * Month representation
     * @var type 
     */
    private $monthRepresentation = null;
    
    
    /**
     * Configured intervals
     * @var type 
     */
    private $intervals;
    
    
    /**
     * 
     * @param string $date
     */
    public function __construct( $date ) {
        
        $this->date = $date;
        $this->weekdayName = date('l', strtotime( $this->date ));
        $this->dayOfMonth = date('j', strtotime( $this->date ));
        $this->monthRepresentation = date('M', strtotime( $this->date ));
    }
    
    
    /**
     * Returns month representation
     * @return type
     */
    public function getMonthRepresentation() {
        return $this->monthRepresentation;
    }

        
    /**
     * Returns day of month
     * @return type
     */
    public function getDayOfMonth() {
        return $this->dayOfMonth;
    }

        
    /**
     * Returns day date
     * @return string
     */
    public function getDate() {
        return $this->date;
    }

    
    /**
     * Returns date weekday name
     * @return string
     */
    public function getWeekdayName() {
        return $this->weekdayName;
    }

    /**
     * Returns intervals
     * @return type
     */
    public function getIntervals() {
        return $this->intervals;
    }

    
    /**
     * Add interval
     * @param Polcode_Shipping_Model_Shipping $interval
     */
    public function addInterval(Polcode_Shipping_Model_Shipping $interval) 
    {
        $this->intervals[] = $interval;
    }
    
    
}
