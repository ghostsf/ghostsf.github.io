title: php网站出现Cannot redeclare class SessionHandlerInterface的问题原因和解决方案 - ghostsf博客 
categories: 技术栈
tags: []
date: 2016-10-12 05:29:00
---
![1.jpg][1]

更新了下服务器上php版本，由5.3更新到了5.5，发现有一个第三方系统的网站出现了Cannot redeclare class SessionHandlerInterface的问题。
简单查了下php文档：[http://www.php.net/manual/en/class.sessionhandlerinterface.php][2]
PHP在版本5.4后引入了一种新的基于sessionhandlerinterface接口的会话管理系统。
**那么从5.3升级到5.5为什么会出现这个问题呢？并且如何解决呢？**

>  It would seem that the Symfony2 code declares a class with the very
> same name in the global namespace, so there is a name clash.


----------


> The interface defined in Symfony is a stub for PHP 5.3 allowing to use
> the 5.4 interface in the codebase. If you upgrade PHP, you need to
> clear your cache so that it is rebuild for the right PHP version (i.e.
> not including the stub interface in the concatenated classes)

显然在php5.3中这个接口是声明在Symfony2里的，所以这里有了相同的全局命名空间。
解决方案就是需要清除缓存，然后让其根据新的php版本重建。

具体可运行如下命令：

    php app/console cache:clear

当然这里的`app/console`当然是指Symfony框架目录下的。Symfony/Console控制台是一个独立的包，由创立Symfony框架的Fabien Potencier开发而来。作为Symfony框架的一部分，也被Laravel4’s Artisan CLI和Silex应用到。
关于Symfony2 Console命令可自行查询文档或者相关博客，这里就不赘述了。
很明显这个`cache:clear`命令是用来清除缓存的。
正式环境下，可设置相关参数比如 

    --env -e             环境名
    --no-debug           关闭调试模式

那么命令就是：

    php app/console cache:clear --env=prod --no-debug

然后我并没有那么幸运地解决这个问题（按原理分析这么处理就可以解决问题了）。
我执行了之后出现了这样的问题：
![1.png][3]

这个问题我也没能找到一个合理的解决方案。主要也是因为我对Symfony这个框架不是很熟悉。
然后我就另辟蹊径了，既然是要清理重建，那我就干脆强行删掉缓存吧，于是我就大胆地做了这么一件事情：

     sudo rm -rf app/cache

然后再看网站，结果成功了！网站正常运行了。然而，这并没有出乎我的意外。

  [1]: http://www.ghostsf.com/usr/uploads/2016/10/3178130302.jpg
  [2]: http://www.php.net/manual/en/class.sessionhandlerinterface.php
  [3]: http://www.ghostsf.com/usr/uploads/2016/10/3820873066.png
