title: 接口 Interface
categories: 技术栈
tags: [java]
date: 2015-10-21 04:56:00
---
> 接口是抽象方法的集合。一个类实现一个或多个接口，因此继承了接口的抽象方法.

**接口的特点**
 - 不能实例化
 - 没有构造体
 - 所有方法都是抽象的 public static

**接口和抽象的区别**

 - 抽象类可以有构造方法 接口不行
 - 抽象类可以有普通成员变量 接口没有
 - 抽象类可以有非抽象的方法 接口必须全部抽象
 - 抽象类的访问类型都可以 接口只能是 public abstract
 - 一个类可以实现多个接口 但只能继承一个抽象类

**基础概念题**
下面哪一项说法是正确的
1. 在一个子类里,一个方法不是 public 就不能重载
2. 覆盖一个方法只需要满足相同的方法名和参数类型
3. 覆盖一个方法必须方法名,参数和返回类型都相同
4. 一个覆盖的方法必须有相同的方法名,参数名和参数类型

> 答案 3

覆盖函数与被覆盖函数只有函数体不同

下面哪一项说法是错误的

1. 重载函数的函数名必须相同
2. 重载函数必须在参数个数或类型上有所不同
3. 重载函数的返回值必须相同
4. 重载函数的函数体可以不同

> 答案 3

函数的重载与函数的返回值无关

下面哪一项说法是正确的

1. 静态方法不能被覆盖
2. 静态方法不能被声明称私有
3. 私有方法不能被重载
4. 一个重载的方法在基类中不通过检查不能抛出异常

> 答案 1

----------

**基础程序题**


<!--more-->


题目一

    class Base{}
    
    class Agg extends Base{
        public String getFields(){
            String name = "Agg";
            return name;
        }
    }
    
    public class Avf{
        pulic static void main(String argv[]){
            Base a = new Agg();
            //here
        }
    }

下面哪个选项的代码替换到//here会调用getFields方法,使出书结果是

A. System.out.println(a.getFields());
B. System.out.println(a.name);
C. System.out.println((Base)a.getFields());
D. System.out.println(((Agg)a).getFields());

> 答案 D
> 
> Base 类要引用 Agg 类的实例需要把 Base 类显示地转换成 Agg 类,然后调用 Agg 类中的方法. 如果 a 是 Base
> 类的一个实例,是不存在这个方法的,必须把 a 转换成 Agg 的一个实例

题目二

    class A{
    
        public A(){
            System.out.println("A");
        }
    }
    
    public class B extends A{
    
        public B(){
            System.out.println("B");
        }
    
        public static void main(String[] args){
            A a = new B();
            a = new A();
        }
    }

> 输出结果是 A B A

题目三

    class A{
        public void print(){
            System.out.println("A");
        }
    }
    
    class B extends A{
        public void print(){
            System.out.println("B");
        }
    }
    
    public class Test{
        ..
        B objectB = new B();
        objectB.print();
    
        A as = (A) objectB;
        as.print();
    
        A asg = objectB;
        asg.print();
    
        as = new A();
        as.print();
        ..
    }

> 输出为 B B B A

题目四

    public class Test {
        public static void main(String[] args){
            Father father = new Father();
            Father child = new Child();
            System.out.println(father.getName());
            System.out.println(child.getName());
        }
    }
    
    class Father{
        public static String getName(){
            return "Father";
        }
    }
    
    class Child extends Father{
        public static String getName(){
            return "Child";
        }
    }

> 输出是 Father Father 因为这里的方法 getName 是静态的. 具体执行哪一个,则要看是由哪个类来调用的.

