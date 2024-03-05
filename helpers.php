<?php

function show_product_details($product) {
    echo "Code: $product->code \n";
    echo "Name: $product->name \n";

    $currency = match ($product->currency) {
        'euro' => '€',
        default => '$',
    };

    echo "Price: $product->price$currency \n\n";
}
