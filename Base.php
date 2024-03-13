<?php

require_once 'src/bootstrap.php';
require 'src/helpers.php';

class Base {
    const string INPUT_FILE = 'input.json';

    public array $products_list = [];
    public array $discounts_list = [];
    public array $basket = [];

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

        $service = new CalculateBasketPrice($this->basket, $this->products_list, $this->discounts_list);
        $result = $service->call();

        if ($result['success']) {
            echo "Total price: ".$result['price'].get_currency_sign('euro')."\n";
        } else {
            echo "Error message: ".$result['message']."\n";
        }
    }

    private function add_product_to_basket($code): void {
        if ( array_key_exists( $code, $this->products_list) )
            $this->basket[] = $code;
        else
            echo "There is no such product registered\n";
    }
}
