<?php

include 'app/Mage.php';
Mage::app();

echo '<pre>';
print_r($_SERVER['REMOTE_ADDR']);
echo '</pre>';
die;

$configValue = Mage::getStoreConfig('sales/shippingsettings/country');

echo '<pre>';
print_r($configValue);
echo '</pre>';
die;


$block = Mage::app()->getLayout()->createBlock('polcodeshipping/onepage_deliverydate');

echo '<pre>';
print_r($block->getCalendar()->getDays());
echo '</pre>';
die;

foreach ( $block->test() as $test ) {
    
    echo '<pre>';
    print_r($test->getData());
    echo '</pre>';
    
    
}  
die;

$helper = Mage::helper('polcodeshipping');

echo '<pre>';
print_r($helper->getDateForNextWeekDay(1));
echo '</pre>';
die;


$nextWeekdays = Mage::helper('polcodeshipping')->nextWeekDates();

$ordersCollection = Mage::getModel('sales/order')
        ->getCollection()
        ->addFieldToFilter('polcode_delivery_date', array('from' => reset($nextWeekdays),'date' => true,))
        ->addFieldToFilter('polcode_delivery_date', array('to' => end($nextWeekdays), 'date' => true,))
        ->addFieldToFilter('polcode_shipping_id', array('notnull' => true));

$ordersCollection
        ->getSelect()
        ->reset(Zend_Db_Select::COLUMNS)
        ->columns('`main_table`.polcode_delivery_date,
                   `main_table`.polcode_shipping_id,
                   count(*) as qty')
        ->group('polcode_shipping_id');


foreach ($ordersCollection as $result) {
    
    echo '<pre>';
    print_r($result->getData());
    echo '</pre>';
    
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

