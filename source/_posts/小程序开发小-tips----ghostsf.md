title: 小程序开发小 tips  - ghostsf
categories: 旧文字
tags: [微信小程序]
date: 2016-11-15 10:18:00
---
**为什么 XXX API 无法使用？**

A：因为小程序屏蔽了一部分原生的 API 接口，以下为被屏蔽列表：`window document frames self location navigator localStorage history Caches screen alert confirm prompt XMLHttpRequest WebSocket`

建议开发者尽可能使用微信官方提供 API 实现相应功能。

**小程序如何支持富文本显示？**

小程序没有提供富文本渲染的接口，需要等待相关接口开放才能显示富文本，目前普遍做法是去掉文本的 html 标签，显示纯文本。

例如使用：`simplehtmlparser`

**如何执行动态生成的 javascript 代码？**

小程序屏蔽了 eval 和 Function API，无法执行动态的 javascript 代码，请避免使用。

**如何使用 POST 请求？**

原因是浏览器 CORS 限制，而且小程序 request API 为了保持和 jQuery 的一致，在发送请求时会自动添加 x-requested-with：XMLHttpRequest 这个 header，你需要在服务端返回上加入响应头：Access-Control-Allow-Headers: x-requested-with 参考 stackoverflow，否则浏览器会认为请求非法。

**如何查看前端页面的源码？**

官方的开发者工具默认屏蔽了 UI 层的右键 inspect 功能，可以对官方开发者工具做些修改来开启右键（开启该功能会造成 wxml 面板不可用以及页面无法响应点击等严重 bug），首先使用 js-beautify 对代码批量格式化：

`cd /Applications/wechatwebdevtools.app/Contents/Resources/app.nw
find . -type f -name '*.js' -not -path "./node_modules/*" -not -path "./modified_modules/*" -exec js-beautify -r -s 2 -p -f '{}' \;`
注释掉文件 app/dist/app.js 44 行和 app/dist/components/simulator/webviewbody.js 149 行preventDefault 调用。101100 版本还需要修改 package.json 文件，去掉 --disable-devtools。最后重启开发者工具即可。

**小程序支持 es6 吗？**

官方 IDE 101100 已经支持 es6 语法，可以放心使用。

**如何让小程序支持 less/sass？**

官方 IDE 暂时还没有提供 less 和 sass 等 css 预编译器支持，不建议使用。

**微信小程序能当成app的客户端使用吗？**

理论上讲肯定是完全可以的，只是你需要用 Java 和 Object-C 实现同微信一样的多层通讯逻辑以及各种底层和 UI 上的组件。

欢迎补充~