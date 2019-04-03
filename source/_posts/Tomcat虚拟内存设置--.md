title: Tomcat虚拟内存设置  
categories: 技术栈
tags: []
date: 2016-08-01 02:59:00
---
在生产环境中tomcat内存设置不好很容易出现内存溢出。造成内存溢出是不一样的，当然处理方式也不一样。这里根据平时遇到的情况和相关资料进行一个总结。常见的一般会有下面三种情况：

　　1.OutOfMemoryError： Java heap space
　　2.OutOfMemoryError： PermGen space
　　3.OutOfMemoryError： unable to create new native thread.

Tomcat内存溢出解决方案
　　对于前两种情况，在应用本身没有内存泄露的情况下可以用设置tomcat jvm参数来解决。（-Xms -Xmx -XX：PermSize -XX：MaxPermSize）
　　最后一种可能需要调整操作系统和tomcat jvm参数同时调整才能达到目的。
　　第一种：是堆溢出。
　　原因分析：
JVM堆的设置是指java程序运行过程中JVM可以调配使用的内存空间的设置.JVM在启动的时候会自动设置Heap size的值，其初始空间(即-Xms)是物理内存的1/64，最大空间(-Xmx)是物理内存的1/4。可以利用JVM提供的-Xmn -Xms -Xmx等选项可进行设置。Heap size 的大小是Young Generation 和Tenured Generaion 之和。
在JVM中如果98％的时间是用于GC且可用的Heap size 不足2％的时候将抛出此异常信息。
Heap Size 最大不要超过可用物理内存的80％，一般的要将-Xms和-Xmx选项设置为相同，而-Xmn为1/4的-Xmx值。
　　没有内存泄露的情况下，调整-Xms -Xmx参数可以解决。
　　**-Xms：初始堆大小
　　-Xmx：最大堆大小**
　　但堆的大小受下面三方面影响：
　　1.相关操作系统的数据模型（32-bt还是64-bit）限制；（32位系统下，一般限制在1.5G~2G；我在2003 server 系统下（物理内存：4G和6G，jdk：1.6）测试 1612M，64位操作系统对内存无限制。）
　　2.系统的可用虚拟内存限制；
　　3.系统的可用物理内存限制。
　　堆的大小可以使用 java -Xmx***M version 命令来测试。支持的话会出现jdk的版本号，不支持会报错。
　　-Xms -Xmx一般配置成一样比较好比如set JAVA_OPTS= -Xms1024m -Xmx1024m其初始空间(即-Xms)是物理内存的1/64，最大空间(-Xmx)是物理内存的1/4。可以利用JVM提供的-Xmn -Xms -Xmx等选项可
进行设置


实例，以下给出1G内存环境下java jvm 的参数设置参考：
服务器为1G内存：

JAVA_OPTS="-server -Xms800m -Xmx800m -XX:PermSize=64M -XX:MaxNewSize=256m -XX:MaxPermSize=128m -Djava.awt.headless=true "
服务器为64位、2G内存:

JAVA_OPTS='-server -Xms1024m -Xmx1536m -XX:PermSize=128M -XX:MaxNewSize=256m -XX:MaxPermSize=256m'

 

=============================================================



前提：是执行startup.bat启动tomcat的方式
Linux服务器：
在/usr/local/apache-tomcat-5.5.23/bin 目录下的catalina.sh
添加：JAVA_OPTS='-Xms512m -Xmx1024m'
或者 JAVA_OPTS="-server -Xms800m -Xmx800m   -XX:MaxNewSize=256m"
或者 CATALINA_OPTS="-server -Xms256m -Xmx300m"


Windows服务器：
在/apache-tomcat-5.5.23/bin 目录下的catalina.bat
添加：set JAVA_OPTS=-Xms128m -Xmx350m
或者   set CATALINA_OPTS=-Xmx300M -Xms256M
（区别是一个直接设置jvm内存，另一个设置tomcat内存，CATALINA_OPTS似乎可以与JAVA_OPTS不加区别的使用）

<!--more-->


转载自[LoveLife][1]


  [1]: http://xiejiasheng.blog.163.com/blog/static/174825457201337113217278/
