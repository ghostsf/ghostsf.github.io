title: android开源项目和框架
categories: 旧文字
tags: [android框架]
date: 2015-07-13 06:56:00
---
特效：

http://www.theultimateandroidlibrary.com/

常用效果：

1. https://github.com/novoda/ImageLoader  异步加载图片，缓存，生成缩略图， 基本上每个应用都会需要这个lib。
    android-query框架
2. https://github.com/chrisbanes/Android-PullToRefresh   类似新浪微博，twitter，下拉刷新列表， 更牛的是还支持上拉加载更多。 不仅仅是ListView，而且GridView也支持。

3. https://github.com/jfeinstein10/SlidingMenu 和 https://github.com/dmitry-zaitsev/AndroidSideMenu 导航抽屉 

   https://github.com/SimonVT/android-menudrawer 导航抽屉 

4. http://actionbarsherlock.com/  与https://github.com/JakeWharton/ActionBarSherlock    actionbar.

5  https://github.com/TonicArtos/StickyGridHeaders  与 https://github.com/emilsjolander/StickyListHeaders  ListView导航特效

6 https://github.com/TheLevelUp/android-left-locked-gallery gallery抽奖效果

7 https://github.com/huewu/PinterestLikeAdapterView  GridView错位效果https://github.com/youxiachai/pinterest-like-adapter-view

8 https://github.com/47deg/android-swipelistview  实现了自定义ListView单元格，可通过滑动来显示扩展面板。


<!--more-->


9 https://github.com/siyamed/android-satellite-menu  有一连串的按钮弹出

10 https://github.com/maurycyw/StaggeredGridView 交错排列的GridView

https://github.com/dodola/android_waterfall  https://github.com/youxilua/waterfall4android

https://github.com/dodola/WaterFallExt 瀑布流

11 https://github.com/daizhenjun/ImageFilterForAndroid  图片处理效果

12 https://github.com/nostra13/Android-Universal-Image-Loader 异步加载图片，万能图片加载 ListView GridView ImagePage ImageGaller

实例：http://blog.csdn.net/banketree/article/details/8004475

13 https://github.com/JakeWharton/Android-ViewPagerIndicator 有标题页面滑动效果

14 https://github.com/pakerfeldt/android-viewflow ViewFlow图片滑动

13 https://code.google.com/p/android-wheel/ 滚轮效果

效果图  

14 http://www.apkbus.com/android-2-1.html

104628dd3y638lqlbylbx6.png

框架：

1. https://github.com/excilys/androidannotations  一个很好的快速开发的框架， 大量使用annotation来代替，类似于RoboGuice

2 ormlite sqlite的orm框架 /GreenDAO

3 汉字转拼音 pinyin4j 与 hanziTopinyin

4 AACPlayer

5 GSON json框架 fastjson

6 Otto 是Android系统的一个Event Bus模式类库。用来简化应用组件间的通信。

7 afinal框架是一个开源的android的orm和ioc应用开发框架

8 xUtils 源于Afinal框架 对Afinal进行了大量重构，使得xUtils支持大文件上传，更全面的http请求协议支持

9 dom4j  XML解析器

10 VTD-XML 一种无提取的XML解析方法 http://my.oschina.net/u/1171837/blog/147544 下载

11 android XMPP推送 下载

12 jsoup网络爬虫

13 acra 定制化Android crash上报库及后台系统

14 VLC 视频聊天

16 SPydroid http://blog.csdn.net/xiaoliouc/article/details/8493161


项目篇：
Apollo音乐播放器：就一个播放器，但是实现的很好
oschina客户端：oschina网站的客户端哦，wp版，iOS版都有开源
xabber实时聊天工具（基于xmpp协议）：不评价了，反正算是同类中比较好的了
四次元新浪微博客户端：今天才知道是开源的，赶紧收藏
Google IO：谷歌开发者大会应用，虽然有点难懂，还是很有参考价值（比如其中的图片加载）
eoe客户端：eoe网站Android客户端也开源咯
组件篇：
Android-Flip：可以实现类似FlipBoard那种华丽丽的翻页
Drag-Sort-Listview：可以拖动item重新排序的listview，效果非常赞
HoloEveryWhere：咳咳，有些同学非常喜欢Android的holo风格，这个项目绝对让你happy
Universal-ImageLoader：这个经典的异步图片加载，不多说了
JazzyViewPager：这玩意可以让ViewPager翻起来更酷，谁用谁知道~~
SlidingMenu：这个是抽屉界面（就是facebook那种）的各种实现版本中，最好的，木有之一！
StickyListHeaders：iPhone上经常有这个，就是listview的……不知道怎么解释，自己下载看看吧
Android-PullToRefresh：下拉刷新，挺常用的一个组件
StaggeredGridView：这是一个瀑布流布局的实现，还不是很完善，但作为学习的案例或者在其基础上扩展还是不错的
android-async-http：android的异步请求组件，我个人习惯使用asynctask，不过这个实现还是很优秀的，也推荐给大家
ActionBarSherlock：大家熟知的ActionBar在2.x上的兼容性方案；类似的兼容性组件还有许多，有时间为大家一一列出；
facebook-android-sdk：不止是一个SDK那么简单哦，比某浪和某人的SDK强几个数量级；
NineOldAndroids：想在2.xSDK上使用Android 3.0新增的动画API，那就是它了；没用过的同学一定要试试哦，非常方便~
android-swipelistview：让listview的item可以向右滑动，新版Gmail和Pocket里面有用到哦~
DataDroid：Android的RESTful封装，没听过RESTful？你去死吧
EventBus：和上面的DataDroid同样属于美化底层代码的，这个lib简化了不同组件之间的事件传递
android-switch-backport：Android3.0以上才有的switch，有好心人给迁移到2.x上了，哈
PagerSlidingTabStrip：最新版的GooglePlay的那个tab效果，可炫可炫了
chromeview：我们都知道webview，也知道Android的chrome又自己的内核，这个项目就是把chrome的内核给导出来做成一个chromeview了，大家可以在自己的项目里用，有兴趣的可以玩玩
picasso：来自square的图片异步加载，好像是最近才开源的，API风格很独特
网站篇：

github：各种项目很多，就是不容易挖掘，但是开发者必备
oschina：曾经一般，现在越做越好了，很多开源项目；
eoeandroid：经过一番整理，现在非常强大；小作品居多；
AndroidViews：我曾经想做这么一个网站来着，很多开源组件的集合
爬爬的博客：

图片处理框架：

图片模糊处理：StackBlur 

PDF框架： IText  MuPDF  droidtext  com/sun/pdfview  com.lowagie.text(iText-2.1.7)