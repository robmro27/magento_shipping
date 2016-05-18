<?php
 
class Polcode_Shipping_Model_Carrier_Method_Express extends 
Polcode_Shipping_Model_Carrier_Method_Abstract 
{
    public function getCost()
    {
        return 5.00;
    }
 
    public function getPrice()
    {
        return 10.00;
    }
}