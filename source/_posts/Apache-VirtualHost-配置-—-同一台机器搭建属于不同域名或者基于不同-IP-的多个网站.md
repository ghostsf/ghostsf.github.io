title: Apache VirtualHost 配置 — 同一台机器搭建属于不同域名或者基于不同 IP 的多个网站
categories: 旧文字
tags: [apache]
date: 2016-06-22 08:56:00
---
> 虚拟主机(Virtual Host) 是在同一台机器搭建属于不同域名或者基于不同 IP 的多个网站服务的技术.
> 可以为运行在同一物理机器上的各个网站指配不同的 IP 和端口, 也可让多个网站拥有不同的域名. Apache 是世界上使用最广的 Web
> 服务器, 从 1.1 版开始支持虚拟主机. 本文将讲解在不同服务器 (Redhat Enterprise Linux, Ubuntu
> Linux, Windows) 上使用 Apache 搭建虚拟主机来搭建多个网站.

**Redhat Enterprise Linux**

Redhat EnterpriseLinux (包括 CentOS Linux), 是使用最广的 Linux 服务器, 大量的网站应用都部署在其上.
1. 打开文件 /etc/httpd/conf/httpd.conf, 搜索VirtualHost example, 找到代码如下:

    #VirtualHost example:
    #Almost any Apache directive may go into a VirtualHost container.
    #The first VirtualHost section is used for requests without a known
    #server name.
    #
    #<VirtualHost *:80>
    #ServerAdmin webmaster@dummy-host.example.com
    #DocumentRoot /www/docs/dummy-host.example.com
    #ServerName dummy-host.example.com
    #ErrorLog logs/dummy-host.example.com-error_log
    #CustomLog logs/dummy-host.example.com-access_log common
    #</VirtualHost>

2. 仿照例子, 添加一段代码来指定某一域名的网站.

    #
    #DocumentRoot 是网站文件存放的根目录
    #ServerName 是网站域名, 需要跟 DNS 指向的域名一致
    #

    <VirtualHost *:80>
        ServerAdmin webmaster@ghostsf.com
        DocumentRoot /var/www/httpdocs/ghostsf.com
        ServerName ghostsf.com
        ErrorLog logs/ghostsf.com-error.log
        CustomLog logs/ghostsf.com-access.log common
    </VirtualHost>

3. 重启 httpd 服务, 执行以下语句.

    service httpd restart

**Ubuntu Linux**

Ubuntu 在 Linux 各发行版中, 个人用户数量最多的. 很多人在本机和虚拟机中使用. 但 Ubuntu 和 Redhat 的 VirtualHost 设置方法不相同.
1. 打开目录 /etc/apache2/sites-available/, 发现default 和 default-ssl 两个文件, 其中 default 是 http 虚拟主机服务的配置文件, default-ssl 是配置 https 服务使用的. 可以复制一份 default 文件. 并修改配置文件名, 文件名必须与域名一致 (如: demo.neoease.com)
2. 打开新建的配置文件, 修改 DocumentRoot, ServerName 和对应的配置目录. 例子如下:

     #DocumentRoot 是网站文件存放的根目录
        #ServerName 是网站域名, 需要跟 DNS 指向的域名一致
        #
        <VirtualHost *:80>
            ServerAdmin webmaster@dummy-host.example.com
            DocumentRoot /var/www/httpdocs/demo_neoease_com
            ServerName demo.neoease.com
            ErrorLog ${APACHE_LOG_DIR}/demo.neoease.com-error.log
            CustomLog ${APACHE_LOG_DIR}/demo.neoease.com-access.log combined
        </VirtualHost>

3. 通过 a2ensite 激活虚拟主机配置

    sudo a2ensite demo.neoease.com

4. 打开目录 /etc/apache2/sites-enabled/, 你会发现所有激活的虚拟主机, 可以通过 a2dissite 进行注销

    sudo a2dissite demo.neoease.com

5. 重启 Apache 服务, 激活虚拟主机

    sudo /etc/init.d/apache2 restart

**Windows**


<!--more-->


Windows 是市场占有率最高的 PC 操作系统, 也是很多人的开发环境. 其 VirtualHost 配置方法与 Linux 上有些差异, 以下方式适合原生 Apache, XAMPP 和WAMP 套件.
1. 打开目录 {Apache2 安装目录}\conf\extra\, 找到 httpd-vhosts.conf 文件.
2. 仿照例子, 添加一段代码来指定某一域名的网站.

    #DocumentRoot 是网站文件存放的根目录
    #ServerName 是网站域名, 需要跟 DNS 指向的域名一致
    #
    <VirtualHost *:80>
        ServerAdmin webmaster@dummy-host.example.com
        DocumentRoot "D:/workspace/php/demo_neoease_com"
        ServerName demo.neoease.com
        ErrorLog "logs/demo.neoease.com-error.log"
        CustomLog "logs/demo.neoease.com-access.log" common
    </VirtualHost>

3. 打开 httpd.conf 文件, 添加如下语句.

    #Virtual hosts
    Include conf/extra/httpd-vhosts.conf

4. 重启 Apache 服务.

**Mac OS**

近年苹果的雄起, 让 Mac 日催普及, 也成为很多开发人员的选择. 因为与 Linux 同源, 配置方法也相似.
1. 打开文件 /private/etc/apache2/extra/httpd-vhosts.conf.
2. 仿照例子, 添加一段代码来指定某一域名的网站.

    #
    #DocumentRoot 是网站文件存放的根目录
    #ServerName 是网站域名, 需要跟 DNS 指向的域名一致
    #
    <VirtualHost *:80>
        ServerAdmin webmaster@dummy-host.example.com
        DocumentRoot "/usr/docs/httpdocs/demo_neoease_com"
        ServerName demo.neoease.com
        ErrorLog "/private/var/log/apache2/demo.neoease.com-error_log"
        CustomLog "/private/var/log/apache2/demo.neoease.com-access_log" common
    </VirtualHost>

3. 打开文件 /private/etc/apache2/httpd.conf, 搜索Virtual hosts, 找到代码如下:

    #Virtual hosts
    #Include /private/etc/apache2/extra/httpd-vhosts.conf

去掉前面的注释符号 #, 保存文件.
4. 重启 apache 服务, 执行以下语句.

    sudo apachectl restart
