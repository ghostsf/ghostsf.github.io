---

title: 海康威视 hikvision SDK 二次开发
copyright: true
date: 2020-03-27 11:50:23
tags:  [海康威视,hikvision]
categories: [技术栈]
---------------------------------------------------------------------------------------------------------------------------------

# 桌面软件管控端开发

二次开发 sdk 下载，[https://www.hikvision.com/cn/download_61.html](https://www.hikvision.com/cn/download_61.html)

该设备网络 SDK 是基于设备私有网络通信协议开发的，为后端设备（嵌入式网络硬盘录像机、视频服务器）、前端设备（网络摄像机、网络球机、IP 模块）等产品服务的配套模块，用于远程访问和控制设备软件的二次开发。

sdk 压缩包包含的内容还是比较多的，有各种 demo，目前有 python（psdatacall_demo）、Qt（QtDemo）、Java（LinuxJavaDemo）和 C++（consoleDemo），以及详细的开发文档。
以 `设备网络 SDK_V6.1.4.7(for Linux64)` 为例：
![设备网络 SDK_V6.1.4.7(for Linux64)](https://cdn.ghostsf.com/uPic/WX20200331-205742@2x.png)

按照说明文档，先将动态库设置好。不同平台都有对应的说明。相对而言，windows 系统比较方便（用得也相对较多，相对而言坑也比较少，推荐），mac os 就有点麻烦，如果用 linux 的 sdk 的话，需要将所有 `.so` 的库文件都改为 `.dylib`，具体可以自行摸索，这里就不赘述了。

跑一个 Java 的 demo，demo 界面大概如此：

![]()![Java demo](https://cdn.ghostsf.com/uPic/EU6uMq.png)

![java demo2](https://cdn.ghostsf.com/uPic/XpdccT.png)

# web3.0 网页控件二次开发

不需要使用桌面端软件或者不熟悉 Java swing 开发的，可以使用海康威视的 web 网页控件集成。

海康威视网页控件 sdk 开发包一般需要提交信息发邮件申请。

```
请将以下信息提供完整，发送到 sdk@hikvision.com 邮箱，会有 SDK 工程师回复您的问题
a、您的具体开发需求。
b、开发设备型号及版本
c、开发环境及开发语言
d、贵公司名称，联系人，联系电话，邮箱地址
```

ghostsf 这里给大家整理了一份：

开发包中有 demo，有文档，有中英文版，需要 ActiveX 控件，所以对浏览器有限制，需要 有 IE 内核的浏览器。

使用网页控件之前电脑上需要先安装 `WebComponents.exe` 。

网页控件相关功能方法都在 `webVideoCtrl.js` 里，可以结合 demo 对应查看。

web 开发包里面也已经提供了 API 的说明文档 ，我们也可以对照 API ，调用 webVideoCtrl.js 里面的方法就可以实现我们需要的功能。

这里先借用下别人的图，看下 web demo：

![web demo](https://cdn.ghostsf.com/uPic/H4ALkz.png)

需要点击允许 ActiveX 控件。

![web demo2](https://cdn.ghostsf.com/uPic/AWXmwh.png)

# 海康移动客户端二次开发

移动客户端二次开发 sdk，也需要提交信息发送邮件获取。

```
不管是安卓还是 IOS 的开发，请将以下信息提供完整，发送到 sdk@hikvision.com 邮箱，会有 SDK 工程师回复您的问题。
a、公司名称：
b、开发的设备型号和版本号（务必提供没有型号原则上开发包不予提供）：
c、需要实现的功能：
d、开发平台 android/ios：
e、网络环境（是否有固定 IP）：
```

ghostsf 这里给大家 整理了一份：

具体开发，这里就不赘述了。

可以参考这些文章：

[基于 Android 的海康威视的二次开发](https://blog.csdn.net/wljs17/article/details/92979250)

[基于海康威视网络摄像机的 Android 二次开发](https://blog.csdn.net/weixin_40042248/article/details/81664198)



# 海康威视手机、电脑常用软件下载

查看【海康威视客户服务】微信公众号发布的这篇图文即可。[https://mp.weixin.qq.com/s/hVUM5WNEbGERW7DbKeRFzQ](https://mp.weixin.qq.com/s/hVUM5WNEbGERW7DbKeRFzQ)



# 其他说明

如果不知道摄像头的 ip， 用户名，密码，端口号是多少，可以安装 SADP 软件。SADP 可以看到同一个局域网下面每个摄像头的详情。如果忘记密码了，可以在 SADP 里选择设备进行密码恢复。



更多贴心服务，知识库等，可以微信关注【海康威视客户服务】微信公众号，进行详细了解。
