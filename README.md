### 设计模式是什么？

设计模式是软件设计中常见问题的典型解决方案。 它们就像能根据需求进行调整的预制蓝图， 可用于解决代码中反复出现的设计问题。
设计模式与方法或库的使用方式不同， 你很难直接在自己的程序中套用某个设计模式。 模式并不是一段特定的代码， 而是解决特定问题的一般性概念。 你可以根据模式来实现符合自己程序实际所需的解决方案。
人们常常会混淆模式和算法， 因为两者在概念上都是已知特定问题的典型解决方案。 但算法总是明确定义达成特定目标所需的一系列步骤， 而模式则是对解决方案的更高层次描述。 同一模式在两个不同程序中的实现代码可能会不一样。
算法更像是菜谱： 提供达成目标的明确步骤。 而模式更像是蓝图： 你可以看到最终的结果和模式的功能， 但需要自己确定实现步骤。
### 目录

#### 创建型模式
* [工厂方法模式](app/Create/FactoryMethod/README.md)
* [抽象工厂模式](app/Create/AbstractFactory/README.md)
* [生成器模式](app/Create/Builder/README.md)
* [单例模式](app/Create/Singleton/README.md)
* [工厂模式比较](app/Create/FactoryModelComparison/README.md)

#### 结构型模式
* [适配器 Adapter](app/Structure/AdapterPattern/README.md)
* [桥接 Bridge](app/Structure/BridgePattern/README.md)
* [组合 Composite](./app/Structure/CompositePattern/README.md)
* [装饰 Decorator](app/Structure/DecoratorPattern/README.md)
* [外观 Facade](./app/Structure/FacadePattern/README.md)
* [享元 Flyweight](./app/Structure/FlyweightPattern/README.md)
* [代理 Proxy](./app/Structure/Proxy/README.md)

#### 行为型模式
* [责任链模式](./app/Behavior/ChainOfResponsibility/README.md)
* [命令模式 Command](./app/Behavior/Command/README.md)
* [迭代器模式](./app/Behavior/Iterator/README.md)
* [中介模式模式 Mediator](./app/Behavior/Mediator/README.md)
* [观察者模式 Observer](./app/Behavior/Observer/README.md)
* [状态模式 State](./app/Behavior/State/README.md)
* [策略模式 Strategy](./app/Behavior/Strategy/README.md)
* [模板方法模式 Template Method](./app/Behavior/TemplateMethod/README.md)
* [访问者模式 Visitor](./app/Behavior/Visitor/README.md)

### 模式包含哪些内容？

大部分模式都有正规的描述方式， 以便在不同情况下使用。 模式的描述通常会包括以下部分：

* 意图部分简单描述问题和解决方案。
* 动机部分将进一步解释问题并说明模式会如何提供解决方案。
* 结构部分展示模式的每个部分和它们之间的关系。
* 在不同语言中的实现提供流行编程语言的代码， 让读者更好地理解模式背后的思想。
* 部分模式介绍中还列出其他的一些实用细节， 例如模式的适用性、 实现步骤以及与其他模式的关系。

### 模式的历史
谁发明了设计模式？ 这是一个很好的问题， 但也有点不太准确。 设计模式并不是晦涩的、 复杂的概念——事实恰恰相反。 
模式是面向对象设计中常见问题的典型解决方案。 同样的解决方案在各种项目中得到了反复使用， 所以最终有人给它们起了名字， 并对其进行了详细描述。 这基本上就是模式被发现的历程了。
模式的概念是由克里斯托佛·亚历山大在其著作 《建筑模式语言》 中首次提出的。 本书介绍了城市设计的 “语言”， 而此类 “语言” 的基本单元就是模式。 
模式中可能会包含对窗户应该在多高、 一座建筑应该有多少层以及一片街区应该有多大面积的植被等信息的描述。
埃里希·伽玛、 约翰·弗利赛德斯、 拉尔夫·约翰逊和理查德·赫尔姆这四位作者接受了模式的概念。 1994 年， 他们出版了 《设计模式： 可复用面向对象软件的基础》 一书， 将设计模式的概念应用到程序开发领域中。 
该书提供了 23 个模式来解决面向对象程序设计中的各种问题， 很快便成为了畅销书。 由于书名太长， 人们将其简称为 “四人组 （Gang of Four， GoF） 的书”， 并且很快进一步简化为 “GoF 的书”。
此后， 人们又发现了几十种面向对象的模式。 ​ “模式方法” 开始在其他程序开发领域中流行起来。 如今， 在面向对象设计领域之外， 人们也提出了许多其他的模式。

### 为什么以及如何学习设计模式？
或许你已从事程序开发工作多年， 却完全不知道单例模式是什么。 很多人都是这样。 即便如此， 你可能也在不自知的情况下已经使用过一些设计模式了。 所以为什么不花些时间来更进一步学习它们呢？
设计模式是针对软件设计中常见问题的工具箱， 其中的工具就是各种经过实践验证的解决方案。 即使你从未遇到过这些问题， 了解模式仍然非常有用， 因为它能指导你如何使用面向对象的设计原则来解决各种问题。
设计模式定义了一种让你和团队成员能够更高效沟通的通用语言。 你只需说 “哦， 这里用单例就可以了”， 所有人都会理解这条建议背后的想法。 只要知晓模式及其名称， 你就无需解释什么是单例。

### 关于模式的争议
设计模式自其诞生之初似乎就饱受争议， 所以让我们来看看针对模式的最常见批评吧。

#### 一种针对不完善编程语言的蹩脚解决方案
通常当所选编程语言或技术缺少必要的抽象功能时， 人们才需要设计模式。 在这种情况下， 模式是一种可为语言提供更优功能的蹩脚解决方案。
例如， 策略模式在绝大部分现代编程语言中可以简单地使用匿名 （lambda） 函数来实现。

#### 低效的解决方案
模式试图将已经广泛使用的方式系统化。 许多人会将这样的统一化认为是某种教条， 他们会 “全心全意” 地实施这样的模式， 而不会根据项目的实际情况对其进行调整。

#### 不当使用
如果你只有一把铁锤， 那么任何东西看上去都像是钉子。
这个问题常常会给初学模式的人们带来困扰： 在学习了某个模式后， 他们会在所有地方使用该模式， 即便是在较为简单的代码也能胜任的地方也是如此。

### 设计模式分类
不同设计模式的复杂程度、 细节层次以及在整个系统中的应用范围等方面各不相同。 我喜欢将其类比于道路的建造： 如果你希望让十字路口更加安全， 那么可以安装一些交通信号灯， 或者修建包含行人地下通道在内的多层互通式立交桥。
最基础的、 底层的模式通常被称为惯用技巧。 这类模式一般只能在一种编程语言中使用。
最通用的、 高层的模式是构架模式。 开发者可以在任何编程语言中使用这类模式。 与其他模式不同， 它们可用于整个应用程序的架构设计。
此外， 所有模式可以根据其意图或目的来分类。 本书覆盖了三种主要的模式类别：

* 创建型模式提供创建对象的机制， 增加已有代码的灵活性和可复用性。
* 结构型模式介绍如何将对象和类组装成较大的结构， 并同时保持结构的灵活和高效。
* 行为模式负责对象间的高效沟通和职责委派。

### [转载来自](https://refactoringguru.cn/)

### [国内信用卡续费 ChatGPT PLUS 的办法](Readme2.md)