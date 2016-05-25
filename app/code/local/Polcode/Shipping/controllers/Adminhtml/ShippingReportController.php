<?php

/**
 * Description of PolcodeShippingController
 *
 * @author rmroz
 */
class Polcode_Shipping_Adminhtml_ShippingReportController 
    extends Mage_Adminhtml_Controller_Action
{
    
    /**
     * Index Action
     */
    public function indexAction()
    {  
        $this->_initAction()->renderLayout();
    }  
     
    
    /**
     * @return \Polcode_Shipping_Adminhtml_ShippingReportController
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('sales/polcodeshipping_shipping')
            ->_title($this->__('Sales'))->_title($this->__('Polcode Shipping Next Week Orders'))
            ->_addBreadcrumb($this->__('Sales'), $this->__('Sales'))
            ->_addBreadcrumb($this->__('Polcode Shipping Next Week Orders'), $this->__('Polcode Shipping Next Week Orders'));
         
        return $this;
    }
     
    
    
    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('sales/polcodeshipping_shippingreport');
    }
}
