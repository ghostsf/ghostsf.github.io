title: 网页前端优化 - 使用DNS PREFETCHING 加速网页 - ghostsf博客
categories: 技术栈
tags: [DNS PREFETCHING]
date: 2016-11-26 09:29:12
---
**什么是DNS Prefetching？**

dns-prefetch, 是DNS预获取，也是网页前端的优化的一种技术。一般在前端优化中与DNS有关的两点：1、减少请求次数，2、提前对DNS预获取。DNS作为互联网的基础协议，其解析速度很容易被网站优化人员SEO人员忽视，其典型的一次dns-prefetch解析需要“20-120ms",减少DNS解析时间和次数是一个不错的优化方式。

dns-prefetch​作用简单说明就是当你浏览网页时，浏览器会加载网页时对网页中的域名进行解析缓存，这样在你单击当前网页链接无需DNS解析，减少浏览者等待时间，提高用户体验。

**如何使用？**

    <link rel="dns-prefetch" href="//www.ghostsf.com">

非常简单，在网页头部增加rel属性为”dns-prefetch”的link标签，并在href中指定想要预解析的域名。

当你网站包含多个域名时，这个是一个非常实用的功能，现在就开始使用吧。

**浏览器支持：**

> Firefox 3.5+, Chrome, Safari 5+ and IE 9+

**需要注意:**

虽然dns-prefetch能够加快网页解析速度，但是也不能随便滥用，因为多页面重复DNS预解析会增加重复DNS查询的次数。

**总结：**

在优化当中dns-prefetch对网页预获取，在提高大型网站浏览速度方面可以提高，不用让浏览者等待是一个不错的方法。
