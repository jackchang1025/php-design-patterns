<?php

namespace App\Behavior\Visitor;


interface Product
{
    public function accept(ProductVisitor $productVisitor);
}

class Book implements Product
{
    public function accept(ProductVisitor $productVisitor)
    {
        return $productVisitor->visitBook($this);
    }
}

class Fruit implements Product
{
    public function accept(ProductVisitor $productVisitor)
    {
        return $productVisitor->visitFruit($this);
    }
}

interface ProductVisitor
{
    public function visitBook(Book $book);

    public function visitFruit(Fruit $fruit);
}

class DiscountVisitor implements ProductVisitor
{
    public function visitBook(Book $product): void
    {
        echo "Applying discount to a book...\n";
    }

    public function visitFruit(Fruit $product): void
    {
        echo "Applying discount to a fruit...\n";
    }
}

class TaxVisitor implements ProductVisitor
{
    public function visitBook(Book $product): void
    {
        echo "Calculating tax for a book...\n";
    }

    public function visitFruit(Fruit $product): void
    {
        echo "Calculating tax for a fruit...\n";
    }
}