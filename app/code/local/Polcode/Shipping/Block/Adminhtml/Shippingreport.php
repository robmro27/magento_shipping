<?php

/**
 * Display week calendar with shipping orders by hours intervals
 * @author rmroz
 */
class Polcode_Shipping_Block_Adminhtml_Shippingreport extends Mage_Adminhtml_Block_Template {
    
    
    /**
     *
     * @var Polcode_Shipping_Model_Calendar_Calendar 
     */
    private $calendar = null;
    
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('polcode/shipping/week_report.phtml');     
    }
    
    protected function _prepareLayout() {
        
        list($startDate, $endDate) = $this->getDatesForReport();
        
        $this->calendar = new Polcode_Shipping_Model_CalendarAdmin_Calendar($startDate, $endDate);
        
    }
    
    /**
     * Returns calendar
     * @return Polcode_Shipping_Model_Calendar_Calendar
     */
    public function getCalendar() {
        return $this->calendar;
    }

    
    /**
     * Returns start and end date for calendar
     * @return array
     */
    private function getDatesForReport() 
    {
        $startDate = $this->getStartDate();
        $endDate = date('Y-m-d', strtotime('+7 day', strtotime($startDate)));
        return array( new \DateTime( $startDate ), new \DateTime( $endDate ) );
        
    }
    
    /**
     * Returns next week url
     * @return string
     */
    public function nextWeekUrl() 
    {
        $startDate = $this->getStartDate();
        $date = date('Y-m-d', strtotime('+7 day', strtotime($startDate)));
        return $this->getNavUrl($date);
    }
    
    /**
     * Returns prev week url
     * @return type
     */
    public function prevWeekUrl()
    {
        $startDate = $this->getStartDate();
        $date = date('Y-m-d', strtotime('-7 day', strtotime($startDate)));
        
        return $this->getNavUrl($date);
    }
    
    /**
     * Returns near week url
     * @return type
     */
    public function nearWeekUrl()
    {
        $startDate = $this->getStartDate();
        $nextWeekDates = Mage::helper('polcodeshipping')->nextWeekDates();
        $date = reset($nextWeekDates);
        
        return $this->getNavUrl($date);
    }
    
    /**
     * Returns url with get param
     * @param type $date
     * @return type
     */
    private function getNavUrl( $date )
    {
        $urlParams = array();
        $urlParams['_current']  = true;
        $urlParams['_escape']   = true;
        $urlParams['_use_rewrite']   = true;
        $urlParams['_query']    = ['startDate' => $date];
        return $this->getUrl('*/*/*', $urlParams);
    }
    
    
    /**
     * Return start date for calendar 
     * @return type
     */
    private function getStartDate() {
        
        $startDate = $this->getRequest()->getParam('startDate');
        
        if ( $startDate == null ) { 
            $nextWeekDates = Mage::helper('polcodeshipping')->nextWeekDates();
            $startDate = reset($nextWeekDates);
        } 
        
        return $startDate;
        
    }
    
}
