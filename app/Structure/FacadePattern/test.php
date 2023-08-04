<?php

/**
 * 在商场系统中，我们可以考虑一个订单处理的例子。假设我们的订单处理包括以下步骤：
 * 验证订单、计算总价、扣减库存、处理支付、发送邮件通知等。
 * 每个步骤都可能需要调用不同的类和方法。
 * 如果我们直接在客户端代码中调用这些类和方法，那么代码可能会变得非常复杂。
 * 而如果我们使用外观模式，我们可以创建一个订单处理外观，它提供了一个简单的接口，用来处理所有的订单处理步骤
 */

class OrderValidator
{
    public function validate($order): void
    {
        echo "Validating order\n";
    }
}

class PriceCalculator
{
    public function calculate($order): void
    {
        echo "Calculating total price\n";
    }
}

class StockManager
{
    public function reduceStock($order): void
    {
        echo "Reducing stock\n";
    }
}

class PaymentProcessor
{
    public function processPayment($order): void
    {
        echo "Processing payment\n";
    }
}

class EmailSender
{
    public function sendEmail($order): void
    {
        echo "Sending email\n";
    }
}

class OrderProcessingFacade
{

    public function __construct(
        protected readonly OrderValidator   $orderValidator,
        protected readonly PriceCalculator  $priceCalculator,
        protected readonly StockManager     $stockManager,
        protected readonly PaymentProcessor $paymentProcessor,
        protected readonly EmailSender      $emailSender
    )
    {
    }

    public function processOrder($order): void
    {
        $this->orderValidator->validate($order);
        $this->priceCalculator->calculate($order);
        $this->stockManager->reduceStock($order);
        $this->paymentProcessor->processPayment($order);
        $this->emailSender->sendEmail($order);
    }
}

// Client code
$facade = new OrderProcessingFacade(
    new OrderValidator(),
    new PriceCalculator(),
    new StockManager(),
    new PaymentProcessor(),
    new EmailSender(),
);

$facade->processOrder("order1");

/**
 * 在这个例子中，我们首先定义了几个处理订单的类（OrderValidator、PriceCalculator、StockManager、PaymentProcessor、EmailSender）。然后我们创建了一个订单处理外观（OrderProcessingFacade），
 * 它包含了所有处理订单的类，并提供了一个简单的接口（processOrder）来处理所有的订单处理步骤。
 * 在客户端代码中，我们只需要调用外观的 processOrder 方法，就可以完成所有的订单处理步骤。
 *
 * 这样，我们就可以将复杂的订单处理步骤封装在一个简单的接口后面，使得客户端代码更简单，更易于理解和维护。
 * 同时，如果我们需要修改订单处理的步骤，我们只需要修改外观类，而不需要修改客户端代码。这符合开闭原则，即对扩展开放，对修改关闭。
 */
