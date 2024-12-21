<?php
class Cart {
    protected array $items = [];
    protected float $totalPrice = 0.0;

    public function addItem(Product $product, int $quantity) {
        $this->items[] = ['product' => $product, 'quantity' => $quantity];
        $this->totalPrice += $product->getPrice() * $quantity;
    }

    public function removeItem(int $index) {
        if (isset($this->items[$index])) {
            $this->totalPrice -= $this->items[$index]['product']->price * $this->items[$index]['quantity'];
            unset($this->items[$index]);
        }
    }
}