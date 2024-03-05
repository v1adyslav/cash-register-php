<?php

require 'discount/CalculateFreeDiscount.php';
require 'discount/CalculateAbsoluteDiscount.php';
require 'discount/CalculatePercentDiscount.php';

class CalculateBasketPrice
{
    public array $basket, $products_list, $discounts_list;

    public function __construct($basket, $products_list, $discounts_list)
    {
        $this->basket = $basket;
        $this->products_list = $products_list;
        $this->discounts_list = $discounts_list;
    }

    public function call(): array {
        try {
            $price = $this->calculate();
            $res = [
                'success' => true,
                'message' => '',
                'price' => $price
            ];
        } catch (Exception $e) {
            $res = [
                'success' => false,
                'message' => $e->getMessage(),
                'price' => 0
            ];
        }

        return $res;
    }

    private function calculate(): float {
        $products_count = [];
        foreach ($this->products_list as $code => $value) { $products_count[$code] = 0; }
        foreach ($this->basket as $value) { $products_count[$value] += 1; }

        $sum = 0;
        foreach ($this->products_list as $code => $product) {
            $count = $products_count[$product->code];
            $discount = $this->discounts_list[$product->discount_type];

            $sum_product = $count * $product->price;

            $discountService = match ($product->discount_type) {
                Discount::FREE => new CalculateFreeDiscount($product, $count, $discount),
                Discount::ABSOLUTE => new CalculateAbsoluteDiscount($product, $count, $discount),
                Discount::PERCENT => new CalculatePercentDiscount($product, $count, $discount),
            };
            $discount_value = $discountService->call();

            $sum += $sum_product - $discount_value;
        }

        return round($sum, 2);
    }
}
