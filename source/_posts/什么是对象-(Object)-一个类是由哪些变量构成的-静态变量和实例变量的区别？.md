title: 什么是对象 (Object)?一个类是由哪些变量构成的?静态变量和实例变量的区别？
categories: 旧文字
tags: [java]
date: 2015-10-18 05:20:56
---
**什么是对象 (Object)?**
 - 对象是程序运行时的实体
 - 它的状态存储在 fields (也就是变量)
 - 行为是通过方法 (method) 实现的
 - 方法上操作对象的内部的状态
 - 方法是对象对对象的通信的主要手段

**一个类是由哪些变量构成的?**
 - Local variable 本地变量
 - instance variables 实例变量
 - class variables 类变量

Local variable
在方法体, 构造体内部定义的变量 在方法结束的时候就被摧毁
instance variables
在类里但是不在方法里 在类被载入的时候被实例化
class variables
在类里但在方法外, 加了 static 关键字. 也可以叫做静态变量

**静态变量和实例变量的区别？**


<!--more-->


在语法定义上的区别：静态变量前要加static关键字，而实例变量前则不加。
在程序运行时的区别：实例变量属于某个对象的属性， 必须创建了实例对象(比如 new 一个)， 其中的实例变量才会被分配空间， 才能使用这个实例变量. 静态变量不属于某个实例对象， 而是属于类， 所以也称为类变量， 只要程序加载了类的字节码， 不用创建任何实例对象, 静态变量就会被分配空间, 静态变量就可以被使用了.
总之，实例变量必须创建对象后才可以通过这个对象来使用，静态变量则可以直接使用类名来引用.
例如, 对于下面的程序, 无论创建多少个实例对象, 永远都只分配了一个staticVar变量, 并且每创建一个实例对象, 这个staticVar就会加; 但是, 每创建一个实例对象, 就会分配一个instanceVar, 即可能分配多个instanceVar, 并且每个instanceVar的值都只自加了1次.

    public class VariantTest{
            public static int staticVar = 0;
            public int instanceVar = 0;
            public VariantTest(){
                   staticVar++;
                   instanceVar++;
                   System.out.println(“staticVar=” + staticVar + ”,instanceVar=”+ instanceVar);
            }
    }


