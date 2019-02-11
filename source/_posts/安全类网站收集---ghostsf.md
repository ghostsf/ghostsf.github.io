title: 安全类网站收集 - ghostsf
categories: 技术栈
tags: [安全类网站]
date: 2016-11-01 04:32:06
---
**Android**
移动端，特别是安卓接触的时间和机会较多，所以我优先说说安卓下的安全网站资源和项目。

**APK爬虫**
如果是分析安卓应用的安全问题，那么第一步应该是：获取大量的app来分析啰！我们一般会编写爬虫来获取大量的app信息以及文件。
WebAPKCrawler
playdrone-kitchen
google play crawler
android apps crawler
google play api

**应用行为分析**
拿到app后做什么呢？行为分析呀！
Intent Analysis
Soot infoflow
NDroid 动态数据流分析
uiautomator
mobile sandbox tools
AndroidViewClient
Introspy-Android
APKSmash 在APK中寻找敏感信息
androwarn 简单数据流分析

**逆向调试**
必要的时候，对于一些复杂的行为，很难从黑盒分析方式得到实质，所以需要反编译看代码或者动态调试分析行为。
android lkms
ZjDroid
adbkit
NinjaDroid
android-scripts
jadx dex to java
Luyten
google版的dex2jar

**钩子**
给目标系统或者目标应用挂钩子，是一种相对高阶并且非侵入的分析办法，相对于暴力破解／分析来说，当然，钩子是双向的，进可攻，退可守。
ZHookLib
Android-Rootkit
hooker
adbi
ddi
ldpreloadhook
Xposed
XposedInstaller
redexer Dalvik instrumentation
inDroid
IGLogger
Disabler

**广告检测**
广告行为分析。
ADDetector

**应用加固**
安全的大方向，除了攻，便是防。加固说的通俗点就是给系统或者应用穿盔甲，执盾牌。
AndroidObfuscation-NDK
obfuscator
dehorser

**模拟器检测与对抗**
攻击者很多时候为了大规模自动化攻击，可能会用模拟器。比如变换ip地址，变换imsi／imei号码刷接口等恶意操作，所以，模拟器的监测和防护，是一种比较重要的保护手段。毕竟，普通的用户一般不会拿模拟器来访问app的内容。
AndroidEmulatorDetection
anti-emulator

**重打包检测**
攻击者破解目标应用插入恶意代码后重新打包并发布到渠道，诱导用户下载安装使之中招，这是一种比较低劣且常见的攻击方式，需要有效的监测并防止。（重打包不一定是为了散布恶意软件或者病毒木马，也可能是为了动态调试目标应用的目的，比如竞品分析之类，所以也是一种反恶意调试的盾）
FSquaDRA

**漏洞POC及修复**
利用系统以及应用漏洞，可以用来制作病毒木马，散布恶意程序，窃取用户隐私。也可以用来保护系统以及应用。更可以用来完成一些不可能完成的任务。刀在这里，杀人，救人，还是变魔术，看你自己了。
FakeId
AndroidZipArbitrage

**伪基站检测**
伪基站好比一家黑店，你进去买东西（上网购物），焉有有不挨宰（黑）的道理？ 最可恨的是，这家黑店是无形的，看不见摸不着，账户上的钱不见了，可能还没有意识到。
Android IMSI Catcher Detector

**其他**
安卓每个版本的android.jar收集
模拟手机获取android_id
安卓应用分发列表，包括官方市场渠道以及来自中国大陆，台湾和俄罗斯的第三方分发市场以及渠道
Cloud Xiao整理的安全资源列表
android-security-awesome
2016 黑客的 Android 工具箱都有哪些？
Hacked Team
A database of published security advisories reported by the Programa STIC Team at Fundación Sadosky

**OSX & iOS**
OSX和iOS系统相关安全工具

**Web以及服务端安全**
国内
t00ls
Worm.cc
FreeBuf.COM 关注黑客与极客
Sebug漏洞库: 漏洞目录、安全文档、漏洞趋势
网络安全攻防研究室
SecWiki-安全维基,汇集国内外优秀安全资讯、工具和网站
腾讯安全应急响应中心
黑吧安全网 - 中国最早的IT技术门户网 成就IT精英 网络安全
看雪安全论坛
WooYun知识库
WooYun.org | 自由平等开放的漏洞报告平台
吾爱破解论坛-LCG-LSG|软件安全

**国外**
exp漏洞库
路由器漏洞专区
Paper汇总
..:: Corelan Team
ha.ckers.org web application security lab
SpiderLabs Anterior
CVE - Common Vulnerabilities and Exposures (CVE)
http://http://news.hitb.org/
Home | Sucuri Blog
Help Net Security
Blogs | The Honeynet Project
We Are Legion
The Hacker News
Threatpost | The first stop for security news
www.ex-parrot.com
Ctrlbox.com
AnonNews.org : Everything Anonymous
http://sla.ckers.org/forum/
Hack This Site Forum • Index page
Awesome Security
application security
Awesome CTF
Awesome Malware Analysis
Awesome Hacking
Awesome Honeypots
awesome-incident-response
A practical security guide for web developers


<!--more-->


**参考链接**
[安全类网站推荐列表][1]
[Awesome Security][2]


  [1]: http://daily.zhihu.com/story/3877456
  [2]: https://github.com/sbilly/awesome-security
