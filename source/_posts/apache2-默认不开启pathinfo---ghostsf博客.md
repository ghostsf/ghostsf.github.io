title: apache2 默认不开启pathinfo - ghostsf博客
categories: 旧文字
tags: [apache,pathinfo]
date: 2016-07-14 04:59:00
---
apache2.x默认不开启pathinfo了，有需要的可自行启动。
PathInfo 可以实现友好的URL路径，这还是很有意义的。
最近用了下thinkphp5框架，apache升到了最新版本，发现不支持PathInfo了。
让Apache2支持PathInfo，可以这么做：
在配置文件中加入

    <Files *.php>
    AcceptPathInfo On
    </Files>

这样就可以了。

同时要注意下Apache服务器是否开启了mod_rewrite模块，若没开启，可以这么开启：
去掉配置文件里：

    #LoadModule rewrite_module modules/mod_rewrite.so
这个模块前的"#"注释去掉，即可。