<?php

abstract class Component
{
    public abstract function display();
}

class ConcreteComponent extends Component
{
    public function display(): void
    {
        echo ' 具体构件 ' . PHP_EOL;
    }
}

interface Middleware {
    public function handle();
}

class RequestMiddleware implements Middleware{
    public function handle()
    {
        echo 'handle'.PHP_EOL;
    }
}


abstract class ComponentDecorator extends Component implements Middleware
{
    public function __construct(protected readonly Component $component)
    {
    }

}

class ConcreteDecorator extends ComponentDecorator
{
    public function display(): void
    {
        echo ' 装饰前的行为 ' . PHP_EOL;
        $this->component->display();
        echo ' 装饰后的行为 ' . PHP_EOL;
    }

    public function handle()
    {
        echo 'handle'.PHP_EOL;
    }
}

$decorator = new ConcreteDecorator(new ConcreteComponent());
$decorator->display();