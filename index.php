<?php

require_once 'vendor/autoload.php';

dump('names.json');

$names = file_get_contents('names.json');
dump($names);
$names = json_decode($names);
dump($names);

dump('user.json');

$user = file_get_contents('user.json');
dump($user);
$user = json_decode($user, true);
dump($user);
dump("Имя: {$user['name']}");

dump('products.json');

$products = file_get_contents('products.json');
dump($products);
$products = json_decode($products, true);
dump($products);

dump('names.php');

$names = include 'names.php';
dump($names);
$names = json_encode($names);
dump($names);

dump('user.php');

$user = include 'user.php';
dump($user);
$user = json_encode($user, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
dump($user);