<?php

namespace App\Behavior\Strategy;

interface Strategy
{
    public function doAlgorithm(array $data): array;
}

class ConcreteStrategyA implements Strategy
{
    public function doAlgorithm(array $data): array
    {
        sort($data);

        return $data;
    }
}

class ConcreteStrategyB implements Strategy
{
    public function doAlgorithm(array $data): array
    {
        rsort($data);

        return $data;
    }
}

class Context
{
    public function __construct(protected Strategy $strategy)
    {
    }

    public function doSomeBusinessLogic(): void
    {
        echo "Context: Sorting data using the strategy (not sure how it'll do it)\n";
        $result = $this->strategy->doAlgorithm(["a", "b", "c", "d", "e"]);
        echo implode(",", $result) . "\n";
    }
}

$context = new Context(new ConcreteStrategyA());
$context->doSomeBusinessLogic();

echo "\n";

$context = new Context(new ConcreteStrategyB());
$context->doSomeBusinessLogic();