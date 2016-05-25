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
                if ( $this->getOrdersCountForNextWeekInterval($interval['id']) < $interval['order_limit'] ) {
                    $this->intervalsByDays[$interval['weekday']][] = $interval;
                }
            }
        }
        return $this->intervalsByDays;;
    }
    
    
    
    
    
    /**
     * Returns orders count grouped by shipping interval
     * needed for check if limit was reached
     * @return type
     */
    public function getOrdersCountForNextWeekIntervals() 
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
    public function getOrdersCountForNextWeekInterval( $intervalId ) 
    {
        foreach ( $this->getOrdersCountForNextWeekIntervals() as $interval ) {
            
            if ( $interval['polcode_shipping_id'] == $intervalId ) {
                return $interval['qty'];
            }
            
        }
    }
    
}
