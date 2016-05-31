<?php

/* @var $installer Mage_Sales_Model_Entity_Setup */
$installer = $this;
$installer->startSetup();


$installer->getConnection()->addConstraint(
     $installer->getFkName('sales/quote_address', 'polcode_shipping_id', 'polcodeshipping/shipping','id'),
     $installer->getTable('sales/quote_address'), 
     'polcode_shipping_id',
     $installer->getTable('polcodeshipping/shipping'),
     'id',
     Varien_Db_Ddl_Table::ACTION_NO_ACTION, 
     Varien_Db_Ddl_Table::ACTION_NO_ACTION
);

$installer->getConnection()->addConstraint(
     $installer->getFkName('sales/order', 'polcode_shipping_id', 'polcodeshipping/shipping','id'),
     $installer->getTable('sales/order'), 
     'polcode_shipping_id',
     $installer->getTable('polcodeshipping/shipping'),
     'id',
     Varien_Db_Ddl_Table::ACTION_NO_ACTION, 
     Varien_Db_Ddl_Table::ACTION_NO_ACTION
);  
$installer->endSetup();
