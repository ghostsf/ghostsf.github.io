title: php连接mysql出现safe mode in effect errors的原因和解决方案
categories: 
tags: []
date: 2016-10-23 14:28:05
---
其原因是为何呢？ 大概如下

> If you have any mysql connection errors and received error with cpanel
> user name authentication errors. If sql.safe_mode is enabled,
> mysql_connect() and mysql_pconnect() ignore any arguments passed to
> them. Instead, PHP attempts to connect using the following details:
> 
> host: local host user: the user PHP runs as password: an empty string
> (“”)

也就是说启用它之后，PHP源码里不会出现数据库用户名与密码，这样源码外泄也不会暴露数据库用户信息。但是它有一点局限性，就是只能用无密码的root用户登。

其解决方案是什么呢？
将PHP配置文件php.ini里面的sql.safe_mode关闭即可

    sql.safe_mode  = Off