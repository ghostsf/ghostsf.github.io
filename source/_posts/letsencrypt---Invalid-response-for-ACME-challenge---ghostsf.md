title: letsencrypt - Invalid response for ACME challenge - ghostsf
categories: 旧文字
tags: [nginx,ssl]
date: 2017-02-07 10:01:17
---
使用letsencrypt免费SSL证书的问题
证书到期了，要续期了，自动续期出错了。

    Invalid response for ACME challenge 

大概提示如下：

    IMPORTANT NOTES:
       - The following errors were reported by the server:
    
       Domain: bbs.6doors.org
       Type:   unauthorized
       Detail: Invalid response from
       http://bbs.6doors.org/.well-known/acme-challenge/ZLsZwCsBU5LQn6mnzDBaD6MHHlhV3FP7ozenxaw4fow:
    404

主要问题是服务器配置问题：
如 nginx 里应如此配置一下：

    location ~ /.well-known/acme-challenge/ {
        allow all;
    }

然后重启nginx，重新生成证书，然后就OK了。