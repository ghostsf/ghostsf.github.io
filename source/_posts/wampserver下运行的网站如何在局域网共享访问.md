title: wampserver下运行的网站如何在局域网共享访问
categories: 旧文字
tags: [wampserver]
date: 2015-12-23 16:21:28
---
> wampserver下运行的网站如何在局域网共享访问
很多做手机站的或者需要远程联调的，需要在局域网里共享访问网站。wampserver环境下运行的网站，需要进一步设置下。
首先要考虑的是防火墙的问题，有安装防火墙的需要关闭改局域网的防火墙。Windows自带的防火墙不想关闭的，可以添加允许运行的程序，具体方法，这里不再赘述，将apache的httpd.exe添加进允许列表即可。
然后是wampserver本身的apache配置问题，apache的配置文件在/bin/apache/conf目录下的httpd.conf
打开，然后搜索`Controls who can get stuff from this server`.
主要是这块的配置：

        #
        # Controls who can get stuff from this server.
        #

    # onlineoffline tag - don't remove
        #Require local
        Require all granted

这里将默认的Require local修改为`Require all granted`即可。

当然也有说将Deny from all改为Allow from all的，然而亲测无用。具体原因懒得研究了。

      Odrer Deny,Allow
        #Deny from all
        Allow from all
        Allow from 127.0.0.1
        Allow from ::1
        Allow from localhost

  