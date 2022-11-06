<?php
function createProducts(int $id, string $title, int $price): stdClass
{
    $items = new stdClass();
    $items->id = $id;
    $items->title = $title;
    $items->price = $price;
    return $items;
}

$products = [
    createProducts(0, 'Black Coffee', 120),
    createProducts(1, 'White Coffee', 130),
    createProducts(2, 'Latte', 170),
    createProducts(3, 'Cappuccino', 150)
];

//Key is coin value and value is the amount of keys.
$coins = [
    200 => 50, 100 => 40, 50 => 60, 20 => 10, 10 => 40, 2 => 20, 1 => 30
];

function formatMoney(int $amount, string $currency = '€'): string
{
    return ($amount / 100) . $currency . " ";
}

echo "Welcome!\n";
echo "Products Available: \n";
foreach ($products as $product) {
    echo "{$product->id}. {$product->title} - {$product->price}\n";
}
$userSelection = (int)readline("<< \n");
echo PHP_EOL;
$selectedProduct = $products[$userSelection];


echo "You selected - {$selectedProduct->title}.\n";
$insertedCoins = readline("Please insert money: \n");
echo PHP_EOL;
$remainder = $insertedCoins - $selectedProduct->price;

$coinsReturned = '';
echo "Your remainder is " . formatMoney($remainder) . "\n";
foreach ($coins as $value => $amount) {
    if ($remainder <= 0) {
        break;
    }
    $times = intdiv($remainder, $value);
    $remainder -= $value * $times;
    $coinsReturned .= formatMoney($value);

}

echo "Coins - " . $coinsReturned;


