<?php

namespace App\Behavior\Command;

interface  Command
{
    public function execute(): void;
}

class ComplexCommand implements Command
{
    public function __construct(protected readonly Receiver $receiver, protected string $a, protected string $b)
    {
    }

    public function execute(): void
    {
        echo "ComplexCommand: Complex stuff should be done by a receiver object.\n";
        $this->receiver->doSomething($this->a);
        $this->receiver->doSomethingElse($this->b);
    }
}

class Receiver
{
    public function doSomething(string $a): void
    {
        echo "Receiver: Working on (" . $a . ".)\n";
    }

    public function doSomethingElse(string $b): void
    {
        echo "Receiver: Also working on (" . $b . ".)\n";
    }
}

class Invoker
{
    /**
     * @var Command
     */
    private Command $onStart;

    /**
     * @var Command
     */
    private Command $onFinish;

    public function setOnStart(Command $command): void
    {
        $this->onStart = $command;
    }

    public function setOnFinish(Command $command): void
    {
        $this->onFinish = $command;
    }

    public function doSomethingImportant(): void
    {
        echo "Invoker: Does anybody want something done before I begin?\n";
        $this->onStart->execute();

        echo "Invoker: ...doing something really important...\n";

        echo "Invoker: Does anybody want something done after I finish?\n";
        $this->onFinish->execute();
    }
}

