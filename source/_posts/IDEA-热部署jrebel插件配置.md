title: IDEA 热部署jrebel插件配置
categories: 旧文字
tags: [idea jrebel热部署]
date: 2015-08-31 15:19:00
---
IDEA 配置jrebel热部署就很easy了

![QQ图片20150827101009.png][2]


找到插件，下载安装即可。（下载不了的话，大半是天朝的原因，找个梯子来吧）

安装完成后可先注册一个jrebel，会激活一个十几天的正版试用。

破解的话也很简单：
安装完后替换一个破解版的jar以及lic即可
jar的地址如图：
![x.jpg][3]

简单一点喜欢用命令行的话就这样吧：

    copy jrebel.jar C:\Users\Administrator\.IntelliJIdea14\config\plugins\jr-ide-idea\lib\jrebel  
    del/q C:\Users\Administrator\.jrebel\*.*  
    copy jrebel.lic C:\Users\Administrator\.jrebel\jrebel.lic  
    pause 

当然这里的jrebel.jar 和 jrebel.lic 都是破解版的啦

这里给大家提供一个破解版的jrebel 6.2.0的
[jrebel6.2.0破解文件.zip][1]

  [1]: http://www.ghostsf.com/usr/uploads/2015/09/3188410762.zip
  [2]: http://www.ghostsf.com/usr/uploads/2015/08/4040416779.png
  [3]: http://www.ghostsf.com/usr/uploads/2015/08/3963224041.jpg