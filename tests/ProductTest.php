<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../Models/Product.php';
require_once __DIR__.'/../Models/Discount.php';
#require_once 'src/bootstrap.php';

class ProductTest extends TestCase
{
    private $product;

    public function setUp(): void
    {
    }

    public function tearDown(): void
    {
    }

    /**
     * @dataProvider productDataProvider
     */
    public function testInitializeProduct($code, $name, $price, $currency, $discount_type)
    {
        $this->product = new Product($code, $name, $price, $currency, $discount_type);

        $this->assertEquals($code, $this->product->code);
        $this->assertEquals($name, $this->product->name);
        $this->assertEquals($price, $this->product->price);
        $this->assertEquals($currency, $this->product->currency);
        $this->assertEquals($discount_type, $this->product->discount_type);
    }

    public static function productDataProvider(): array
    {
        return [
            ['GR1', 'Green Tea', 3.11, 'euro', Discount::FREE],
            ['SR1', 'Strawberries', 5.0, 'euro', Discount::ABSOLUTE],
            ['CF1', 'Coffee', 11.23, 'euro', Discount::PERCENT],
            ['AA1', 'Abc', 2.5, 'euro', 'invalid'],
        ];
    }
}
