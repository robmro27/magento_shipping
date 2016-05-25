<?php

/**
 * Description of Grid
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Adminhtml_ShippingExcludes_Grid 
    extends Mage_Adminhtml_Block_Widget_Grid {
    
    
    public function __construct()
    {
        parent::__construct();
         
        $this->setId('polcodeshipping_shipping_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
     
    protected function _getCollectionClass()
    {
        return 'polcodeshipping/shippingexcludes_collection';
    }
     
    protected function _prepareCollection()
    {
        
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
         
        return parent::_prepareCollection();
    }
     
    protected function _prepareColumns()
    {
        
        $storeId = (int) $this->getRequest()->getParam('store', 0);
        $store = Mage::app()->getStore($storeId); 
        
        // Add the columns that should appear in the grid
        $this->addColumn('id',
            array(
                'header'=> $this->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'id'
            )
        );
         
        $this->addColumn('date',
            array(
                'header'=> $this->__('Date'),
                'index' => 'date',
                'type'  => 'date',
            )
        );
        
        $this->addColumn('hour_start',
            array(
                'header'=> $this->__('Hour Start'),
                'index' => 'hour_start',
                'type'  => 'options',
                'options' => Mage::helper('polcodeshipping')->hours(),
            )
        );
        
        $this->addColumn('hour_end',
            array(
                'header'=> $this->__('Hour End'),
                'index' => 'hour_end',
                'type'  => 'options',
                'options' => Mage::helper('polcodeshipping')->hours(),
            )
        );
         
        return parent::_prepareColumns();
    }
     
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
    
    
}
