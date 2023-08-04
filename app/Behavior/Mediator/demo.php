<?php

namespace App\Behavior\Mediator;

interface Mediator
{
    public function notify(object $object, string $event): void;
}

class ConcreteMediator implements Mediator
{

    public function __construct(
        protected readonly BaseComponent $component1,
        protected readonly BaseComponent $component2
    )
    {
        $this->component1->setMediator($this);
        $this->component2->setMediator($this);
    }

    public function notify(object $object, string $event): void
    {
        if ($event == "A") {
            echo "Mediator reacts on A and triggers following operations:\n";
            $this->component2->doC();
        }

        if ($event == "D") {
            echo "Mediator reacts on D and triggers following operations:\n";
            $this->component1->doB();
            $this->component2->doC();
        }
    }
}

class BaseComponent
{
    public function __construct(protected ?Mediator $mediator = null)
    {
    }

    /**
     * @param Mediator $mediator
     */
    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }
}

class Component1 extends BaseComponent
{
    public function doA(): void
    {
        echo "Component 1 does A.\n";
        $this->mediator->notify($this, "A");
    }

    public function doB(): void
    {
        echo "Component 1 does B.\n";
        $this->mediator->notify($this, "B");
    }
}

class Component2 extends BaseComponent
{
    public function doC(): void
    {
        echo "Component 2 does C.\n";
        $this->mediator->notify($this, "C");
    }

    public function doD(): void
    {
        echo "Component 2 does D.\n";
        $this->mediator->notify($this, "D");
    }
}

$c1 = new Component1();
$c2 = new Component2();
$mediator = new ConcreteMediator($c1, $c2);

echo "Client triggers operation A.\n";
$c1->doA();

echo "\n";
echo "Client triggers operation D.\n";
$c2->doD();