<?php
require_once 'Product.php';

class PieceProduct extends Product 
{
    protected int $quantity;

    public function __construct(string $name, float $basePrice, int $quantity)
    {
        parent::__construct($name, $basePrice);
        $this->quantity = $quantity;
    }

    public function calculateFinalCost(): float 
    {
 
        return $this->basePrice * $this->quantity;
    }
}