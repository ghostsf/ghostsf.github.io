title: tomcat配置虚拟目录映射
categories: 旧文字
tags: [tomcat]
date: 2015-08-29 03:50:04
---
**在Server.xml中进行配置**
 
在<Host>元素中添加子元素<Context path=" ...  "     docBase=" ... "/> 并重启服务器即可；
path表示虚拟目录，docBase表示真实的web应用所在目录；
比如在C盘中存在a这个web应用,则 <Context path="/test" docBase="C:\a"/>
则输入 http://localhost:8888/test/1.html 就能访问到a文件夹下的 1.html
 
注意：这种方法需要重启服务器才能够生效，所以不适用，因为每次添加一个web应用都需要重启服务器。
 
 
**最佳配置方法**
 
$CATALINA_BASE/conf/catalina/localhost/ 文件夹下创建一个xml文件，任意文件名都可以，但是此文件名是web应用发布后的虚拟目录；
比如创建一个test.xml ，在文件中添加 <Context docBase="C:\a"/>
不需要重启服务器，只需要在浏览器中输入 http://localhost:8888/test/1.html 即可访问C:\a\1.html   ；
 
**配置默认web应用**
 
一般，输入 http://localhost:8080 后都会跳出 tomcat的主页，因为这个tomcat的web应用就是默认的web应用，如果想将自己的web应用配置成默认的web应用，只需要在Server.xml中的<Context>元素中为 <Context path="" docBase="C:\a"/> 
或者将test.xml改成 ROOT.xml 即可；
输入 http://localhost:8080/1.html 就能访问C:\a\1.html ;