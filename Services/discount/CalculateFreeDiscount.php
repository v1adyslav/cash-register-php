<?php

class CalculateFreeDiscount
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

        if ($this->count > $this->discount->count) {
            $batch_size = $this->discount->count + $this->discount->value;

            $value = ($this->count / $batch_size) * ($this->discount->value * $this->product->price);

            $rest = $this->count % $batch_size;
            if ($rest > 0) { $value += ($rest - $this->discount->count) * $this->product->price; }
        }
    
        return $value;
    }
}
