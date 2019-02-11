title: Discuz!X3后门户文章内容页DIY如何应用到所有同类页面
categories: 技术栈
tags: [discuz]
date: 2015-11-30 03:29:24
---
 自从X2以来就没有办法应用到所有同类页面了，而且不能应用到门户频道下所有分类，如果门户频道较多，频道下面的子分类较多，一个一个页面DIY，就算是DIY好了再一个一个导入，那如果以后要修改DIY，那也非常麻烦，能不能像X1.5一样DIY保存的时候出现“应用到同类所有页面”呢？答案是可以的：

找到：\static\js\portal_diy.js中的：

    if (['portal/portal_topic_content', 'portal/list', 'portal/view'].indexOf(tplpre[0]) == -1) {

修改为：

    if (tplpre[0] != 'portal/portal_topic_content' && tplpre[0] != 'portal/list') {

导入DIY后就可以出现应用于此类全部页面，修改完成后在后台更新缓存，记得勾选DIY。
DIY将会被应用到频道所有分类，因为频道之间可能使用不同的模板，所以并不是应用到全站所有频道，应用到频道反而有一个好处，那就是DIY可以设置和频道相关的内容，可以满足需要了！
