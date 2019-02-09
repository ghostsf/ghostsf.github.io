title: php-mysql-解决mysql_connect()方法弃用的问题
categories: 旧文字
tags: [php,mysql,mysqli]
date: 2015-08-19 18:50:05
---
有段时间没怎么用php了，新装了php环境，版本5.5的。
跑数据库的时候发现，mysql_connect()这个方法竟然被deprecated了：

> Deprecated: mysql_connect(): The mysql extension is deprecated and
> will be removed in the future: use mysqli or PDO instead in

这意思很明显了，说mysql_connect将在未来弃用，请你使用mysqli或者PDO来替代。

**解决方案一：**
在php程序代码里面设置报警级别

    error_reporting(E_ALL ^ E_DEPRECATED);

**解决方案二：**
就是使用mysqli啦

    $link = mysql_connect('localhost', 'user', 'password');

改成mysqi

    $link = mysqli_connect('localhost', 'user', 'password', 'dbname');


更多关于mysqli可以参考：
[php中关于mysqli和mysql区别的一些知识点分析][1]


  [1]: http://www.jb51.net/article/28103.htm