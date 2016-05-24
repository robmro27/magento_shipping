<?php

include 'app/Mage.php';
Mage::app();




// set default 
    $shippingModel = Mage::getModel('polcodeshipping/shipping');

        $datetime = new DateTime();
        $datetime->modify('+1 day');
        $tomorrow =  $datetime->format('N');
        $default =
            $shippingModel->getCollection()
                      ->addFieldToFilter('weekday', $tomorrow)
                      ->getFirstItem();
    
echo '<pre>';
print_r($default);
echo '</pre>';
die;        
        
die;        
        

$shippingIntervals = Mage::getModel('polcodeshipping/shipping');
foreach ($shippingIntervals->getCollection()->getData() as $interval) {
    $interval['weekdayName'] = Mage::helper('polcodeshipping')->weekdays()[$interval['weekday']];
    $interval['date'] = date('Y-m-d', strtotime("next " . $interval['weekdayName']));
    $intervalsByDays[$interval['weekday']][] = $interval;
}

echo '<pre>';
print_r($intervalsByDays);
echo '</pre>';
die;

die;

