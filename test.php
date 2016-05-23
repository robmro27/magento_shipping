<?php

include 'app/Mage.php';
Mage::app();

$shippingIntervals = Mage::getModel('polcodeshipping/shipping');


$indexedByDay = [];
foreach ($shippingIntervals->getCollection()->getData() as $interval) 
{
    $indexedByDay[$interval['weekday']][] = $interval;
}



echo '<pre>';
print_r($indexedByDay);
echo '</pre>';
die;

