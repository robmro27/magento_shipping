<?php

include 'app/Mage.php';
Mage::app();

$nextWeekdays = Mage::helper('polcodeshipping')->nextWeekDates();

$ordersCollection = Mage::getModel('sales/order')
        ->getCollection()
        ->addFieldToFilter('mainpolcode_delivery_date', array('from' => reset($nextWeekdays),'date' => true,))
        ->addFieldToFilter('polcode_delivery_date', array('to' => end($nextWeekdays), 'date' => true,))
        ->addFieldToFilter('polcode_shipping_id', array('notnull' => true))
        ;


echo '<pre>';
print_r($ordersCollection
            ->getSelect()
            ->columns('count(*) as qty')
            ->group('polcode_shipping_id'));
echo '</pre>';

foreach ($ordersCollection as $result) {
    
    
    
}

die;

foreach ($ordersCollection as $collection) {
    echo '<pre>';
    print_r($collection->getData());
    echo '</pre>';
}

echo '<pre>';
print_r($nextWeekdays);
echo '</pre>';
die;

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

