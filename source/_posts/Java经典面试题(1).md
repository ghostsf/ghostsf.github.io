title: Java经典面试题(1)
categories: 技术栈
tags: [java,面试题]
date: 2015-08-21 09:22:00
---
题目:
a = 123；
b = 321；
要求不使用第三个变量，让两个值换位
a = 321；
b = 123；

方法：
(1) 

    a=b+(b=a)*0;

(2) 


        a=a^b;
        b=a^b;
        a=a^b;

(3)(当然相比2还是用抑或的好)

        a=a+b;
        b=a-b;
        a=a-b;
      
