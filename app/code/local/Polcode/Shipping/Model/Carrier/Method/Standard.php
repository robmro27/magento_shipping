<?php
 
class Polcode_Shipping_Model_Carrier_Method_Standard extends Polcode_Shipping_Model_Carrier_Method_Abstract
{
    public function getCost()
    {
        return 3.00;
    }
 
    public function getPrice()
    {
        return 7.00;
    }
}