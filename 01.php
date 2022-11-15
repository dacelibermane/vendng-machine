<?php

function createProducts(string $title, int $price): stdClass
{
    $items = new stdClass();
    $items->title = $title;
    $items->price = $price;
    return $items;
}

$products = [
    createProducts('Black Coffee', 120),
    createProducts('White Coffee', 130),
    createProducts('Latte', 500),
    createProducts('Cappuccino', 150)
];

//Key is coin value and value is the amount of keys.
$coins = [
    200 => 50, 100 => 40, 50 => 0, 20 => 10, 10 => 40, 5 => 10, 2 => 20, 1 => 30
];

function formatMoney(int $amount, string $currency = '€'): string
{
    return number_format(($amount / 100), 2) . $currency;
}

echo "Welcome!\n";
echo "Products Available: \n";
foreach ($products as $key => $product) {

    echo $key + 1 . ". " . $product->title . " - " . formatMoney($product->price) . "\n";
}
$userSelection = (int)readline("<< ");
$userSelection -= 1;
echo PHP_EOL;
$selectedProduct = $products[$userSelection];
echo "You selected - " . $selectedProduct->title . " " . formatMoney($product->price) . "\n";

$insertedCoins = 0;

while ($insertedCoins < $selectedProduct->price) {
    echo "You inserted " . formatmoney($insertedCoins) . ".\n";
    $coinInput = (int)readline("\nPlease insert more coins: ");
    if (!in_array($coinInput, array_keys($coins))) {
        echo "Invalid coin!\n";

    } else {
        $insertedCoins += $coinInput;
    }
}

$remainder = $insertedCoins - $selectedProduct->price;


$coinsReturned = '';
echo "Your remainder is " . formatMoney($remainder) . "\n";
while ($remainder > 0) {

    foreach ($coins as $value => $amount) {
        if ($amount <= 0) {
            continue;
        }
        $times = intdiv($remainder, $value);
        $coins[$value] -= $times;

        $coinCount = $amount - $times;
        if ($coinCount < 0) $times += $coinCount;

        if ($times !== 0) {
            $remainder -= $value * $times;
            $coinsReturned .= formatMoney($value) . " x " . $times . " ||";
        }
    }
    if ($remainder > 0) {
        echo "Failed to give back remainder";
        break;
    }
}

echo "Coins returned = " . $coinsReturned;




