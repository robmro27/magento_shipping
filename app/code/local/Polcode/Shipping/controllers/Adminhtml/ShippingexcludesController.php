<?php


/**
 * Description of PolcodeShippingController
 *
 * @author rmroz
 */
class Polcode_Shipping_Adminhtml_ShippingexcludesController 
    extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {  
        $this->_initAction()->renderLayout();
    }  
     
    public function newAction()
    {  
        $this->_forward('edit');
    }  
     
    public function editAction()
    {  
     
        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('polcodeshipping/shippingexcludes');
     
        if ($id) {
            // Load record
            $model->load($id);
     
            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This shipping exclude no longer exists.'));
                $this->_redirect('*/*/');
     
                return;
            }  
        }  
     
        $this->_title($model->getId() ? $model->getName() : $this->__('New Shipping Exclude'));
     
        $data = Mage::getSingleton('adminhtml/session')->getBazData(true);
        if (!empty($data)) {
            $model->setData($data);
        }  
     
        Mage::register('polcodeshipping', $model);
     
        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Shipping Exclude') : $this->__('New Shipping Exclude'), $id ? $this->__('Edit Shipping Exclude') : $this->__('New Shipping Exclude'))
            ->_addContent($this->getLayout()->createBlock('polcodeshipping/adminhtml_shippingexcludes_edit')->setData('action', $this->getUrl('*/*/save')))
            ->renderLayout();
    }
     
    public function saveAction()
    {
        
        /**
         * TODO: validation
         */
        
        if ($postData = $this->getRequest()->getPost()) {
            
            $model = Mage::getSingleton('polcodeshipping/shippingexcludes');
            $model->setData($postData);
            
            try {
                
                // validate hours
                if ( (int)$postData['hour_start'] >= (int)$postData['hour_end']) {
                    Mage::getSingleton('adminhtml/session')->addError($this->__('Hour start should be less than Hour end.'));
                    throw new \Exception('Invalid hours selected');
                }
                
                $model->save();
 
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The shipping exclude has been saved.'));
                $this->_redirect('*/*/');
 
                return;
            }  
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this shipping exclude.'));
            }
 
            Mage::getSingleton('adminhtml/session')->setBazData($postData);
            $this->_redirectReferer();
        }
    }
     
    public function deleteAction()
    {
        if($this->getRequest()->getParam('id') > 0)
        {
          try
          {
              
              $model = Mage::getModel('polcodeshipping/shippingexcludes');
              $model->setId($this->getRequest()->getParam('id'));
              $model->setDeleted(1);
              $model->save();
              Mage::getSingleton('adminhtml/session')->addSuccess('Shipping exclude deleted');
              $this->_redirect('*/*/');
           }
           catch (Exception $e)
           {
                Mage::getSingleton('adminhtml/session')
                     ->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
           }
       }
      $this->_redirect('*/*/');
    }
    
    
    public function messageAction()
    {
        $data = Mage::getModel('polcodeshipping/shippingexcludes')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }
     
    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        $this->loadLayout()
            // Make the active menu match the menu config nodes (without 'children' inbetween)
            ->_setActiveMenu('sales/polcodeshipping_shippingexcludes')
            ->_title($this->__('Sales'))->_title($this->__('Polcode Shipping Excludes'))
            ->_addBreadcrumb($this->__('Sales'), $this->__('Sales'))
            ->_addBreadcrumb($this->__('Polcode Shipping Excludes'), $this->__('Polcode Shipping Excludes'));
         
        return $this;
    }
     
    
    
    /**
     * Check currently called action by permissions for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('sales/polcodeshipping_shippingexcludes');
    }
}
