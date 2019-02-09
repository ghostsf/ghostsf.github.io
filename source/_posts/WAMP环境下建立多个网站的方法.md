title: WAMP环境下建立多个网站的方法
categories: 旧文字
tags: [wamp]
date: 2015-07-06 02:58:00
---
WAMP是一个在windows下搭建apache+Mysql+PHP的一个快捷软件，并且有形象的操控服务界面，windows主机一般配以IIS，这样也有很多基于IIS的虚拟主机系统，而Apache最好是运行于linux系统中，这里我们运用WAMP搭建多个站点，教程如下：

第一步，确认你的WAMP是正常服务的,然后停止WAMP服务
左键点击WAMP在桌面右下角的图标，然后找到APACHE，然后再弹出的菜单中选择http.conf,在文件的最后边添加以下代码：

    NameVirt lHost *:80
    
    <Virt lHost *:80>
    DocumentRoot "D:\usr\www\test1"
    ServerName www.第一个的域名.com
    </Virt lHost>
    
    <Virt lHost *:80>
    DocumentRoot "D:\usr\www\test2"
    ServerName www.第二个的域名.com
    </Virt lHost>

第二步：将你的域名正常解析到服务器或者VPS的IP上就可以了！


<!--more-->

