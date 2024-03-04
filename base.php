<?php
class Base {
    const INPUT_FILE = 'input.json';

    public function cli() {
        # read from input file
        echo "Products will be got from ".self::INPUT_FILE." file\n";

        $data = json_decode(file_get_contents(self::INPUT_FILE), false);
        $products = $data->products;
        $discounts = $data->discounts;
    }
}
