<?php

class Discount
{
    const string FREE = 'free';
    const string ABSOLUTE = 'absolute';
    const string PERCENT = 'percent';

    public string $type;
    public int $count;
    public float $value;

    function __construct($discount) {
        $this->type = $discount->type;
        $this->count = $discount->count;
        $this->value = $discount->value;
    }
}
