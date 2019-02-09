title: 树莓派折腾记（一）初始化&amp; owncloud
categories: 旧文字
tags: [树莓派]
date: 2016-05-21 03:57:35
---
树莓派3代 Model B入手一段时间了，一直没空折腾。
这几天晚上简单搞了下，基础配件搭配上了。5v2.5A电源,32GSD卡，外壳支架，电风扇，散热片（铜、铝）。
![IMG20160518200118.jpg][1]

![microMsg.1463660562237.jpg][2]
装上了最新版本的raspbian系统，Debian目前稳定版本[Jessie][3]（翠丝，第二部玩具总动员的一个角色，是一个为虚拟的电视剧 Woody's Roundup 而塑造的女牛仔人物，哈哈，这个我喜欢）。
装系统也很简单，[教程][4][也很多][5]（话说，一句话很多外链我也喜欢），我就整理了。Jessie版本要启用root用户登录的话，还需要修改下SSH设置，具体怎么搞，自行Google吧。
系统装好了，然后就顺便装了下web服务器，lamp环境，[这个也很简单啦][6]。
然后我一直想搞个owncloud，遂[搞之][7]，[尔后][8]，遂（每句话都有外链，哈哈）。
记得提前把数据库建好哦。上个图吧：
![microMsg.1463662315026.jpg][9]

![IMG_20160519_230056.jpg][10]

内网下已经是ok了。然后搞了下内网穿透。看到花生壳除了树莓派版的，遂[搞之][11]。
树莓派秒变花生棒了。可以在外网访问我的owncloud的了，顺便下了客户端方便实现文件同步了，哈哈。
这里就不贴我的owncloud地址了，毕竟own。


  [1]: http://www.ghostsf.com/usr/uploads/2016/05/476349229.jpg
  [2]: http://www.ghostsf.com/usr/uploads/2016/05/4218097606.jpg
  [3]: http://www.debian.org/releases/jessie/
  [4]: http://blog.csdn.net/longerzone/article/details/36034619
  [5]: http://www.geekfan.net/4552/
  [6]: http://www.geekfan.net/3066/
  [7]: https://owncloud.org/install/#
  [8]: https://download.owncloud.com/download/community/setup-owncloud.php
  [9]: http://www.ghostsf.com/usr/uploads/2016/05/2984272294.jpg
  [10]: http://www.ghostsf.com/usr/uploads/2016/05/2091836027.jpg
  [11]: http://service.oray.com/question/2680.html