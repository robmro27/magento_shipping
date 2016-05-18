<?php

class Polcode_Shipping_Model_Carrier_Method_Budget extends Polcode_Shipping_Model_Carrier_Method_Abstract
{
    public function getCost()
    {
        return 1.00;
    }
 
    public function getPrice()
    {
        return 3.00;
    }
}