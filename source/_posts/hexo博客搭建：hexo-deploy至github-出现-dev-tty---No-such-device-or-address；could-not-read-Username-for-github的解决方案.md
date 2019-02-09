title: hexo博客搭建：hexo deploy至github 出现/dev/tty : No such device or address；could not read Username for github的解决方案
categories: 旧文字
tags: [hexo]
date: 2016-04-27 01:56:00
---
![1.png][1]


_config.yml 配置的是https的git仓库地址。(我后来改用ssh地址后问题解决了)

这个问题比较奇怪。网上目前也没有很好的解决方案。我先罗列几点可能的情况和可能的解决方案：
1. git客户端问题，有人是使用cmd命令行会出现这个问题换用WINGW64 git命令就可以了；有人是WINGW64有这问题，换用github客户端本身自带的shell命令就可以了。
2. 将_config.yml 配置里的deploy repository仓库地址改用 ssh的仓库地址（当然也要配置好密钥，具体不多说），这个时候一般就可以了。但是也有人出现没有权限访问仓库或确认仓库是否存在的错误问题，这多半是因为git多用户的问题,如果在不同的git托管平台，账号和git名都是同一样的，那么就可以用同一个密钥（也就是之前就生成好的）。如果账号不是一样的，那么要配置下git的多用户，这个就不多说了。
3. 有人说是windows系统下本身没有/dev/tty的设备节点，所以打不开。这一点我还没有去研究。有空用mac配置看下。
4. 还有另外一个_config.yml的配置问题，那就是要注意下yml配置文件的格式问题，要注意冒号后面要空一格。推荐使用一些支持yml配置文件格式的编辑器打开，会看到高亮。这样才会生效。

可能原因猜测：
可能是因为配置了git global全局用户名的原因（当然只是猜测，也没验证）

----------

具体原因后续再更下，有知道的大神可以补充下，hexo文档也没详细看。
反正我的hexo博客已经在github page上了，也只是玩玩，贴个地址：[https://ghostsf.github.io/][2]


  [1]: http://www.ghostsf.com/usr/uploads/2016/04/3183280485.png
  [2]: https://ghostsf.github.io/