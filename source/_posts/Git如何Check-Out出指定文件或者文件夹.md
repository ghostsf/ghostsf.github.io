title: Git如何Check Out出指定文件或者文件夹
categories: 旧文字
tags: [git]
date: 2016-11-04 12:11:48
---
允许使用Sparse Checkout模式

    $git config core.sparsecheckout true

接下来你需要告诉Git哪些文件或者文件夹是你真正想Check Out的，你可以将它们作为一个列表保存在.git/info/sparse-checkout文件中。 

    $echo "ghostsf" >> .git/info/sparse-checkout

最后，你只要以正常方式从你想要的分支中将你的项目拉下来就可以了：

    $git pull origin master

具体您可以参考Git的Sparse checkout文档： 
[http://schacon.github.io/git/git-read-tree.html#_sparse_checkout][1]


  [1]: http://schacon.github.io/git/git-read-tree.html#_sparse_checkout