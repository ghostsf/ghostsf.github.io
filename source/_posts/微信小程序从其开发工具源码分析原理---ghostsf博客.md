title: 微信小程序从其开发工具源码分析原理 - ghostsf博客
categories: 技术栈
tags: [微信小程序]
date: 2016-09-28 07:13:00
---
![1.jpg][1]

由于没有拿到内测的资格，姑且使用0.9版本+内测IDE的部分文件，替换之后破解模拟一个。这个相信很多微信开发的朋友们都已经使用上了。
首先我们打开开发工具的目录，其源码在`/package.nw`目录下。

**源码目录说明**：
这是一个NodeWebkit封装的Web应用。
`app/` 目录下放置了app的代码
`modified_modules/` 即一些修改后的模块
`node_modules/` node模块
`package.json` 配置文件，配置了NW相关的内容
在`modified_modules`目录下有两个子模块：
`anyproxy`，一个代理模块
`weinre`，远程调试工具

**IDE运行顺序**
在`package.json`中的`"main": "app/html/index.html"`，即定义了这个APP的入口是这个`index.html`，而不是别的文件。
其中引入了一个js文件，`<script src="../dist/app.js"></script>`
打开这个js文件，开头写有一个init方法

    "use strict";
    function init() {
        tools.Chrome = chrome;
        ......
可以想见这个是NodeWebkit相关的入口了。

这是一个react应用，检查主入口，发现：

    reactDom.render(React.createElement(controller, null), document.querySelector("#container")

直接跳转到ContainController.js，跳转到render方法，找到了这个：

    React.createElement(Main, {
        project: this.state.project,
        appQuit: this.appQuit,
        appMax: this.appMax,
        appMin: this.appMin
    })


所以，Main里面就是大入口了。

    React.createElement("div", {className: "main"},
        React.createElement(menuBar, {
            appQuit: this.props.appQuit,
            appMin: this.props.appMin,
            appMax: this.props.appMax,
            showSetting: this.showSetting,
            project: this.props.project
        }),
        React.createElement(toolbar, {project: this.props.project}),
        React.createElement("div", {
                className: "body"
            },
            React.createElement(sidebar, {
                project: this.props.project,
                optProject: this.optProject
            }),
            React.createElement(develop, {
                show: this.state.show,
                optDebugger: this.optDebugger,
                project: this.props.project
            }),
            React.createElement(edit, {
                show: this.state.show,
                project: this.props.project
            }),
            React.createElement(detail, {
                project: this.props.project,
                show: this.state.show
            })),
        React.createElement(toast, null),
        React.createElement(setting, {
            show: this.state.showSetting,
            showSetting: this.showSetting
        }),
        React.createElement(dialog, null),
        React.createElement(popup, null),
        React.createElement(about, null))
    }

`edit` 就是编辑器及其相关的事项
`detail`就是项目的配置

**WeApp是如何运行的**
然后关于其打包：
微信小程序里：wxml和wxss，这两个文件会被分别转换，即wxml -> html，wxss -> css。对应的有几个不同的transform:

    transWxmlToJs
    transWxssToCss
    transConfigToPf
    transWxmlToHtml
    transManager

这里的PF指代的是PageFrame的意思，pageFrame有一个对应的模板文件：
   

     <!DOCTYPE html>
        <html lang="zh-CN">
        <head>
        <link href="https://res.wx.qq.com/mpres/htmledition/images/favicon218877.ico" rel="Shortcut Icon">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <script>
          var __webviewId__;
        </script>
        <!-- percodes -->
        <!--{{WAWebview}}-->
        <!--{{reportSDK}}-->
        <!--{{webviewSDK}}-->
        <!--{{exparser}}-->
        <!--{{components_js}}-->
        <!--{{virtual_dom}}-->
        <!--{{components_css}}-->
        <!--{{allWXML}}-->
        <!--{{eruda}}-->
        <!--{{style}}-->
        <!--{{currentstyle}}-->
        <!--{{generateFunc}}-->
        </head>
        <body>
        <div></div>
        </body>
        </html>

这种风格一看就是生成字符串Replace的，然后他们写了一个名为wcc以及一个名为wcsc的工具。
wcc用于转转wxml中的自定义tag为virtual_dom
wcsc，我观察到的现象是它为转换wxss为css
这样的话，我们就可以理解为微信小应用有点类似于 Virtual Dom + WebView，毕竟上面有个WAWebView文件 ，还有一个webviewSDK文件 。
当然无论是React + WebView，或者Vue + WebView都不重要，现在就有了WA + WebView了。

在本地写的WeApp都会被提交到微信服务器，然后打包，上传到服务器，交给CDN。
上传的过程大致如下：
APP会被打包成以日期命名 + .wx文件
IDE会检测包的大小，并提示：代码包大小为 xx kb，超过限制 xx kb，请删除文件后重试。这个xx好像是1024，所以APP的大小是1M。

APP将会上传到 https://servicewechat.com/wxa-dev/commitsource/?appid=xx&user-version=&user-desc=xx


  [1]: http://www.ghostsf.com/usr/uploads/2016/10/928092572.jpg
