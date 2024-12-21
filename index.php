<?php
require_once 'DigitalProduct.php';
require_once 'PieceProduct.php';
require_once 'WeightProduct.php';
//Пример использования

$digitalProduct = new DigitalProduct("Электронная книга", 200);
$pieceProduct = new PieceProduct("Чашка", 50, 10);
$weightProduct = new WeightProduct("Сахар", 30, 1.5);

echo "Доход от цифрового товара: " . $digitalProduct->calculateFinalCost() . " руб.<br>";
echo "Доход от штучного товара: " . $pieceProduct->calculateFinalCost() . " руб.<br>";
echo "Доход от весового товара: " . $weightProduct->calculateFinalCost() . " руб.<br>";