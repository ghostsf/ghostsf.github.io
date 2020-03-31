title: HTML &lt;a&gt; download 属性点击链接来下载图片
categories: 技术栈
tags: []
date: 2017-02-24 01:42:22
---
Html5里面的 标签的 Download 属性可以设置一个值来规定下载文件的名称。所允许的值没有限制，浏览器将自动检测正确的文件扩展名并添加到文件 (.img, .pdf, .txt, .html, 等等)，

**浏览器支持：**
![1.png][http://www.ghostsf.com/usr/uploads/2017/02/124067711.png]

但是 Download 的兼容性不怎么样，只有 Firefox 和 Chrome 支持 download 属性。
在文章后面会给大家说说怎么兼容IE的！

    　测试代码：
    <a href="imges/ghostsf.jpg" download="图片">
    </a>

**兼容IE**
想要兼容IE那就需要在你页面的 <head></head> 部分引入这个js文件了

    <script src=”http://html5shiv.googlecode.com/svn/trunk/html5.js”></script>

必须放在head里面因为要让浏览器在解析头部后再去解析<body>,就能让IE 支持该属性了。
