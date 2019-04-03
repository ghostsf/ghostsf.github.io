title: linux下时间同步标准时间的方法
categories: 技术栈
tags: []
date: 2016-03-16 03:06:15
---
与一个已知的时间服务器同步

    ntpdate time.nist.gov

其中 time.nist.gov 是一个时间服务器.
删除本地时间并设置时区为上海

    rm -rf /etc/localtime
    ln -s /usr/share/zoneinfo/Asia/Shanghai /etc/localtime
