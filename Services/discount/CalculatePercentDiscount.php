<?php

class CalculatePercentDiscount
{
    public Product $product;
    public int $count;
    public Discount $discount;

    function __construct($product, $count, $discount)
    {
        $this->product = $product;
        $this->count = $count;
        $this->discount = $discount;
    }

    public function call(): float {
        $value = 0;

        if ($this->count >= $this->discount->count) {
            $value = $this->discount->value * $this->product->price * $this->count;
        }

        return $value;
    }
}
