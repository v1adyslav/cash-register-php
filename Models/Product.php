<?php

class Product
{
    public $code, $name, $price, $currency, $discount_type;

    function __construct($code, $name, $price, $currency, $discount) {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
        $this->currency = $currency;
        $this->discount_type = $discount;
    }
}
