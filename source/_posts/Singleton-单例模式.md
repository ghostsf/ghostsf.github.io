title: Singleton 单例模式
categories: 技术栈
tags: [java,单例模式]
date: 2015-10-18 05:26:25
---
> Java中单例模式定义：“一个类有且仅有一个实例，并且自行实例化向整个系统提供。”

    public class Singleton {
        private Singleton() {
            // do something
        }
        private static class SingletonHolder {
            private static final Singleton INSTANCE = new Singleton();
        }
        public static final Singleton getInstance() {
            return SingletonHolder.INSTANCE;
        }
    }

注意点：
 1. 单例模式的类只提供私有的构造函数
 2. 类定义中含有一个该类的静态私有对象
 3. 该类提供了一个静态的公有的函数用于创建或获取它本身的静态私有对象。


----------


**By the way：**
**Singleton 优雅版本**

    public enum Singleton{
       INSTANCE;
    }

用枚举。通过EasySingleton.INSTANCE来访问。默认枚举实例的创建是线程安全的，所以不需要担心线程安全的问题。但是在枚举中的其他任何方法的线程安全由程序员自己负责。还有防止上面的通过反射机制调用私用构造器。
这个版本基本上消除了绝大多数的问题。代码也非常简单，实在无法不用。这也是新版的《Effective Java》中推荐的模式。


<!--more-->


更多关于Singleton单例模式可参阅 [深入浅出单实例Singleton设计模式 | 酷壳 - CoolShell.cn][1]


  [1]: http://coolshell.cn/articles/265.html
