<?php

/**
 * Description of Deliverydate
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Onepage_Deliverydate extends Mage_Checkout_Block_Onepage_Abstract
{
    
    
    /**
     * Next week dates
     * @var type 
     */
    private $nextWeekDates;
    
    /**
     * Grouped intervals by weekday
     * @var type 
     */
    private $intervalsByDays;
    
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
    
    
    protected function _prepareLayout() 
    {
        $this->getNextWeekDays();
        $this->getIntervalsByDays();
    }
    
    public function __construct()
    {
        $this->setTemplate('polcode/shipping/checkout/onepage/shipping_method/deliverydate.phtml');     
    }
 
    public function getPostUrl()
    {
        return Mage::getUrl('checkout/onepage/deliverydate', array('_secure'=>true)); 
    }

    /**
     * Returns next week dates
     * @return array
     */
    public function getNextWeekDates() {
        
        if ($this->nextWeekDates == null) {
            $this->nextWeekDates = Mage::helper('polcodeshipping')->nextWeekDates();
        }
        return $this->nextWeekDates;
        
    }
    
    
    /**
     * Returns intervals grouped by weekday
     * @return type
     */
    public function getIntervalsByDays() {
        
        if ( $this->intervalsByDays == null ) {
            $shippingIntervals = Mage::getModel('polcodeshipping/shipping');
            foreach ($shippingIntervals->getCollection()->getData() as $interval) {
               
                if ( !$this->isLimitReached($interval) && 
                     !$this->isIntervalExcluded($interval) ) {
                    $this->intervalsByDays[$interval['weekday']][] = $interval;   
                }           
            }
        }
        return $this->intervalsByDays;;
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
        
            $nextWeekDates = $this->getNextWeekDates();
            
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
    
}
