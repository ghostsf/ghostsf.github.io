title: WeUI再加上微信web开发者工具是如何让你爽到不要不要的
categories: 旧文字
tags: [微信二次开发]
date: 2016-01-21 00:51:17
---
> WeUI 是微信官方设计团队推出的一套同微信原生视觉体验一致组件库，项目地址是
> [https://github.com/weui/weui][1]，目前包括 buttons、cells、toasts、dialogs、
> progresses、message pages、articles、actionsheets、icons 等各式组件。 从今年10月份在
> github 开源至今，累计4300多 star，并衍生出 weui-sass、vue-weui、react-weui 等版本。

![link.jpg][2]

这确实是个蛮爽的UI。具体效果可看github。

**Mobile 开发现状**

越来越多的公司和个人，以微信作为入口，借助微信开放的接口，开发自己的 Web 应用。Web 应用体验是否良好，很重要的一点就是UI。就目前的情况看来，较多的第三方微信 Web 应用，都缺乏良好的 UI 设计。

一般团队开发 Web 应用，通常是首先进行交互设计、视觉设计，然后再进行前端开发、后端开发。一套流程下来，少则一两天，多则一周以上，花费时间比较长。

而大多数个人开发者或小团队，都是一人身兼数职，从设计（或者说没有设计，全靠脑补）、前端开发、后端开发全包，这时候都是以实现功能为主，视觉体验无暇顾及。花费的时间不少，开发出的应用体验又差。

**实践**

利用 WeUI 的这些组件，可以轻松搭建出 Web 应用。我们就以微信意见反馈的其中一个界面为例，看看如何利用 WeUI 快速构建出既实用又美观的界面。

1. 根据 WeUI 主页（https://github.com/weui/weui）的指引，可以使用 bower，或 npm，或 git clone ，或者直接下载的方式获取 WeUI
2. 在页面中引入 weui.min.css 文件
3. 根据需求，从官方 demo 中重复拷贝对应的组件结构，即可完成 Web 界面构建

> 不需要专门设计，也不需要编写复杂的代码，1分钟就可以做出实用、美观、与微信原生体验一致的 Web 界面 。WeUI
> 就是这样让你爽到不要不要的！

**微信web开发者工具**

 - 使用自己的微信号来调试微信网页授权
 - 调试、检验页面的 JS-SDK 相关功能与权限，模拟大部分 SDK 的输入和输出
 - 使用基于 weinre 的移动调试功能
 - 利用集成的 Chrome DevTools 协助开发

这也是个很开心的事，可以方便微信web开发。

  [1]: https://github.com/weui/weui
  [2]: http://www.ghostsf.com/usr/uploads/2016/01/321840859.jpg