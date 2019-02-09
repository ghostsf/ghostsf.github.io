title: php composer常用命令与简单使用 - ghostsf博客
categories: 
tags: []
date: 2016-09-13 08:40:30
---
**常用命令:**
`composer list`  列出所有可用的命令
`composer init`   初始化composer.json文件(就不劳我们自己费力创建啦)，会要求输入一些信息来描述我们当前的项目，还会要求输入依赖包
`composer install`  读取composer.json内容，解析依赖关系，安装依赖包到vendor目录下
`composer update`   更新最新的依赖关系到compsoer.lock文件，解析最新的依赖关系并且写入composer.lock文件
`composer search packagename` 搜索包，packagename替换为你想查找的包名称
`composer require packagename` 添加对packagename的依赖，packagename可修改为你想要的包名称
`composer show packagename` 显示packagename
`composer self-update` 更新 composer.phar文件自身
`composer command --help` 以上所有命令都可以添加 --help选项查看帮助信息

**简单使用：**
在项目根目录下手动创建composer.json,然后再`php composer.phpar install`
如果想删除对某个包的依赖，只能是手动删除vendor目录下的包，然后 `php composer.phar update`