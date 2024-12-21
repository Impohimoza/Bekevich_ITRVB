<?php
require_once 'Product.php';
class DigitalProduct extends Product
{
    public function calculateFinalCost(): float
    {
        return $this->basePrice / 2;
    }
}