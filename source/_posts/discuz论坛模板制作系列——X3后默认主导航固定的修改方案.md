title: discuz论坛模板制作系列——X3后默认主导航固定的修改方案
categories: 旧文字
tags: [discuz模板制作]
date: 2015-08-12 03:49:00
---
今天看了下discuz模板制作，发现discuz在文档方面还真是乱啊，一套一套的，有时很难找到自己想知道的东西，所以呢，我打算弄一个博文系列记录自己学习过程中遇到的问题和解决方案。当然我主要是发布一些目前网上很难找到的。

**X3后默认主导航固定的修改方案**
这里要说明的是：discuz x3后官方风格的导航是可以浮动的，也就是默认主导航固定的。这个在后台可以进行设置，具体设置方法如下：
**后台界面设置-论坛首页设置-关闭顶部导航固定**
当然这里如果修改的话，要注意**主题列表页**以及**帖子内容页**也都需要修改一致，要么都固定要么都不固定。

然后这就是默认主导航固定的修改方案吗？
当然这样还是不行的，你不能做了一个模板，用户安装了后，还要去后台设置下这个才能用吧。
有些模板制作出来，就是要主导航不固定，因为在主导航的父元素标签里比如<hd>里已经做了固定的设置，那就不需要官方的后台控制是否固定了。
当然这个功能无非是触发了js事件，所以可直接去重写相关的js文件即可。
那么相关的js文件又在哪儿呢？
discuz存在了风格基础文件存放的目录，也就是**/static/js**这个目录里。
在这里找到**forum.js**，将其拷贝出来，进行重写。根据导航的id="nv"，找到事件监听函数，进行相关修改即可。如果要你做的模板不要这个控制，直接删了即可。
该函数相关代码如下：

    function fixed_top_nv(eleid, disbind) {
    	this.nv = eleid && $(eleid) || $('nv');
    	this.openflag = this.nv && BROWSER.ie != 6;
    	this.nvdata = {};
    	this.init = function (disattachevent) {
    		if(this.openflag) {
    			if(!disattachevent) {
    				var obj = this;
    				_attachEvent(window, 'resize', function(){obj.reset();obj.init(1);obj.run();});
    				var switchwidth = $('switchwidth');
    				if(switchwidth) {
    					_attachEvent(switchwidth, 'click', function(){obj.reset();obj.openflag=false;});
    				}
    			}
    
       ...

将你拷贝出来的修改过的**forum.js**放到你设置的{STYLEIMGDIR}扩展目录，然后再引入即可。


<!--more-->

本博文为原创，转载请标注来源：[Ghostsf博客][1]


  [1]: http://www.ghostsf.com