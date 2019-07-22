---
title: nginx-proxy-read-responseheader-fail
copyright: true
date: 2019-07-22 12:04:36
tags: nginx
categories: 技术栈
---

反向代理 recv() failed (104: Connection reset by peer) while reading response header from upstream错误

> 原因就是请求的头文件过大导致502错误

**解决方法就是提高头的缓存**

``
http {

    client_header_buffer_size 5m;

    location / {
    
    proxy_buffer_size 128k;
    proxy_busy_buffers_size 192k;
    proxy_buffers 4 192k;
    
    }
    
}
``
