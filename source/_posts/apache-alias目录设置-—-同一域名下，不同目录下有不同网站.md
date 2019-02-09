title: apache alias目录设置 — 同一域名下，不同目录下有不同网站
categories: 旧文字
tags: [apache]
date: 2016-06-22 08:46:00
---
> 一个apache网站，在不同目录下有不同网站，但在同一个域名下，这时可以配置alias，这与多域名不一样。

在http.conf里增加：

    <IfModule alias_module>
        Alias /your_alias /yourproj/ghostsf/root
        # 保留其他配置
    </IfModule>
     
    # 设置相关目录属性
    <Directory "/yourproj/ghostsf/root">
        Options Indexes FollowSymLinks
        AllowOverride None
        Order allow,deny
        Allow from all
    </Directory>

访问时的url:  http://your_host.com/your_alias/    这样就可以映射到对应目录了

> Alias与[virtual host][1]不冲突，可以并存


  [1]: http://www.ghostsf.com/prose/299.html