<?php

/**
 * Description of Data
 *
 * @author rmroz
 */
class Polcode_Shipping_Helper_Data extends Mage_Core_Helper_Abstract
{
    
    public function weekdays() {
        
        $timestamp = strtotime('next Sunday');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[$i] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }
        return $days;
    }
    
    public function hours() {
        $arr = [];
        for($i = 1; $i <= 24; $i++) {
            $arr[$i.':00'] = $i.':00';
        }
        return $arr;
    }
    
}
