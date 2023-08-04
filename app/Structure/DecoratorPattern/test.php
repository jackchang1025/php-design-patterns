<?php

namespace App\DecoratorPattern;

interface Product
{
    public function getPrice();
}

class ConcreteProduct implements Product
{
    private int $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

abstract class DiscountDecorator implements Product
{
    public function __construct(protected readonly Product $product)
    {
    }
}

class NewUserDiscountDecorator extends DiscountDecorator
{
    public function getPrice(): float
    {
        return $this->product->getPrice() * 0.9;  // 10% discount for new user
    }
}

class MemberDiscountDecorator extends DiscountDecorator
{
    public function getPrice(): float
    {
        return $this->product->getPrice() * 0.8;  // 20% discount for member
    }
}

$product = new ConcreteProduct(100);
echo $product->getPrice() . PHP_EOL;  // Output: 100

$product = new NewUserDiscountDecorator($product);
echo $product->getPrice() . PHP_EOL;  // Output: 90

$product = new MemberDiscountDecorator($product);
echo $product->getPrice() . PHP_EOL;  // Output: 72

/**
 * 在这个例子中，我们首先定义了一个商品接口（Product）和一个实现这个接口的类（ConcreteProduct）。
 * 然后我们定义了一个折扣装饰器抽象类（DiscountDecorator）和两个继承这个抽象类的类（NewUserDiscountDecorator 和 MemberDiscountDecorator）。
 * 在客户端代码中，我们可以通过装饰器动态地添加折扣策略。
 *
 * 这样，我们就可以将商品的价格和折扣策略分离开来，使得它们可以独立地变化和扩展。
 * 当我们需要添加新的折扣策略时，我们只需要添加一个新的装饰器，而不需要修改现有的代码。
 * 这符合开闭原则，即对扩展开放，对修改关闭。
 */