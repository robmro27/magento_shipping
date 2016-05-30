<?php

/**
 * Helper methods
 */
class Polcode_Shipping_Helper_Data extends Mage_Core_Helper_Abstract
{
    
    /**
     * Returns display version of selected delivery date and interval
     * @param string $shippingDate
     * @param int $shippingId
     * @return string
     */
    public function getDisplaySelectedDeliveryDateTime( $shippingDate , $shippingId )
    {
        $interval = Mage::getModel('polcodeshipping/shipping')->load($shippingId);
        return $shippingDate . ' ' . $interval->getHourStart() . '-' . $interval->getHourEnd();
    }
    
    /**
     * Returns next week days
     * @return array
     */
    public function weekdays() {
        
        $timestamp = strtotime('next Sunday');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[$i] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }
        return $days;
    }
    
    
    /**
     * Returns next week dates
     * @return array
     */
    public function nextWeekDates() {
        
        $timestamp = strtotime('+1 day', time());
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[$i] = date('Y-m-d', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }
        return $days;
        
    }
    
    /**
     * Returns hours for admin 
     * @return array
     */
    public function hours() {
        $arr = [];
        for($i = 1; $i <= 24; $i++) {
            $arr[$i.':00'] = $i.':00';
        }
        return $arr;
    }
    
    /**
     * Returns date of next weekday by weekday name
     * @param int $weekDay
     * @return string
     */
    public function getDateForNextWeekDay( $weekDay )
    {
        $weekdayName = Mage::helper('polcodeshipping')->weekdays()[$weekDay];
        return date('Y-m-d', strtotime("next " . $weekdayName));
    }
    
}
