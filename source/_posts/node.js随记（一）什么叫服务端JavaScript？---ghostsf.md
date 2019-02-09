title: node.js随记（一）什么叫服务端JavaScript？ - ghostsf
categories: 旧文字
tags: [服务端javascript]
date: 2016-10-20 16:55:20
---
最早JavaScript（以下简称js）是运行在浏览器中的，实际上现在很多也是。然而实际上浏览器只是提供勒一个上下文，它定义勒使用js可以做什么，但并没有“说”太多关于js本身可以做什么。事实上，js是一门“完整”的语言： 它可以使用在不同的上下文中，其能力与其他同类语言相比有过之而无不及。
其实js对于大多数开发者而言并不陌生，但是你顶多是个JavaScript_用户，而非JavaScript开发者（当然前提是你并非主攻前端技术）。
然后，出现了Node.js，服务端的JavaScript，这有多酷啊？
那么什么叫服务端JavaScript？
Node.js事实上就是另外一种上下文，它允许在后端（脱离浏览器环境）运行js代码。
要实现在后台运行JavaScript代码，代码需要先被解释然后正确的执行。Node.js的原理正是如此，它使用了Google的V8虚拟机（Google的Chrome浏览器使用的JavaScript执行环境），来解释和执行JavaScript代码。
除此之外，伴随着Node.js的还有许多有用的模块，它们可以简化很多重复的劳作，比如向终端输出字符串。
因此，Node.js事实上既是一个运行时环境，同时又是一个库。
