---
title: Could not retrieve transation read-only status server && Communications link failure 异常
copyright: true
date: 2019-11-04 10:46:36
tags: [ "mysql","mybatis" ]
categories: 技术栈
---

上线的项目遇到一个问题。异常信息如下：


``

 SQLException: Could not retrieve transation read-only status server
 
 ......
 
 Caused by: com.mysql.jdbc.exceptions.jdbc4.CommunicationsException: Communications link failure
 
 ``
 
 这两个异常问题，可以联想到的常见问题，无非是事务的问题或者是数据库连接的问题了。
 
 事务方面 检查了mysql的事务隔离级别：
 
 ``
 SHOW VARIABLES LIKE '%iso%';
 ``
 
 返回结果是：
 
 ``
 READ-COMMITTED
 ``
 
 > 当数据库隔离级别为REPEATABLE-READ时，查询一个select语句也算是事物的开始。
 
 那这就不是这个原因导致的了。
 
 再看连接的问题，
 
 看一下数据库时间相关的设置：
 
 ``
 show variables like '%timeout%'
 ``
 
返回结果是：

``

connect_timeout	10

delayed_insert_timeout	300

failover_resend_timeout	

have_statement_timeout	YES

innodb_flush_log_at_timeout	1

innodb_lock_wait_timeout	50

innodb_rollback_on_timeout	OFF

interactive_timeout	7200

lock_wait_timeout	31536000

net_read_timeout	30

net_write_timeout	60

rocksdb_io_write_timeout	0

rocksdb_lock_wait_timeout	2

rpl_semi_sync_master_timeout	10000

rpl_semi_sync_slave_kill_conn_timeout	5

rpl_stop_slave_timeout	31536000

slave_net_timeout	60

thread_pool_idle_timeout	60

tokudb_last_lock_timeout	

tokudb_lock_timeout	4000

tokudb_lock_timeout_debug	1

wait_timeout	7200

``

这也没什么问题。再多也不合理。

那可能就是本事mysql的驱动的问题了。

检查了下版本。再查了下，对应版本关系。

[https://dev.mysql.com/doc/connector-j/5.1/en/connector-j-versions.html](https://dev.mysql.com/doc/connector-j/5.1/en/connector-j-versions.html)

[https://dev.mysql.com/doc/connector-j/8.0/en/connector-j-versions.html](https://dev.mysql.com/doc/connector-j/8.0/en/connector-j-versions.html)

官网瞄一眼

emmm，看到5.1的版本里有个Note

> MySQL Connector/J 8.0 is highly recommended for use with MySQL Server 8.0, 5.7, and 5.6. Please upgrade to MySQL Connector/J 8.0.

那还说啥，升级到8.0咯

然后更新升级了上去，然后没问题了 ...

Happy ending.

