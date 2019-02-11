title: sqlite报no such table或者library routine called out of sequence，最容易忽视的问题 - ghostsf
categories: 技术栈
tags: [sqlite]
date: 2016-12-24 17:35:52
---
最近搞了下sqlite，遇到了一些问题，常见的比如no such table或者library routine called out of sequence。
如果说具体问题具体分析的话，那倒是好办的，按照报错信息，简单排查即可。
但是问题是，事实并不会如sqlite的报错提示一样，当然这要并不能怪sqlite。
那么此类报错信息，最容易忽视的错误原因是什么呢？
那就是，db文件是否读取到了（也有可能是文件权限问题）。
在程序中数据库文件使用了相对路径，如“ghostsf.db”,但是在执行过程中可能因为打开新的对话框或者其他程序调用，改变了当前路径，所以就会导致原来的ghostsf.db找不到了， 报No Such Table的错误。
解决办法:
1、写上db文件的绝对路径
2、动态获取数据库db文件的绝对路径

By the way ，为了sqlite数据库文件的安全性，一个可以通过服务器设置相关屏蔽.db文件的规则，再一个是可以修改.db文件为后台程序脚本文件，如.db.php，再用代码做相关处理，这样可以有效地保护好数据文件的安全。

By ghostsf
