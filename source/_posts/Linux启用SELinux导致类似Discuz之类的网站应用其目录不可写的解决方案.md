title: Linux启用SELinux导致类似Discuz之类的网站应用其目录不可写的解决方案
categories: 旧文字
tags: [selinux]
date: 2016-10-16 14:11:00
---
![1.jpg][1]

CentOS7下默认启用了SELinux，当时也没留意。后来发现访问某些服务器目录下的文件访问不到，并且安装Discuz的时候发现第二页永远是不可写状态（实际已经给了全目录777的权限）。起初以为是apache2以及php7的问题，后来发现其实是SELinux的安全策略在作祟。
那么关于SELinux更多的基础知识和其执行过程可参阅这篇文章[Linux学习之CentOS(三十)--SELinux安全系统基础][2]。
写得非常详细，这里我就不赘述了（详细内容我也说不明白）。
相信很多朋友也遇到了这样的情况，网上搜索到的答案基本都是给目录赋上可写权限，`chmod -R 777 xxx`之类的。
所以不妨看下是否又SELinux的问题。
我们可以看下其主配置文件：
![1.png][3]

那么我们这里解决这个问题的方案就是关闭SELinux了。
可以临时关闭之：

    setenforce 0

执行下即可。

也可以像上面的主配置文件一样设置，修改其模式为禁用:
修改成  `SELINUX=disable`     禁用SeLinux

  [1]: http://www.ghostsf.com/usr/uploads/2016/10/3933542006.jpg
  [2]: http://www.cnblogs.com/xiaoluo501395377/archive/2013/05/26/3100444.html
  [3]: http://www.ghostsf.com/usr/uploads/2016/10/2499883989.png