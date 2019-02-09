title: css如何使div里面的多行文字垂直居中 
categories: 旧文字
tags: [css]
date: 2015-07-16 17:21:00
---
1、如果是单行文字想垂直居中，只要保证div高和行高保持一致，就可以了；
　　用下面的代码即可实现：
　　代码如下：

2、如果是多行文字，上面的垂直居中的方法就不行了，得用变通的方法实现；这里建议使用table方法，在table外面再套上相应的div；
　　代码如下：
  `` <table>
　　<tr>
　　<td style="vertical-align:middle;height:300px;background-color:red"></td>
　　</tr>
　　</table>
``
<!--more-->


3、多行文字居中还有另外一种方法：
　　多行内容居中，且容器高度可变，也很简单，给出一致的 padding-bottom 和 padding-top 就行：

　　.middle-demo-2
　　{
　　padding-top: 24px;
　　padding-bottom: 24px;
　　} 


