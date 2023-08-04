### 适配器模式（Adapter Pattern）
适配器模式是一种结构型设计模式，它的主要目的是使得原本由于接口不兼容而不能一起工作的类可以一起工作。 
适配器模式通过提供一个转换接口，将一个类的接口转换成客户期望的另一个接口。

适配器可担任两个对象间的封装器， 它会接收对于一个对象的调用， 并将其转换为另一个对象可识别的格式和接口。

### 适配器模式适合应用场景
当你希望使用某个类， 但是其接口与其他代码不兼容时， 可以使用适配器类。
适配器模式允许你创建一个中间层类， 其可作为代码与遗留类、 第三方类或提供怪异接口的类之间的转换器。
如果您需要复用这样一些类， 他们处于同一个继承体系， 并且他们又有了额外的一些共同的方法， 但是这些共同的方法不是所有在这一继承体系中的子类所具有的共性。
你可以扩展每个子类， 将缺少的功能添加到新的子类中。 但是， 你必须在所有新子类中重复添加这些代码， 这样会使得代码有坏味道。
将缺失功能添加到一个适配器类中是一种优雅得多的解决方案。 然后你可以将缺少功能的对象封装在适配器中， 从而动态地获取所需功能。 如要这一点正常运作， 目标类必须要有通用接口， 适配器的成员变量应当遵循该通用接口。 这种方式同装饰模式非常相似。

### 实现方式
1. 确保至少有两个类的接口不兼容：
 - 一个无法修改 （通常是第三方、 遗留系统或者存在众多已有依赖的类） 的功能性服务类。 
 - 一个或多个将受益于使用服务类的客户端类。
2. 声明客户端接口， 描述客户端如何与服务交互。
3. 创建遵循客户端接口的适配器类。 所有方法暂时都为空。
4. 在适配器类中添加一个成员变量用于保存对于服务对象的引用。 通常情况下会通过构造函数对该成员变量进行初始化， 但有时在调用其方法时将该变量传递给适配器会更方便。
5. 依次实现适配器类客户端接口的所有方法。 适配器会将实际工作委派给服务对象， 自身只负责接口或数据格式的转换。
6. 客户端必须通过客户端接口使用适配器。 这样一来， 你就可以在不影响客户端代码的情况下修改或扩展适配器。

### 适配器模式优缺点
- 单一职责原则你可以将接口或数据转换代码从程序主要业务逻辑中分离。
- 开闭原则。 只要客户端代码通过客户端接口与适配器进行交互， 你就能在不修改现有客户端代码的情况下在程序中添加新类型的适配器。
- 代码整体复杂度增加， 因为你需要新增一系列接口和类。 有时直接更改服务类使其与其他代码兼容会更简单。

### 与其他模式的关系
桥接模式通常会于开发前期进行设计， 使你能够将程序的各个部分独立开来以便开发。 
适配器模式通常在已有程序中使用， 让相互不兼容的类能很好地合作。
适配器可以对已有对象的接口进行修改， 装饰模式则能在不改变对象接口的前提下强化对象功能。 此外， 装饰还支持递归组合， 适配器则无法实现。
适配器能为被封装对象提供不同的接口， 代理模式能为对象提供相同的接口， 装饰则能为对象提供加强的接口。
外观模式为现有对象定义了一个新接口， 适配器则会试图运用已有的接口。 适配器通常只封装一个对象， 外观通常会作用于整个对象子系统上。
桥接、 状态模式和策略模式 （在某种程度上包括适配器） 模式的接口非常相似。 实际上， 它们都基于组合模式——即将工作委派给其他对象， 不过也各自解决了不同的问题。 
模式并不只是以特定方式组织代码的配方， 你还可以使用它们来和其他开发者讨论模式所解决的问题。

### 使用示例：
适配器模式在 PHP 代码中很常见。 基于一些遗留代码的系统常常会使用该模式。 在这种情况下， 适配器让遗留代码与现代的类得以相互合作。

### 识别方法：
适配器可以通过以不同抽象或接口类型实例为参数的构造函数来识别。 当适配器的任何方法被调用时， 它会将参数转换为合适的格式， 然后将调用定向到其封装对象中的一个或多个方法。

### 真实世界示例
~~~php

interface Notification 
{
    public function send(string $title,string $message);
}

class EmailNotification implements Notification
{
    private $adminEmail;

    public function __construct(string $adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    public function send(string $title, string $message): void
    {
        mail($this->adminEmail, $title, $message);
        echo "Sent email with title '$title' to '{$this->adminEmail}' that says '$message'.";
    }
}
//
class SlackApi
{
    private $login;
    private $apiKey;

    public function __construct(string $login, string $apiKey)
    {
        $this->login = $login;
        $this->apiKey = $apiKey;
    }

    public function logIn(): void
    {
        // Send authentication request to Slack web service.
        echo "Logged in to a slack account '{$this->login}'.\n";
    }

    public function sendMessage(string $chatId, string $message): void
    {
        // Send message post request to Slack web service.
        echo "Posted following message into the '$chatId' chat: '$message'.\n";
    }
}
//适配器
class SlackNotification implements Notification 
{
    protected SlackApi $slackApi;
    protected string $chatId;
    
    public function __construct(SlackApi $slackApi,string $chatId)
    {
        $this->slackApi = $slackApi;
        $this->chatId = $chatId;
    }
    
    public function send(string $title, string $message){
        $this->slackApi->logIn();
        
        $this->slackApi->sendMessage($this->chatId,$message);
    }
}

//客户端调用
function client(Notification $notification){
    return $notification->send("Website is down!","<strong style='color:red;font-size: 50px;'>Alert!</strong>");
}

client(new EmailNotification('admin'));

client(new SlackNotification(new SlackApi('login','apikey'),'xxxxxxxx'));
~~~