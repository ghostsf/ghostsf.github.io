layout: false
title: MySQL Access denied for user ‘root’@’localhost’ (using password YES)问题的解决方案
categories: 旧文字
tags: [mysql]
date: 2015-10-14 15:16:14
---
> #mysql -u root -p  提示"Access denied for user ‘root’@’localhost’ (using password: YES)"

默认的localhost没有映射到127.0.0.1？试试#mysql -u root -p xxxx -h 127.0.0.1，可以登录。 
那就是给'root'@'localhost'和'root'@'ip'授权的问题了。 
grant all privileges on . to 'root'@'localhost' identified by 'mypassword' with grant option; 
grant all privileges on . to 'root'@'127.0.0.1' identified by 'mypassword' with grant option;

**mysql -h localhost和mysql -h 127.0.0.1的区别**
通过localhost连接到mysql是使用UNIX socket，而通过127.0.0.1连接到mysql是使用TCP/IP。
看看状态： 


<!--more-->


    mysql -h localhost > status 
    Connection id:     639 
    Current database: mysql 
    Current user:   root@localhost 
    SSL:           Not in use 
    Current pager: stdout 
    Using outfile:        ” 
    Using delimiter:    ; 
    Server version:     5.6.15-log Source distribution 
    Protocol version: 10 
    Connection:    Localhost via UNIX socket
    
    mysql -h 127.0.0.1 > status 
    Connection id:     640 
    Current database: mysql 
    Current user:   root@localhost 
    SSL:           Not in use 
    Current pager: stdout 
    Using outfile:        ” 
    Using delimiter:    ; 
    Server version:     5.6.15-log Source distribution 
    Protocol version: 10 
    Connection:   127.0.0.1 via TCP/IP
