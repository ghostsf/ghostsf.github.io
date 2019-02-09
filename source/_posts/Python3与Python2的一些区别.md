title: Python3与Python2的一些区别
categories: 旧文字
tags: [python]
date: 2015-07-30 14:48:00
---
##  一、注意你的Python版本


Python官方网站为http://www.python.org/，当前最新版本为3.4.0 alpha，稳定版本为3.3.2，在3.0版本时，Python的语法改动较大，而网上的不少教程及语法针对的是1.0或者2.0版本的，这样就造成不少初学者按照示例代码来写，但编译都无法通过的问题。

**1、print()函数**

旧的print函数用法为print ‘Hello’，而新的print函数对此改成了print(‘Hello’)并且不再兼容之前版本。

如果在3.X版本上Python上使用旧的print语法，将出现“SyntaxError: invalid syntax”错误。
![16110503-2558412e22ab4cb983e1388710dbfb26.png][1]


**2、raw_input()与input()**

Python3中用input()取代了raw_input()，当然这仅仅是重命名，使用上并没有不同；

**3、比较符号，使用!=替换<>**

**4、repr函数**

使用repr()函数替换``（注：反单引号，位于键盘1的左边一个键），将一个object转换为string，注意repr()与str()略有不同

**5、exec()函数**

exec用来执行存储在字符串或者文件中的Python语句，与JavaScript中的eval()函数类似，新的exec用法为exec(‘print(“Hello”)’)


<!--more-->


## 二、新手常遇到的问题
**1、如何写多行程序？**

相信新手经常会遇到为何对着Python Shell发现程序没法换行，一换行就认为是执行了。这是因为你使用的是Python Shell！你可以点击File->New Window或者Ctrl+N新开一个Python编辑器，这才是代码编辑器，尽情写你的Python程序吧，执行时只需要保存为后缀是.py的文件，然后F5就可以在Python Shell显示执行结果了。

![请输入图片描述][2]

**2、如何执行.py文件？**

直接双击.py文件即可，如果出现不能执行的问题，可能是你没有正确环境变量，在环境变量里找到Path，加上你Python的安装路径，比如C:\Python33\;

**3、and，or，not**

一般的编程语言比较关系运算符都是&&、||以及!，但Python偏偏使用and、or和not来分别代码并且、或者和非，我惊呆了。

**4、True和False**

没错，的确是True，而不是true，Python的这一点也实在令人难以理解，Python语法体系中基本都是小写的语法风格，为什么到这里要使用Pascal命名方式？

## 三、Python的数据结构

**1、列表 List**

声明方式：list=[1,2.3,’x’,'Hello’]，拥有方法：

list.append(x) 在列表尾部添加一项
list.extend(L) 用给定的列表将当前列表接长，append与extend区别见http://hi.baidu.com/wewe39/item/c2599557739ec9dcd48bacf6
list.insert(i,x) 在给定的位置上插入项
list.remove(x) 移除列表中的第一个值为x的项，注意x并非索引
list.pop([i]) 删除给定位置的项并返回
list.index(x) 返回列表中第一个值为x的项索引值，没有匹配项则产生一个错误
list.count(x) 返回列表中x出现的次数
list.sort() 排序
list.reserve() 倒序
遍历示例：

numbers=[0,1,2,3,4,5,6,7,8,9] 
for i in range(len(numbers)): 
    print(i)

**2、元组 Tuple**

声明方式比较特殊：tuple=item1,item2,item3，例：

tuple=12,323.0,0.34,'Hello' 
for i in range(len(tuple)):#遍历 
    print(tuple[i])

**3、集合 Set**

声明方式：set={item1,item2,item3}，例：

basket={'a’,'b','a','c','c’,'d'}

集合为无序不重复的元素集，上例声明的结果将为

{'d', 'a', 'b', 'c'}

遍历方式：

basket={'a','b','a','c','c','d'} 
for i in basket: 
    print(i)

**4、字典 Dict**

声明示例：

tel={'jack':23423,'sape':234}

可使用下述方式进行赋值:

tel['guido']=4127

结果为：{'sape': 234, 'guido': 4127, 'jack': 23423}

可使用items()方法取得键和对应的值，例：

for k,v in tel.items(): 
    print(k,v)

遍历方式：

tel={'jack':23423,'sape':234} 
for key in tel: 
    print(key ,':' , tel[key])


转载自：[walkingp博客][3]


  [1]: http://www.ghostsf.com/usr/uploads/2015/07/3022076672.png
  [2]: http://www.ghostsf.com/usr/uploads/2015/07/2236801938.png
  [3]: http://www.cnblogs.com/walkingp/archive/2013/08/16/3261663.html