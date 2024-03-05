<?php

class Product
{
    public string $code;
    public string $name;
    public float $price;
    public string $currency;
    public string $discount_type;

    function __construct($code, $name, $price, $currency, $discount) {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
        $this->currency = $currency;
        $this->discount_type = $discount;
    }
}
