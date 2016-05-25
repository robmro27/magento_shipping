<?php

/**
 * Description of Shipping
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Adminhtml_ShippingReport extends Mage_Adminhtml_Block_Template {
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('polcode/shipping/week_report.phtml');     
    }
    
    protected function _prepareLayout() {
        
//        $collection = Mage::getModel('sales/order')->getCollection();
//        $collection->getSelect()->join( array('order_item'=> sales_flat_order_item), 'order_item.order_id = main_table.entity_id', array('order_item.sku'));
        
//        Mage::app()->getResponse()->setRedirect(Mage::helper('adminhtml')->getUrl("adminhtml/sales_order/view", array('order_id'=>'1')));
        
    }
    
}
