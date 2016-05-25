<?php

/**
 * Description of Form
 *
 * @author rmroz
 */
class Polcode_Shipping_Block_Adminhtml_ShippingExcludes_Edit_Form 
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {  
        parent::__construct();
     
        $this->setId('polcodeshipping_shippingexcludes_form');
        $this->setTitle($this->__('Shipping Exclude Information'));
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
            'legend'    => Mage::helper('polcodeshipping')->__('Polcode Shipping Exclude Information'),
            'class'     => 'fieldset-wide',
        ));
     
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }  
     
        $fieldset->addField('date', 'date', array(
            'label'  => Mage::helper('polcodeshipping')->__('Date'),
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT), 
            'class'  => 'required-entry',
            'required' => true,
            'name' =>   'date',
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            //'time' =>   'true',
            'disabled' => false,
            'readonly' => false,
            'tabindex' => 1,
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
        
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
     
        return parent::_prepareForm();
    }  
    
   
    
    
    
}
