title: seaJs的模块定义、模块加载及模块依赖关系
categories: 旧文字
tags: [seajs,模块加载框架]
date: 2015-07-17 09:03:00
---
SeaJS 是由玉伯开发的一个遵循 CommonJS 规范的模块加载框架，可用来轻松愉悦地加载任意 JavaScript 模块和css模块样式。SeaJS非常小巧，小巧在于压缩和gzip后体积只有4K,而且接口和方法也非常少，SeaJS 就两个核心：模块定义和 模块的加载及依赖关系。SeaJS非常强大，SeaJS可以加载任意 JavaScript 模块和css模块样式，SeaJS会保证你在使用一个模块时,已经将所依赖的其他模块载入到脚本运行环境中。玉伯的说法，SeaJS可以让你享受写代码的乐趣，不用去管那些加载的问题。你是否厌倦了如此多的js和css引用,我数了一下我们公司网站的个人主页首页上有39个css和js引用，带来的影响可想而知：

1.不利于维护，前端后端都一样，

2.http请求过多，当然这个可以通过合并解决，但是如果没有后端直接合并，人工成本非常大，就算后端合并，维护的时候，这么长的一个字符串，眼睛肯定看花

用SeaJS就能非常好的解决这些问题。

模块的定义define
定义一个模块比较简单，例如定义一个sayHello模块，建一个sayHello.js文档：
[code=”javascript”]
define(function(require,exports,module){
exports.sayHello = function(eleID,text) {
document.getElementById(eleID).innerHTML=text;
};
});
[/code]
这里先看一下exports参数，exports参数是用来向外提供模块的 API.也就是通过这个exports其他的模块就能访问sayHello方法。


<!--more-->


模块的加载use
例如我们页面上有一个id为“out”的元素，要输出“Hello SeaJS!”,
那么我们可以先引入sea.js
然后使用sayHello模块：
[code=”javascript”]
seajs.use(“sayHello/sayHello”,function(say){
say.sayHello(“out”,”Hello SeaJS!”);
});
[/code]
这里的use就是使用模块的方法，
第一个参数就是模块表示，他是相对于sea.js的相对路径来表示，sayHello.js后面的“.js”后缀可以省略，当然这个模块标识还有很多方法，具体查看官方说明：http://seajs.com/docs/zh-cn/module-identifier.html
第一个参数是一个callback函数。say.sayHello()就是调用sayHello模块的exports.sayHello方法，当然这callback函数中有个say参数。

上面这个简单的例子可以直接查看这个demo：http://www.css88.com/demo/seajs/sayHello/。

模块的依赖关系
模块的依赖其实在模块定义的时候就应该存在了。比如说把上面的sayHello模块改写一下，假设我们已经有了一个通用的DOM模块，比如一些获取元素，设置样式等方法，例如这么一个DOM模块，如下编写DOM.js
[code=”javascript”]
define(function(require,exports,module){
var DOM={
/**
* 通过元素的id属性获取DOM对象,参数为字符串，或多个字符串
* @id getById
* @method getById
* @param {String} id the id attribute
* @return {HTMLElement | Object} The HTMLElement with the id, or null if none found.
*/
getById: function() {
var els = [];
for (var i = 0; i < arguments.length; i++) {
var el = arguments[i];
if (typeof el == "string") {
el = document.getElementById(el);
}
if (arguments.length == 1) {
return el;
}
els.push(el);
}
return els;
},
/**
* get 获取对象，可以传入对象或字符串，如果传入字符串者以document.getElementById（）的方式获取对象
* @id get
* @param {String} el html element
* @return {Object} HTMLElement object.
*/
get: function(el) {
if (el &amp;amp;amp;&amp;amp;amp; (el.tagName || el.item)) {
return el;
}
return this.getById(el);
}
};
return DOM;
});
[/code]
那么sayHello模块可以这样编写，为了不影响原来的demo页面，所以我定一个新的sayHelloA模块，我们可以这样编写sayHelloA.js:
[code="javascript"]
define(function(require,exports,module){
var DOM=require("DOM/DOM");
require("sayHelloA/sayHello.css");
exports.sayHello = function(eleID,text) {
DOM.get(eleID).innerHTML=text;
};
});
[/code]
require 函数就是用来建立模块的依赖关系，比如上面sayHelloA模块，就是依赖于DOM模块，因为用到了DOM模块的get方法。
注意这里的var DOM=require("DOM/DOM")，这句是将应用进来的DOM模块赋值给DOM；require("sayHelloA/sayHello.css")是直接应用sayHello.css css模块或者说文件。这样页面上会引用这个css文件。
查看demo：http://www.css88.com/demo/seajs/sayHello/indexA.html

最近这几天一直捣腾SeaJS，越捣腾越喜欢，感谢玉伯！感谢SeaJS！当然你可能觉得这么简单的几个实例没必要这么做。确实如果js文件少的小项目感觉不错模块化的优势，但是，更多的在js文件多或着中型以上项目这个模块化的优势就体现出来了。

更多学习资源：

SeaJS主页 – http://seajs.com
SeaJS的GitHub库（可获取源码） – https://github.com/seajs/seajs
SeaJS作者玉伯的博客 – http://lifesinger.wordpress.com/
一些关于SaeJS的文章 https://github.com/seajs/seajs/wiki/Community