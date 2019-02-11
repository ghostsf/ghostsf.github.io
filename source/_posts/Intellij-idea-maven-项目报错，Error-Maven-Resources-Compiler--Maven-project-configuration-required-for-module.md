layout: false
title: Intellij idea maven 项目报错，Error Maven Resources Compiler Maven project configuration required for module
categories: 技术栈
tags: [idea,maven]
date: 2017-03-07 14:53:27
---
    Error:Maven Resources Compiler: Maven project configuration required for module 'ghostsf' isn't available. Compilation of Maven projects is supported only if external build is started from an IDE.

IDEA在项目构建的时候时候出现这个问题。这个项目之前是在一个低版本的IDEA上开发的。所以ghostsf自然地想到了应该是IDEA版本的问题。那么跟IDEA版本有之间关系的，那就是.idea这个文件夹了。
所以这个问题的解决方案就是，删掉.idea这个文件夹，然后重新构建项目即可。

这时候IDEA就会为你重新搞之~
