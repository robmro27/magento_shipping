<?php

include 'app/Mage.php';
Mage::app();

$polcodeShipping = Mage::getModel('polcodeshipping/shipping');
$shippingIntervals = array();
foreach ( $polcodeShipping->getCollection() as $shippingSettings ) {
    $shippingIntervals[$shippingSettings->getData()['weekday']][] = $shippingSettings->getData();
}

$methods = array();

$weekdays = Mage::helper('polcodeshipping')->nextWeekDates();

foreach ($weekdays as $key => $val) {
    
    $weekDayKey = date('w', strtotime($val));
    if (array_key_exists($weekDayKey , $shippingIntervals)) {
        foreach ( $shippingIntervals[$weekDayKey] as $interval ) {
            $interval['date'] = $val;
            $methods[] = $interval;
        }
    } else {
        $methods[] = $val;
    }
    
    
    //$weekdays[date('w', strtotime($val))] = $val; 
    
    
}



echo '<pre>';
print_r($shippingIntervals);
echo '</pre>';

echo '<pre>';
print_r($methods);
echo '</pre>';

die;

