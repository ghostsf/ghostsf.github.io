title: openjdk和jdk的区别
categories: 
tags: []
date: 2016-01-07 05:23:52
---
使用过LINUX的人都应该知道，在大多数LINUX发行版本里，内置或者通过软件源安装JDK的话，都是安装的openjdk,那么到底什么是openjdk，它与sun jdk有什么关系和区别呢？
历史上的原因是，openjdk是jdk的开放原始码版本，以GPL协议的形式放出。在JDK7的时候，openjdk已经成为jdk7的主干开发，sun jdk7是在openjdk7的基础上发布的，其大部分原始码都相同，只有少部分原始码被替换掉。使用JRL(JavaResearch License，Java研究授权协议)发布。
至于openjdk6则更是有其复杂的一面，首先是openjdk6是jdk7的一个分支，并且尽量去除Java SE7的新特性，使其尽量的符合Java6的标准。
关于JDK和OpenJDK的区别，可以归纳为以下几点：
授权协议的不同：
openjdk采用GPL V2协议放出，而JDK则采用JRL放出。两者协议虽然都是开放源代码的，但是在使用上的不同在于GPL V2允许在商业上使用，而JRL只允许个人研究使用。
OpenJDK不包含Deployment（部署）功能：
部署的功能包括：Browser Plugin、Java Web Start、以及Java控制面板，这些功能在Openjdk中是找不到的。
OpenJDK源代码不完整：
这个很容易想到，在采用GPL协议的Openjdk中，sun jdk的一部分源代码因为产权的问题无法开放openjdk使用，其中最主要的部份就是JMX中的可选元件SNMP部份的代码。因此这些不能开放的源代码将它作成plug，以供OpenJDK编译时使用，你也可以选择不要使用plug。而Icedtea则为这些不完整的部分开发了相同功能的源代码(OpenJDK6)，促使OpenJDK更加完整。
部分源代码用开源代码替换：
由于产权的问题，很多产权不是SUN的源代码被替换成一些功能相同的开源代码，比如说字体栅格化引擎，使用Free Type代替。
openjdk只包含最精简的JDK：
OpenJDK不包含其他的软件包，比如Rhino Java DB JAXP……，并且可以分离的软件包也都是尽量的分离，但是这大多数都是自由软件，你可以自己下载加入。
不能使用Java商标：
这个很容易理解，在安装openjdk的机器上，输入“java -version”显示的是openjdk，但是如果是使用Icedtea补丁的openjdk，显示的是java。（未验证）
总之，在Java体系中，还是有很多不自由的成分，源代码的开发不够彻底，希望Oracle能够让JCP更自由开放一些，这也是所有Java社区所希望的。 