<?php

namespace App\Behavior\Iterator;

use Iterator;
use IteratorAggregate;


class AlphabeticalOrderIterator implements Iterator
{
    private int $position = 0;

    public function __construct(private readonly Collection $collection, private readonly bool $reverse = false)
    {
    }

    public function current(): mixed
    {
        return $this->collection->getItems()[$this->position];
    }

    public function next(): void
    {
        $this->position = $this->position + ($this->reverse ? -1 : 1);
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->collection->getItems()[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = $this->reverse ?
            count($this->collection->getItems()) - 1 : 0;
    }
}

interface InterfaceCollection
{
    public function getItems();
}

class Collection implements IteratorAggregate, InterfaceCollection
{
    private array $items = [];

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem($item): void
    {
        $this->items[] = $item;
    }

    public function getIterator(): Iterator
    {
        return new AlphabeticalOrderIterator($this);
    }

    public function getReverseIterator(): Iterator
    {
        return new AlphabeticalOrderIterator($this, true);
    }
}

$collection = new Collection();
$collection->addItem("First");
$collection->addItem("Second");
$collection->addItem("Third");

foreach ($collection->getIterator() as $item) {
    echo $item . "\n";
}