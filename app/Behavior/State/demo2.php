<?php

interface OrderState
{
    public function proceedToNext(OrderContext $context);
}

class Created implements OrderState
{
    public function proceedToNext(OrderContext $context): void
    {
        $context->setState(new Paid());
    }
}

class Paid implements OrderState
{
    public function proceedToNext(OrderContext $context): void
    {
        $context->setState(new Shipped());
    }
}

class Shipped implements OrderState
{
    public function proceedToNext(OrderContext $context): void
    {
        $context->setState(new Completed());
    }
}

class Completed implements OrderState
{
    public function proceedToNext(OrderContext $context)
    {
        // Order is completed. No more state transitions.
    }
}

class OrderContext
{
    public function __construct(protected OrderState $state)
    {
    }

    public function setState(OrderState $state): void
    {
        $this->state = $state;
    }

    public function getState(): OrderState
    {
        return $this->state;
    }

    public function proceedToNext(): void
    {
        $this->state->proceedToNext($this);
    }
}