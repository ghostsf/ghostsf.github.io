title: web开发 - 单向数据绑定与双向数据绑定 - ghostsf博客
categories: 技术栈
tags: []
date: 2016-07-14 09:59:16
---
单向数据绑定：指的是我们先把模板写好，然后把模板和数据（数据可能来自后台）整合到一起形成HTML代码，然后把这段HTML代码插入到文档流里面。
![1.png][1]
单向数据绑定缺点：HTML代码一旦生成完以后，就没有办法再变了，如果有新的数据来了，那就必须把之前的HTML代码去掉，再重新把新的数据和模板一起整合后插入到文档流中。

双向数据绑定：数据模型（Module）和视图（View）之间的双向绑定。
![1.png][2]
用户在视图上的修改会自动同步到数据模型中去，同样的，如果数据模型中的值发生了变化，也会立刻同步到视图中去。

双向数据绑定的优点是无需进行和单向数据绑定的那些CRUD（Create，Retrieve，Update，Delete）操作

双向数据绑定最经常的应用场景就是表单了，这样当用户在前端页面完成输入后，不用任何操作，我们就已经拿到了用户的数据存放到数据模型中了。

目前。实现双向数据绑定的前端框架主要有AngularJS，VueJS等

不过，我目前来说双向数据绑定的应用场景非常有限。
backbonejs不实现双向数据绑定的解释：大概的意思就是双向数据绑定在实际的运用中很少，没必要

"Two way data-binding" is avoided. While it certainly makes for a nifty demo, and works for the most basic CRUD, it doesn't tend to be terribly useful in your real-world app. Sometimes you want to update on every keypress, sometimes on blur, sometimes when the panel is closed, and sometimes when the "save" button is clicked. In almost all cases, simply serializing the form to JSON is faster and easier. All that aside, if your heart is set, go for it.

  [1]: http://www.ghostsf.com/usr/uploads/2016/07/4272079052.png
  [2]: http://www.ghostsf.com/usr/uploads/2016/07/1274438625.png
