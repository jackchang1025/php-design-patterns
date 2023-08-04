<?php

namespace App\Behavior\Observer;

use SplObjectStorage;
use SplObserver;
use SplSubject;

class Subject implements \SplSubject
{
    public int $state;

    private SplObjectStorage $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function attaches(array $observers): void
    {
        foreach ($observers as $observer){
            $this->attach($observer);
        }
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function removeAll(): int
    {
        return $this->observers->removeAll($this->observers);
    }

    /**
     * Trigger an update in each subscriber.
     */
    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function someBusinessLogic(): void
    {
        $this->state = rand(0, 10);
        $this->notify();
    }
}

class ConcreteObserverA implements \SplObserver{
    public function update(SplSubject $subject): void
    {
        echo "ConcreteObserverA: Reacted to the event.{$subject->state}\n";
    }
}

class ConcreteObserverB implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        echo "ConcreteObserverB: Reacted to the event.{$subject->state}\n";
    }
}

$observers = [
    new ConcreteObserverA(),
    new ConcreteObserverB(),
];

$subject = new Subject();
$subject->attaches($observers);

$subject->someBusinessLogic();


$subject->removeAll();
$subject->someBusinessLogic();
