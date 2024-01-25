<?php

$array = ["andres", "ana", "manuel", "ignacio"];

foreach ($array as $key => $value) {
    echo $key . PHP_EOL;
    echo $value . PHP_EOL;
}
echo '<BR>';

$array_asociativo = array(
    'nombre' => 'Andres',
    'edad' => '37',
    'email' => 'andrespodadera87@gmail.com'
);

foreach ($array_asociativo as $key => $value) {
    echo $key . PHP_EOL . ' : ' . $value . PHP_EOL;

}
echo '<BR>';

$basket = [];

$basket['color'] = 'brown';
$basket['size'] = 'large';
$basket['contents'] = [];
$basket['contents'][] = 'apple';
$basket['contents'][] = 'orange';
$basket['contents'][] = 'pineapple';

print_r($basket);
echo '<BR>';

foreach ($basket as $key => $value) {
    if (is_array($value)) {
        echo "{$key} => [" . PHP_EOL;

        foreach ($value as $item) {
            echo "\t{$item}" . PHP_EOL;
        }

        echo ']' . PHP_EOL;
    } else {
        echo "{$key}: $value" . PHP_EOL;
    }
}
echo '<BR>';

$array = [
    'os' => 'linux',
    'mfr' => 'system76',
    'name' => 'thelio',
];

$keys = array_keys($array);
$arrayLength = count($keys);
for ($i = 0; $i < $arrayLength; $i++) {
    $key = $keys[$i];
    $value = $array[$key];

    echo "{$key} => {$value}" . PHP_EOL . '<BR>';
}