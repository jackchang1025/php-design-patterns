<?php

namespace App\Behavior\TemplateMethod;

abstract class Shopping
{
    final public function doShopping(): void
    {
        $this->enterShop();
        $this->browseProducts();
        $this->chooseProduct();
        $this->makePayment();
        $this->exitShop();
    }

    abstract protected function enterShop();

    abstract protected function browseProducts();

    abstract protected function chooseProduct();

    abstract protected function makePayment();

    protected function exitShop(): void
    {
        echo "Exiting the shop\n";
    }
}

class OnlineShopping extends Shopping
{
    protected function enterShop()
    {
        echo "Opening the website\n";
    }

    protected function browseProducts()
    {
        echo "Browsing products on the website\n";
    }

    protected function chooseProduct()
    {
        echo "Adding product to cart\n";
    }

    protected function makePayment()
    {
        echo "Making payment online\n";
    }
}

class OfflineShopping extends Shopping
{
    protected function enterShop()
    {
        echo "Entering the physical shop\n";
    }

    protected function browseProducts()
    {
        echo "Browsing products in the shop\n";
    }

    protected function chooseProduct()
    {
        echo "Taking product to checkout counter\n";
    }

    protected function makePayment()
    {
        echo "Making payment at checkout counter\n";
    }
}

$onlineShopping = new OnlineShopping();
$onlineShopping->doShopping();

$offlineShopping = new OfflineShopping();
$offlineShopping->doShopping();