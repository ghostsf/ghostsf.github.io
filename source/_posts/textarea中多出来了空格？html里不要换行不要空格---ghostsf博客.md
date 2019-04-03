title: textarea中多出来了空格？html里不要换行不要空格 - ghostsf博客
categories: 技术栈
tags: []
date: 2016-07-27 10:30:00
---
`<textarea>` 标签定义多行的文本输入控件。
文本区中可容纳无限数量的文本，其中的文本的默认字体是等宽字体（通常是 Courier）。

若果不作设置或不设定wrap，`<textarea>`和`</textarea >`之间的文字和符合、空格等都会被当作textarea的值，在html页面上展现出来。

为了避免`<textarea>`标签莫名多出来N多空格，`<textarea>`应该紧跟靠拢着写;

即，把如下形式：

    <textarea.....>   
       内容.....   
    </textarea>   

改成

    <textarea.....> 内容.....</textarea>   
