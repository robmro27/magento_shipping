<?php

/**
 * Description of Form
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Adminhtml_Shipping_Edit_Form 
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {  
        parent::__construct();
     
        $this->setId('polcodeshipping_shipping_form');
        $this->setTitle($this->__('Shipping Information'));
    }  
     
    /**
     * Setup form fields for inserts/updates
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {  
        $model = Mage::registry('polcodeshipping');
     
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post'
        ));
     
        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('polcodeshipping')->__('Polcode Shipping Information'),
            'class'     => 'fieldset-wide',
        ));
     
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }  
     
        $fieldset->addField('weekday', 'select', array(
            'label'     => Mage::helper('polcodeshipping')->__('Week day'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'weekday',
            'value'  => '1',
            'values' => Mage::helper('polcodeshipping')->weekdays(),
            'disabled' => false,
            'readonly' => false,
            'tabindex' => 1
        ));
        
        $fieldset->addField('hour_start', 'select', array(
          'label'     => Mage::helper('polcodeshipping')->__('Hour Start'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'hour_start',
          'values' => Mage::helper('polcodeshipping')->hours(),
          'disabled' => false,
          'readonly' => false,
          'tabindex' => 2
        ));
        
        $fieldset->addField('hour_end', 'select', array(
            'label'     => Mage::helper('polcodeshipping')->__('Hour To'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'hour_end',
            'values' => Mage::helper('polcodeshipping')->hours(),
            'disabled' => false,
            'readonly' => false,
            'tabindex' => 3
        ));
        
        $fieldset->addField('order_limit', 'text', array(
            'name'      => 'order_limit',
            'label'     => Mage::helper('polcodeshipping')->__('Order Limit'),
            'title'     => Mage::helper('polcodeshipping')->__('Order Limit'),
            'required'  => true,
            'style'   => "width:20% !important",
            'tabindex' => 4
        ));
        
        $fieldset->addField('cost', 'text', array(
            'name'      => 'cost',
            'label'     => Mage::helper('polcodeshipping')->__('Cost'),
            'title'     => Mage::helper('polcodeshipping')->__('Cost'),
            'required'  => true,
            'style'   => "width:20% !important",
            'tabindex' => 5
        ));
        
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
     
        return parent::_prepareForm();
    }  
    
   
    
    
    
}
