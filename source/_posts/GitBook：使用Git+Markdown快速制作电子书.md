title: GitBook：使用Git+Markdown快速制作电子书
categories: 技术栈
tags: [gitbook]
date: 2015-10-08 02:36:00
---
> GitBook 是一个命令行工具（也是 Node.js 库），让你能够使用 GitHub/Git 和 Markdown 构建出美丽的编程书籍，可以包含互动的练习。GitBook 支持使用多种语言构建书籍。每种语言都应该是按照正常 GitBook 格式的子目录，另外要在版本库根目录下的 LANGS.md 文件。

**GitBook支持输出多种文档格式：**
- 静态站点：GitBook默认输出该种格式，生成的静态站点可直接托管搭载Github Pages服务上；
- PDF：需要安装gitbook-pdf依赖；
- eBook：需要安装ebook-convert；
- 单HTML网页：支持将内容输出为单页的HTML，不过一般用在将电子书格式转换为PDF或eBook的中间过程；
- JSON：一般用于电子书的调试或元数据提取。

**结构简单，使用方便**
使用GitBook制作电子书，必备两个文件：README.md和SUMMARY.md。README.md多为电子书的简介内容，SUMMARY.md用来定义电子书章节结构，如：
![gitbook SUMMARY.md.jpg][1]
同时，GitBook还支持嵌入JavaScript的交互式内容，未来版本会支持Python、Ruby等语言。

**在自己服务器上安装使用教程**
可参考：[在自己的服务器上安装GitBook][2]

**传送门:**
GitBook项目官网：[http://www.gitbook.io][3]
GitBook Github地址：[https://github.com/GitbookIO/gitbook][4]


  [1]: http://www.ghostsf.com/usr/uploads/2015/10/2483296412.jpg
  [2]: http://blog.csdn.net/ys743276112/article/details/45130831
  [3]: http://www.gitbook.io
  [4]: https://github.com/GitbookIO/gitbook
