title: 前端兼容性测试方案 BrowserStack 使用介绍
categories: 技术栈
tags: [BrowserStack]
date: 2017-05-26 05:20:00
---
> 前端开发一直过不去的坎就是浏览器兼容性。

关于BrowserStack  这是 Wikipedia 上的介绍：

    BrowserStack is a cloud-based cross-browser testing tool that enables developers to test their websites across various browsers on different operating systems and mobile devices, without requiring users to install virtual machines, devices or emulators.

**测试方案**

BrowserStack 有三种测试方案：

 - Live: 最为简单的测试，在 BrowserStack 的首页选择一款浏览器后就可以「真机」测试了。
 - Automate: 下文会具体介绍这种测试方案，一般搭配 CI 使用，功能最为丰富。
 - Screenshots: 有桌面端与移动端，可以选择至多 25 款浏览器对某个网页生成截图，适合批量测试兼容性。

**Automate**

顾名思义，Automate 即自动化测试。
BrowserStack 的 Automate 脚本支持的语言有

    Java
    Node.js
    C#
    PHP
    Python
    Ruby
    Perl

CI 插件也有 Jenkins, Travis, TeamCity, Bamboo。

我用 Node.js 作为示例，来体验一下 Automate。

**0x00**
首先创建一个 js 文件，大致如下

    var webdriver = require('selenium-webdriver');
    
    // 设置 capabilities
    var capabilities = {
        'browserstack.user' : 'Automate 用户名',
        'browserstack.key' : 'Access Key'
    }
    
    var driver = new webdriver.Builder().
        usingServer('http://hub-cloud.browserstack.com/wd/hub').
        withCapabilities(capabilities).
        build();
    
    driver.get('测试网页的 URL');
    driver.findElement(webdriver.By.name('q')).sendKeys('BrowserStack');
    driver.findElement(webdriver.By.name('btnG')).click();
    
    driver.getTitle().then(function(title) {
        console.log(title);
    });
    
    driver.quit();

**0x01**
capabilities 参数是浏览器的属性，只要修改它就可以了。

在 这里 可以选择不同的操作系统、浏览器和分辨率，它会自动生成一个 capabilities 参数，将里面的字段填入 js 文件中的 capabilities 即可。

capabilities 有几个常用的可选字段:

browserstack.local: 是否本地测试
project: 项目名称
build: 版本号
设置 project 和 build 可以使生成的记录更为规范。
![请输入图片描述][1]

**0x02**
Node.js 的 Automate 测试需要安装 selenium-webdriver，
创建一个文件夹，把刚才的 js 文件放进去，执行

npm install selenium-webdriver
等安装完成之后就可以测试了。

Local Testing

BrowserStack 不仅支持在线测试，还可以本地测试。本地测试有两种方式。

仅支持在 Chrome 31+ 或 Firefox 38+ 浏览器进行 Live 测试，，安装 Chrome 插件 即可。
浏览器不受限制的 Live 和 Automate 测试。需要先根据不同的操作系统 下载二进制文件，然后执行下载的文件。

    例如：macOS 和 Linux：
    
    ./BrowserStackLocal --key Access_Key


  [1]: https://qiniu.viosey.com/img/BrowserStack-Automate-Dashboard.png
