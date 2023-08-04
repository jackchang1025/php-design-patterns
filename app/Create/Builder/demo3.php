<?php

namespace App\Create\Builder;

class Product
{
    public function __construct(protected readonly string $name, protected readonly float $price)
    {
    }
}

class Order
{
    private array $products = [];

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getProduct(): array
    {
        return $this->products;
    }

    // Other order methods...
}

class OrderBuilder
{
    private Order $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function addProduct($name, $price): static
    {
        $product = new Product($name, $price);
        $this->order->addProduct($product);
        return $this; // Return the builder to allow method chaining.
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}

// Client code
$builder = new OrderBuilder();
$builder->addProduct('Book', 10.99)
    ->addProduct('DVD', 15.99)
    ->addProduct('Video Game', 59.99);

$order = $builder->getOrder();

