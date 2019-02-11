title: LDAP是什么？
categories: 技术栈
tags: []
date: 2015-12-21 02:07:34
---
LDAP的 英文全称是Lightweight Directory Access Protocol，一般都简称为LDAP。它是基于X.500标准的，但是简单多了并且可以 根据需要定制。与X.500不同，LDAP支持TCP/IP，这对访问Internet是必须的。LDAP的核心规范在RFC中都有定义，所有与LDAP相关的 RFC都可以在LDAPman RFC网页中找到。现在LDAP技术不仅发展得很快而且也是激动人心的。在企业范围内实现LDAP可以让运行在几乎所有计算机平台上的 所有的应用程序从 LDAP目 录中获取信息。LDAP目 录中可以存储各种类型的数据：电子邮件地址、邮件路由信息、人力资源数据、公用密匙、联系人列表，等等。通过把 LDAP目录作为系统集成中的一个重要环节，可 以简化员工在企业内部查询信息的步骤，甚至连主要的数据源都可以放在任何地方。

CN,OU,DC都是LDAP连接服务器的端字符串中的区别名称 （DN,distinguished name）;
LDAP连接服务器的连接字串格式为：ldap://servername/DN   
   其中DN有三个属性，分别是CN,OU,DC   
   LDAP是一种通讯协议，如同HTTP是一种协议一样的！
在 LDAP 目录中。           
    DC     (Domain     Component)       
    CN     (Common     Name)       
    OU     (Organizational     Unit)       
    An     LDAP     目录类似于文件系统目录

例如：cn=test,ou=技术部,ou=公司,dc=domain,dc=com
