<?php

/* @var $installer Mage_Sales_Model_Entity_Setup */
$installer = $this;
 
$installer->startSetup();
 
$installer->getConnection()
    ->addColumn($installer->getTable('sales/quote_address'), 'polcode_delivery_date', array(
        'TYPE'      => Varien_Db_Ddl_Table::TYPE_DATE,
        'NULLABLE'  => true,
        'COMMENT'   => 'Shipment Desired Delivery Date'
    ));
 
$installer->getConnection()
    ->addColumn($installer->getTable('sales/order'), 'polcode_delivery_date', array(
        'TYPE'      => Varien_Db_Ddl_Table::TYPE_DATE,
        'NULLABLE'  => true,
        'COMMENT'   => 'Shipment Desired Delivery Date'
    ));
 
$installer->getConnection()
    ->addColumn($installer->getTable('sales/order_grid'), 'polcode_delivery_date', array(
        'TYPE'      => Varien_Db_Ddl_Table::TYPE_DATE,
        'NULLABLE'  => true,
        'COMMENT'   => 'Shipment Desired Delivery Date'
    ));
 
$installer->getConnection()
    ->addKey($installer->getTable('sales/order_grid'), 'polcode_delivery_date_idx', 'polcode_delivery_date'
    );
 
$installer->endSetup();

