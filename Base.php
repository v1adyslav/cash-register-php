<?php

require 'Models/Product.php';
require 'Models/Discount.php';
require 'helpers.php';

class Base {
    const INPUT_FILE = 'input.json';

    public $products_list = [];
    public $discounts_list = [];
    public $basket = [];

    public function cli() {
        # read from input file
        echo "Products will be got from ".self::INPUT_FILE." file\n";
        $data = json_decode(file_get_contents(self::INPUT_FILE), false);
        $products = $data->products;
        $discounts = $data->discounts;

        foreach ($products as $product) {
            $new_product = new Product($product->code, $product->name, $product->price, $product->currency, $product->discount);
            $this->products_list[$new_product->code] = $new_product;
            show_product_details($new_product);
        }

        foreach ($discounts as $discount) {
            $this->discounts_list[$discount->type] = new Discount($discount);
        }

        echo "Add products to the basket. Enter each product by it's code and press Enter\n";
        echo "To finish add products type 'end'\n";

        do {
            $buf = readline('> ');
            $this->add_product_to_basket($buf);
        } while ($buf != 'end');

        echo "Basket is ".join(',', $this->basket)."\n";
    }

    private function add_product_to_basket($code) {
        if ( array_key_exists( $code, $this->products_list) )
            $this->basket[] = $code;
        else
            echo "There is no such product registered\n";
    }
}
