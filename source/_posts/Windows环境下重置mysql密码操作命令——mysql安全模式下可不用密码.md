title: Windows环境下重置mysql密码操作命令——mysql安全模式下可不用密码
categories: 技术栈
tags: [mysql]
date: 2015-07-24 10:01:00
---
1、首先停止正在运行的MySQL进程 
>net stop mysql 

2、以安全模式启动MySQL 
进入mysql目录在命令行下运行 
>mysqld.exe --skip-grant-tables 

3、完成以后就可以不用密码进入MySQL了 
>mysql -u root -p 
提示输入密码时直接回车即可。 

4、更改密码 
>use mysql 
>update user set Password=password('新密码') where User='root'; 
>flush privileges; 

5、启动MySQL服务 
>net start mysql 
