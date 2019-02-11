title: 树莓派折腾记（二）搭建SVN代码托管服务
categories: 创作集
tags: [树莓派]
date: 2016-10-15 15:11:00
---
![1.jpg][1] 

![2.jpg][2]


树莓派之前搭建的owncloud私有云一直在用，后来因为它挪了位置，换了网络环境，就没去接外网。
[树莓派折腾记（一）初始化& owncloud ][3]

最近想把一些需要版本迭代的文件或者代码有一个可以私有存放的地方，于是就想简单搭个SVN

    sudo apt-get install subversion

执行以下以上命令即可下载安装subversion了。

安装好之后，我们就可以在树莓派上创建一个svn远程仓库了。

    svnadmin create /var/svn

比如这样，当然这里的svn库的路径就是/var/svn了。

库配置好了，然后就是简单设置下svn的设置和用户了。

**修改配置文件/var/svn/conf/svnserve.conf**

    nano /var/svn/conf/svnserve.conf

![QQ截图20161015182859.png][4]

注意：所有的行都必须顶格，否则报错。
当然这里还有关于用户组的配置等，这里就不赘述了。

**修改配置文件passwd**

    nano /var/svn/conf/passwd

**配置允许访问的用户:**

    [users]
    svnuser = password
    ghostsf= password

注意[users]不要注释掉，也就是前面的#一定要去掉。
当然这里修改文件的命令不一定要nano。

**停止Subversion服务器：**

    killall svnserve

启动Subversion服务器 对于单个代码仓库,启动命令：

    svnserve -d -r /var/svn

其中-d表示在后台运行，-r指定服务器的根目录，这样访问服务器时就可以直接在浏览器地址svn://服务器ip来访问了。

关于subversion的其他常用命令就不赘述了，相关文档很多。

这样一个简单的私有svn仓库就搞定了。可以很方便帮你进行代码和一些文件的版本控制，很多时候我们会有文案修改1，文案修改2，文案修改3，文案最终版，文案最终版2的各种手动版本控制的问题，又多了一种更逼格的解决方案了，更关键的是它就在你那信用卡大小的树莓派上。


  [1]: http://www.ghostsf.com/usr/uploads/2016/10/1539640169.jpg
  [2]: http://www.ghostsf.com/usr/uploads/2016/10/4131615533.jpg
  [3]: http://www.ghostsf.com/prose/290.html
  [4]: http://www.ghostsf.com/usr/uploads/2016/10/2633749166.png
