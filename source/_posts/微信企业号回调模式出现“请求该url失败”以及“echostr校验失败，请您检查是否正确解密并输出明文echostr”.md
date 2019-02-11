title: 微信企业号回调模式出现“请求该url失败”以及“echostr校验失败，请您检查是否正确解密并输出明文echostr”
categories: 技术栈
tags: [微信二次开发]
date: 2016-02-23 08:06:57
---
以下问题，前提肯定要检查后相关配置是否填写正确，url(是否能正常访问等),token,以及EncodingAESKey。

请求该url失败？ echostr校验失败，请您检查是否正确解密并输出明文echostr？
那么会是什么原因呢？

 - 对echostr参数解密并原样返回echostr明文(不能加引号，不能带bom头)，若返回空也会报错“请求该url失败”。
 - 在获取GET请求携带的四个参数时需要做urldecode处理，否则会验证不成功
 - 若是php开发的同时得注意是否拓展了mcrypt模块。否则会报错。

后续继续补充，未完待续。

