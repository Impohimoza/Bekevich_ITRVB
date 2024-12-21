<?php
class Product 
{
    protected string $id;
    protected string $name;
    protected string $category;
    protected float $price;
    protected string $description;

    public function __construct(string $id, string $name, string $category, float $price, string $description) 
    {
        $this-> id= $id;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getName()
    {
        return $this->name;
    }

}

class DigitalProduct extends Product 
{
    protected string $downloadLink;

    public function __construct(string $id, string $name, string $category, float $price, string $description, string $downloadLink) {
        parent::__construct($id, $name, $category, $price, $description);
        $this->downloadLink = $downloadLink;
    }

    public function getDownloadLink()
    {
        return $this->downloadLink;
    }
}

class PhysicalProduct extends Product {
    protected int $quantity;

    public function __construct(string $id, string $name, string $category, float $price, string $description, int $quantity) {
        parent::__construct($id, $name, $category, $price, $description);
        $this->quantity = $quantity;
    }

    public function getPrice() 
    {
        return parent::getPrice() * $this->quantity;
    }

    public function getQuantity() 
    {
        return $this->quantity;
    }
}