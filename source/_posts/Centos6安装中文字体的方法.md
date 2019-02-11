title: Centos6安装中文字体的方法
categories: 技术栈
tags: [Centos]
date: 2017-02-16 09:00:00
---
先安装字体管理软件，Centos4.x之后，都用fontconfig

    yum install fontconfig

将需要安装的字体放到`/usr/share/fonts/chinese/`目录下

这里的中文字体，可以直接去windows系统里面拿，或者网上下载等。

比如微软雅黑字体：

    C:/Windows/Fonts/msyh.ttf

可以直接copy过来，放到linux系统里。

如果不存在这个目录，可以自行创建

修改目录权限，以便其他用户也可以使用

    chmod -R 755 /usr/share/fonts/chinese

应用更改

     fc-cache -fv

注意，某些应用可能需要重启才能生效

使用下面的命令可以查看已经安装的字体

    fc-list

如果字体安装成功了，可以看到：

    Microsoft YaHei,微软雅黑:style=Regular,Normal,obyčejné,Standard,Κανονικά,Normaali,Normál,Normale,Standaard,Normalny,Обычный,Normálne,Navadno,Arrunta

这时候微软雅黑字体就安装好了。

By the way:
如果你需要用到微软雅黑的字体加粗：
那么一定要加入`msyhbd.ttf`

不然就GG了。
