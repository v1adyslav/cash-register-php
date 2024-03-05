<?php

class Discount
{
    const FREE = 'free';
    const ABSOLUTE = 'absolute';
    const PERCENT = 'percent';

    public $type, $count, $value;

    function __construct($discount) {
        $this->type = $discount->type;
        $this->count = $discount->count;
        $this->value = $discount->value;
    }
}
