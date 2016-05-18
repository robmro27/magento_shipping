<?php

abstract class Polcode_Shipping_Model_Carrier_Method_Abstract 
{   
    abstract public function getCost();
    abstract public function getPrice();
} 
