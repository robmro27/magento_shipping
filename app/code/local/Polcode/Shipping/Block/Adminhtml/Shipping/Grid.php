<?php

/**
 * Description of Grid
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Adminhtml_Shipping_Grid 
    extends Mage_Adminhtml_Block_Widget_Grid {
    
    
    public function __construct()
    {
        parent::__construct();
         
        $this->setDefaultSort('weekday');
        $this->setId('polcodeshipping_shipping_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
     
    protected function _getCollectionClass()
    {
        return 'polcodeshipping/shipping_collection';
    }
     
    protected function _prepareCollection()
    {
        
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $collection->addFieldToFilter('deleted',0); // no deleted flag
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
         
        $this->addColumn('weekday',
            array(
                'header'=> $this->__('Weekday'),
                'index' => 'weekday',
                'renderer' => new Polcode_Shipping_Block_Adminhtml_Renderer_Weekdays(),
                'type'  => 'options',
                'options' => Mage::helper('polcodeshipping')->weekdays(),
            )
        );
        
        $this->addColumn('hour_from',
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
        
        $this->addColumn('order_limit',
            array(
                'header'=> $this->__('Order Limit'),
                'index' => 'order_limit',
                'type'  => 'number'
            )
        );
        
        $this->addColumn('cost',
            array(
                'header'=> $this->__('Cost'),
                'index' => 'cost',
                'type'  => 'price',
                'currency_code' => $store->getBaseCurrency()->getCode(),
            )
        );
         
        return parent::_prepareColumns();
    }
     
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
    
    
}
