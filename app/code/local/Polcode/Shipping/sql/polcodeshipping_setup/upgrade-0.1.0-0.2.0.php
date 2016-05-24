<?php

/* @var $installer Mage_Sales_Model_Entity_Setup */
$installer = $this;
 
$installer->startSetup();
 
$installer->getConnection()
    ->addColumn($installer->getTable('sales/quote_address'), 'polcode_shipping_id', array(
        'TYPE'      => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'NULLABLE'  => true,
        'COMMENT'   => 'Shipment Delivery Date Time'
    ));



$installer->getConnection()
    ->addColumn($installer->getTable('sales/order'), 'polcode_shipping_id', array(
        'TYPE'      => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'NULLABLE'  => true,
        'COMMENT'   => 'Shipment Delivery Date Time'
    ));




 
$installer->endSetup();

