<?php
require_once 'Product.php';
class WeightProduct extends Product {

    protected float $weight;

    public function __construct(string $name, float $basePrice, float $weight)
    {
        parent::__construct($name, $basePrice);
        $this->weight = $weight;
    }

    public function calculateFinalCost(): float 
    {     
        return $this->basePrice * $this->weight;
    }
}