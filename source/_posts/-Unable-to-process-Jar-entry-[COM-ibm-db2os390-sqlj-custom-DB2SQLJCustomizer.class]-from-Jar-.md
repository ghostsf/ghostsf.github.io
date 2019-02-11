title:  Unable to process Jar entry [COM/ibm/db2os390/sqlj/custom/DB2SQLJCustomizer.class] from Jar 
categories: 技术栈
tags: [db2]
date: 2016-05-11 03:16:02
---
在IBM的解决方案里看到了 [SOME CLASS FILES IN DB2JCC.JAR (JCC DRIVER) ARE CORRUPT][1] 
同时我在搞一个项目的时候也遇到了这个问题，那么就来写下解决方案吧。

     Unable to process Jar entry [COM/ibm/db2os390/sqlj/custom/DB2SQLJCustomizer.class] from Jar 

遇到这个问题，可以这么解决：
tomcat 7.0 + 可以修改下 \conf\catalina.properties文件
找到`tomcat.util.scan.DefaultJarScanner.jarsToSkip`，可以看到里面已经默认添加了很多跳过扫描的jar包，我们可以在里面添加一个 `db2jcc.jar` ，按照格式前面加上`,\`
然后重新启动tomcat，可以解决这个问题。


<!--more-->

当然，也可以看下IBM给的解决方案。[SOME CLASS FILES IN DB2JCC.JAR (JCC DRIVER) ARE CORRUPT][2] 


  [1]: http://www.ghostsf.com/prose/283.html
  [2]: http://www.ghostsf.com/prose/283.html
