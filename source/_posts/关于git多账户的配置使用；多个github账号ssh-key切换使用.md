title: 关于git多账户的配置使用；多个github账号ssh key切换使用
categories: 技术栈
tags: [git]
date: 2016-04-27 08:09:00
---
新建ssh key:
`ssh-keygen -t rsa -C "youremail@email.com"`  # 新建新帐号的SSH key

**设置名称为id_rsa_new(当然这边文件名可随意了)**
Enter file in which to save the key (/c/Users/Administrator/.ssh/id_rsa): /c/Users/Administrator/.ssh/id_rsa_new

这样你新建好了新账号（新邮箱）的SSH Key

但是这个时候有个问题是，**SSH 默认只读取id_rsa**
这时候需要将新密钥添加到SSH agent中
具体做法是：

    ssh-add ~/.ssh/id_rsa_new
如果出现Could not open a connection to your authentication agent的错误，就试着用以下命令：

    ssh-agent bash
    ssh-add ~/.ssh/id_rsa_new

当然没有ssh-agent的也没关系，ssh-agent其实就是一个密钥管理器，它是方便在不的主机间进行漫游的，我们直接ssh name（当然这边是config里定义的host值），就能验证登录了。

**这里看下ssh config的配置：**
在.ssh目录下创建config文件：

    Host ghostsf
        HostName github.com
        User ghostsf
        IdentityFile ~/.ssh/id_rsa
    Host ghostsu
        HostName github.com
        User ghostsu
        IdentityFile ~/.ssh/id_rsa_new

**当然这里要注意的是 Host的值是可以随便写的，他是一个别名，然后要注意的是git push的时候会根据这个别名来找对应的私钥。**
所以这里要知道的是：
其规则就是：**从上至下读取config的内容，在每个Host下寻找对应的私钥。**
这里将GitHub SSH仓库地址中的git@github.com替换成新建的Host别名如：ghostsu，那么原地址是：git@github.com:ghostsu/ghostsu.github.io.git，替换后应该是：ghostsu:ghostsu/ghostsu.github.io.git.
**当然这个是在本地项目仓库.git目录下的config文件里修改：**

    [core]
    	repositoryformatversion = 0
    	filemode = false
    	bare = false
    	logallrefupdates = true
    	symlinks = false
    	ignorecase = true
    	hideDotFiles = dotGitOnly
    [remote "origin"]
    	url = ghostsu:ghostsu/ghostsu.github.io.git
    	fetch = +refs/heads/*:refs/remotes/origin/*
    [branch "master"]
    	remote = origin
    	merge = refs/heads/master
    [user]
    	name = ghostsu
    	email = ghostsf@sina.cn

以上。

此时，就完成了git多账户的配置，多github账号的ssh key的切换。其间，配置是否成功，可以用ssh T host来测试，当然这里的host是你配置的Host值。
