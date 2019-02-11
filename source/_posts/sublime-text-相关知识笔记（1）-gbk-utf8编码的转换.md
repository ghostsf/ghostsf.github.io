title: sublime text 相关知识笔记（1） gbk-utf8编码的转换
categories: 技术栈
tags: [sublime]
date: 2015-08-27 05:49:59
---
最近有朋友问我sublime text怎么用，老是觉得用不起来。于是我就想简单弄些笔记，记录一些点，来帮助大家使用sublime。

使用过sublime的都知道，sublime有很多优秀的插件支持，并且配置起来也是很方便，一般都是json的配置文件直接可以修改插件配置。

下面介绍下sublime编码的一些问题：
Sublime Text默认是只支持UTF8的编码，所以有些时候，当我们打开GBK文件时候，文件会出现乱码。
注意看下sublime下面的状态栏，一般都会显示当前文件是什么编码格式的。

要解决这个问题很简单，还需要安装一个CovertToUTF8的插件即可。

安装插件的方式也很方便：

> 1.按Ctrl+Shift+P 呼出命令框
> 2.在命令框里输入install package 即可（或者直接输入一个字母i就行了，sublime帮你找到你要的命令）
> 3.然后你就会看到插件安装的窗口了，这里输入CovertToUTF8即可(或者直接输入utf8)，然后选择安装。

这时注意看sublime下方的状态栏，当前的gbk文件正在转换为utf8编码显示，等一小会儿，就可以正常显示了，不再是乱码了。
就是这么easy。

[Ghostsf博客 Do what i love and just do it !][1]


  [1]: http://www.ghostsf.com
