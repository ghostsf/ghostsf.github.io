title: Linux Tomcat 输出的日志中文显示乱码的解决方案 - ghostsf
categories: 旧文字
tags: [tomcat]
date: 2016-10-24 02:20:48
---
![Tomcat 输出的日志中文显示乱码的解决方案 - ghostsf][1]

**Linux服务器下，偶然出现一个问题**：

> 在Tomcat中有时输出的日志中文为乱码，包括控制台窗口和输出日志文件中都为乱码。

**分析原因**：
起初我以为是linux系统编码问题，于是查看了想系统是否支持中文。

     more /etc/sysconfig/i18n  

输入此命令即可查看，

    LANG="en_US.UTF-8"
    SYSFONT="latarcyrheb-sun16"

然后发现系统是支持中文的。默认UTF-8，但是如果你看到的是iso-8859-1的编码，那就需要修改下来。

**进一步分析研究解决方案**：
回想之前曾给Tomcat修改了JVM启动参数，联想到`JAVA_OPTS`变量中是可以设置编码默认参数的，于是尝试之。
进到tomcat的bin目录，修改`catalina.sh`文件：
我们可以看到：

    #   JAVA_OPTS       (Optional) Java runtime options used when any command
    #                   is executed.
    #                   Include here and not in CATALINA_OPTS all options, that
    #                   should be used by Tomcat and also by the stop process,
    #                   the version command etc.
    #                   Most options should go into CATALINA_OPTS.

`JAVA_OPTS`变量的参数说明。

这里我们将其设置为：

    JAVA_OPTS='-Dfile.encoding=UTF8 -Dsun.jnu.encoding=UTF8 -server -Xms1024m -Xmx1536m -XX:PermSize=128M -XX:MaxNewSize=256m -XX:MaxPermSize=256m'

若只是解决中文显示问题，只要设置为：

    JAVA_OPTS='-Dfile.encoding=UTF8 -Dsun.jnu.encoding=UTF8'

即可。

后面的设置是用于解决内存溢出问题的，仅供参考。


  [1]: http://www.9553.com/upload/2015/1030/20151030022850505.png