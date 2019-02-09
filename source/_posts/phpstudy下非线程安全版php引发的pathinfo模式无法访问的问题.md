title: phpstudy下非线程安全版php引发的pathinfo模式无法访问的问题
categories: 旧文字
tags: [pathinfo]
date: 2016-10-27 16:41:00
---
关于[php线程安全版和非线程安全版][1]，在这篇文章中ghostsf也提到过。
但是却偶然发现一个问题，那就是在phpstudy这个集成环境下，如果选择了线程安全版的php，也就是例如php5.5n,php5.7n这样的版本。
![1.jpg][2]

如图所示。

这个时候，如果你采用pathinfo模式，构造url，那么这时候会出现一个问题：

    No input file specified

那么如何解决呢？
姑且以thinkphp隐藏index.php的方案为例：
修改`.htaccess`文件为：

    <IfModule mod_rewrite.c> 
    Options +FollowSymlinks -Multiviews 
    RewriteEngine on 
    RewriteCond %{REQUEST_FILENAME} !-d 
    RewriteCond %{REQUEST_FILENAME} !-f 
    RewriteRule ^(.*)$ index.php [L,E=PATH_INFO:$1] 
    </IfModule>

即可。

另外，
apache No input filespecified,在配置apache RewriteRule时也出现这种问题，解决办法很简单如下：
打开.htaccess 在RewriteRule里index.php后面添加一个“?”即可。
代码如下：

    <IfModule mod_rewrite.c>
    Options +FollowSymlinks -Multiviews
    RewriteEngine on
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php?/$1 [QSA,PT,L]
    </IfModule>

那么是ngnix呢？
如果是Nginx环境的话，可以在Nginx.conf中添加：

    location / { // …..省略部分代码
        if (!-e $request_filename) {
            rewrite  ^(.*)$  /index.php?s=/$1  last;
            break;
        }
    }


  [1]: http://www.ghostsf.com/php/391.html
  [2]: http://www.ghostsf.com/usr/uploads/2016/10/3438595975.jpg