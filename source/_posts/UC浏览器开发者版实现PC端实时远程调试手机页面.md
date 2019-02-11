title: UC浏览器开发者版实现PC端实时远程调试手机页面
categories: 技术栈
tags: [uc浏览器开发者版,pc端调试手机网页]
date: 2015-09-13 17:04:00
---
目前，在手机上使用浏览器访问网页，无法便捷地进行网页语言调试。手机屏幕相对较小且操作不便，直接在手机上进行网页数据调试不太现实。
因此，UC使用技术将手机网页调试信息分离，实现一种能在大屏幕、高配置PC上来调试小屏幕、低配置的手机浏览器访问的网页的开发工具——RemoteInspector（简称RI）。

Android平台UC浏览器开发者版，主要支持以下功能：

 1. 列表项目
 2. DOM查看和修改
 3. JavaScript调试、CSS调试
 4. 网络状态查看
 5. 资源文件查看
 6. Console控制台

**连接模式**
有两种方式
1.PC和手机在同一局域网中可以通过ip地址进行访问。如果出现访问不了的情况，可将PC端的防火墙关闭。若PC端ping不通手机ip注意检查下本地hosts文件是否异常。
2.PC端下载[ADB工具][1]，同时android手机上注意打开开发者调试模式。搭建好AndroidSDK开发环境或安装好adb工具后，通过adb命令进行端口映射。

    在Windows命令提示符窗口（cmd.exe）运行：adbforwardtcp:9998tcp:9998

**调试方式**
在手机上启动UC浏览器开发者版，并打开需要调试的页面。在PC上打开Chrome或Safari或者UC 电脑版浏览器
若是Wi-Fi连接模式，则在地址栏输入：手机IP+:9998
例，手机IP为192.168.112.244，则输入192.168.112.244:9998。
选择确定，允许调试，即可。

若是USB连接模式，则在地址栏输入：http://localhost:9998，确定允许调试。

这样就可以进行实时的远程调试了，再电脑上进行页面的前端相关的调试，会在手机端的UC开发者浏览器上得到实时的调试反馈。
这是一件蛮爽的事情。

当然也有人在使用[weinre][2]啦。

> weinre is WEb INspector REmote. Pronounced like the word "winery". Or
> maybe like the word "weiner". Who knows, really. weinre is a debugger
> for web pages, like FireBug (for FireFox) and Web Inspector (for
> WebKit-based browsers), except it's designed to work remotely, and in
> particular, to allow you debug web pages on a mobile device such as a
> phone.

这也是个牛逼闪闪的工具啊。相对而言UC开发版，应该最easy的了。

详情可参看官网文档：[http://plus.uc.cn/document/webapp/doc5.html][3]


  [1]: http://plus.uc.cn/attachment/308
  [2]: http://people.apache.org/~pmuellr/weinre/docs/latest/
  [3]: http://plus.uc.cn/document/webapp/doc5.html
