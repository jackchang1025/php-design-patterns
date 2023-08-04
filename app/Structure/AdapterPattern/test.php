<?php

/**
 * 适配器模式（Adapter Pattern）是一种结构型设计模式，它的主要目的是使得原本由于接口不兼容而不能一起工作的类可以一起工作。
 * 适配器模式通过提供一个转换接口，将一个类的接口转换成客户期望的另一个接口。
 */

interface PaymentGateway
{
    public function pay(float $amount);
}

class CreditCardPayment implements PaymentGateway
{
    public function pay($amount): void
    {
        echo "Paying $amount using Credit Card\n";
    }
}

class PayPal
{
    public function sendPayment($amount): void
    {
        echo "Paying $amount using PayPal\n";
    }
}

class PayPalAdapter implements PaymentGateway
{

    public function __construct(protected readonly PayPal $paypal)
    {
    }

    public function pay($amount): void
    {
        $this->paypal->sendPayment($amount);
    }
}

$payment = new CreditCardPayment();
$payment->pay(100);

$payment = new PayPalAdapter(new PayPal());
$payment->pay(1000);

/**
 * 在商场系统中，我们可以考虑一个支付系统的例子。
 * 假设我们的商场系统原本只支持信用卡支付，现在我们想要添加对 PayPal 支付的支持。
 * 但是，信用卡支付和 PayPal 支付的接口是不同的，我们不能直接在我们的系统中添加 PayPal 支付。
 * 这时，我们就可以使用适配器模式，创建一个 PayPal 适配器，将 PayPal 的接口转换成我们的系统可以接受的信用卡支付接口。
 *
 * 在这个例子中，我们首先定义了一个支付网关接口（PaymentGateway）和一个实现这个接口的类（CreditCardPayment）。
 * 然后我们定义了一个 PayPal 类，它有一个不同的接口（sendPayment）。
 * 然后我们创建了一个 PayPal 适配器（PayPalAdapter），它实现了支付网关接口，并在内部调用 PayPal 的接口。
 * 在客户端代码中，我们可以使用 PayPal 适配器来完成支付，就像使用信用卡支付一样。
 *
 * 这样，我们就可以在不修改原有代码的情况下，添加对新的支付方式的支持。这符合开闭原则，即对扩展开放，对修改关闭。
 */