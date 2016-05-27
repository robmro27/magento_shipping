<?php

/**
 * Calendar display in admin panel
 * @author rmroz
 */
class Polcode_Shipping_Model_Calendar_Calendar {
    
    /**
     * Date from for calendar
     * @var type 
     */
    private $dateFrom = null;
    
    /**
     * Date to for calendar
     * @var type 
     */
    private $dateTo = null;
    
    
    /**
     * Days 
     * @var Polcode_Shipping_Model_Calendar_Day 
     */
    private $days = null;
    

    /**
     * Generates full week days
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     */
    public function __construct( \DateTime $dateFrom, \DateTime $dateTo ) {
        
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        
        $date = clone $this->dateFrom; 
        
        do {
            
            $day = new Polcode_Shipping_Model_Calendar_Day( $date );
            
            $this->addDay($day);
            
            $date =  new \DateTime($date->modify('+1 day')->format('Y-m-d'));
            
            
        } while ( $date < $this->dateTo );
        
    }
    
    
    /**
     * 
     * @return \DateTime
     */
    public function getDateFrom() {
        return $this->dateFrom;
    }

    /**
     * 
     * @return \DateTime
     */
    public function getDateTo() {
        return $this->dateTo;
    }

    /**
     * 
     * @param \DateTime $dateFrom
     */
    public function setDateFrom($dateFrom) {
        $this->dateFrom = $dateFrom;
    }

    /**
     * 
     * @param \DateTime $dateTo
     */
    public function setDateTo($dateTo) {
        $this->dateTo = $dateTo;
    }

    
    /**
     * Add one day
     * @param Polcode_Shipping_Model_Calendar_Day $day
     */
    public function addDay( Polcode_Shipping_Model_Calendar_Day $day ) {
        
        $this->days[] = $day;
        
    }
    
    /**
     * Return days
     * @return Polcode_Shipping_Model_Calendar_Day[]
     */
    public function getDays() {
        return $this->days;
    }


    
    
}
