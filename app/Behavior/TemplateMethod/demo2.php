<?php

namespace App\Behavior\TemplateMethod;

/**
 * 在商场系统中，模板方法模式可以用于处理订单。
 * 例如，无论是在线支付还是货到付款，订单处理的基本步骤都是相同的：
 * 验证订单、减少库存、进行支付（如果需要）、发货。
 * 但是，进行支付的具体步骤可能会根据支付方式的不同而不同。
 * 我们可以使用模板方法模式来定义订单处理的基本步骤，并允许子类来实现进行支付的步骤
 */

abstract class OrderProcessor
{
    // Template method
    public function process(): void
    {
        $this->validateOrder();
        $this->reduceStock();
        $this->doPayment();
        $this->shipOrder();
    }

    protected function validateOrder()
    {
        echo "Validating order...\n";
    }

    protected function reduceStock()
    {
        echo "Reducing stock...\n";
    }

    protected abstract function doPayment();

    protected function shipOrder(): void
    {
        echo "Shipping order...\n";
    }
}

class OnlinePaymentOrderProcessor extends OrderProcessor
{
    protected function doPayment(): void
    {
        echo "Doing online payment...\n";
    }
}

class CashOnDeliveryOrderProcessor extends OrderProcessor
{
    protected function doPayment(): void
    {
        echo "Cash on delivery, no online payment needed.\n";
    }
}

// Client code
$onlineOrder = new OnlinePaymentOrderProcessor();
$onlineOrder->process();

$cashOnDeliveryOrder = new CashOnDeliveryOrderProcessor();
$cashOnDeliveryOrder->process();