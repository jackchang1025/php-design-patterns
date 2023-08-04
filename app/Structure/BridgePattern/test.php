<?php

interface Display
{
    public function show(Product $product);
}

class WebDisplay implements Display
{
    public function show(Product $product): void
    {
        echo "Web display: " . $product->getDescription();
    }
}

class PrintDisplay implements Display
{
    public function show(Product $product): void
    {
        echo "Print display: " . $product->getDescription();
    }
}

abstract class Product
{
    public function __construct(protected readonly Display $display)
    {
    }

    public function display()
    {
        return $this->display->show($this);
    }

    abstract public function getDescription();
}

class Clothes extends Product
{

    public function getDescription(): string
    {
        return "This is a piece of clothes.";
    }
}

class Electronics extends Product
{
    public function getDescription(): string
    {
        return "This is an electronic product.";
    }
}

$clothes = new Clothes(new WebDisplay());
echo $clothes->display() . PHP_EOL;
