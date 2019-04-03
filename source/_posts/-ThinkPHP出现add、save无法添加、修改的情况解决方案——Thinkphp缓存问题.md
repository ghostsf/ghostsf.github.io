title:  ThinkPHP出现add、save无法添加、修改的情况解决方案——Thinkphp缓存问题
categories: 技术栈
tags: [thinkphp]
date: 2016-04-12 06:37:07
---
近期开发PHP程序，出现部分修改操作没有执行成功。程序走了修改操作，但是数据库里的数据根本没有改。
于是首先排除了自己代码的问题，然后想到了可能是TP的缓存问题。研究了下TP本身的Model映射机制，然后发现了Runtime/Data/_fields/下的缓存文件。
然后，清空了Runtime/Data/_fields/下的所有缓存文件，系统恢复正常，save和add运行OK。
