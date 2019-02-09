title: 微信企业号回调模式接入，官方demo(php版)小问题修改
categories: 旧文字
tags: [微信二次开发]
date: 2016-02-23 07:53:37
---
php版的demo里：
1. HttpUtils.ParseUrl可以使用**$_GET["xxx"]**代替，但是要注意需要做**urldecode**处理，否则会验证不成功。
修改如下：

    $sVerifyMsgSig = urldecode($_GET["msg_signature"]);
    $sVerifyTimeStamp = urldecode($_GET["timestamp"]);
    $sVerifyNonce = urldecode($_GET["nonce"]);
    $sVerifyEchoStr = urldecode($_GET["echostr"]);

2. HttpUtils.SetResponce($sEchoStr);
可以直接 `echo $sEchoStr;` 代替。

另外需要注意的是使用php开发的话，要注意拓展mcrypt模块。
这里贴一个[CentOS下php安装mcrypt扩展][1]的方法。



  [1]: http://www.cnblogs.com/huangzhen/archive/2012/09/12/2681861.html