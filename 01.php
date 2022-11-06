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
    createProducts(2, 'Latte', 500),
    createProducts(3, 'Cappuccino', 150)
];

//Key is coin value and value is the amount of keys.
$coins = [
    200 => 50, 100 => 40, 50 => 0, 20 => 10, 10 => 40,5 => 10, 2 => 20, 1 => 30
];

function formatMoney(int $amount, string $currency = '€'): string
{
    return number_format(($amount / 100),2 ). $currency;
}

echo "Welcome!\n";
echo "Products Available: \n";
foreach ($products as $product) {
    echo $product->id. ". " . $product->title . " - " . formatMoney($product->price). "\n";
}
$userSelection = (int)readline("<< ");
echo PHP_EOL;
$selectedProduct = $products[$userSelection];
echo "You selected - " . $selectedProduct->title . " " .formatMoney($product->price) ."\n";

$insertedCoins = 0;

while($insertedCoins < $selectedProduct->price) {
    echo "You inserted " . formatmoney($insertedCoins).".\n";
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
foreach ($coins as $value => $amount) {
    if ($remainder <= 0) {
        break;
    }
    $times = intdiv($remainder, $value);
    if($times !== 0){
        $remainder -= $value * $times;
        $coinsReturned .= formatMoney($value). " ";
        $amount -= $times;
    }
}

echo "Coins returned - " . $coinsReturned;


