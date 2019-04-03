---
title: "Git"
date: 2018-05-25T10:40:26+08:00
categories: 技术栈
tags: [ "git"]
draft: false
---

# Git教程笔记
教程来自:[廖雪峰的官方网站](https://www.liaoxuefeng.com/wiki/0013739516305929606dd18361248578c67b8067c8c017b000)
## Git简介
### Git的诞生
Linux的创始人Linus在2005年花两周时间用C语言写成，迅速成为最流行的分布式版本控制系统。

2008年Github网站上线，它为开源项目免费提供Git存储。

### 集中式VS分布式
CVS和SVN都是集中式版本控制系统，而Git是分布式版本控制系统。

**集中式版本控制系统**的版本库集中放在中央服务器，每次需从中央服务器取回最新版本，再开始干活，干完活再把自己的活推送给中央服务器。最大的**缺点**就是必须联网工作。

**分布式版本控制系统**没有中央服务器，每个人的电脑上都有一个完整的版本库。通常分布式版本控制系统也有一台充当“中央服务器”的电脑，但仅作用于方便“交换”大家的修改。**优势**是不必联网，还有强大的分支管理。

### 安装git
略
### 创建版本库
* 第一步，找到合适的地方，创建一个空目录

```
$ mkdir learngit
$ cd learngit
```
* 第二步，通过`git init`把这个目录变成git可以管理的仓库:

```
$git init
```
可以通过`ls -ah`命令可以看到隐藏的`.git`目录。

<!--more-->

### 添加文件到Git仓库
* 第一步，使用命令`git add <file>`，可反复多次使用，添加多个文件。
* 第二步，使用命令`git commit`，加上需要备注的内容，完成。

## 时光机穿梭
* 使用`git status`掌握仓库当前状态，如待提交等
* 使用`git diff`查看对文件进行了什么修改，difference。

### 版本回退
![](https://cdn.liaoxuefeng.com/cdn/files/attachments/001384907584977fc9d4b96c99f4b5f8e448fbd8589d0b2000/0)
* `HEAD`指向的版本就是当前的版本，版本穿梭使用命令`git reset --hard commit_id`，上个版本是`HEAD^`,上上个版本是`HEAD^^`,往上100个版本是`HEAD~100`

* 穿梭前，用`git log`可以查看提交历史，以便确定要回退到哪个版本。如果嫌输出信息太多，可以加上`--pretty=online`参数。

* 要重返未来，用`git reflog`查看命令历史，以便确定要回到未来的哪个版本。
### 工作区和暂存区
* 工作区: 就是在电脑里能看到的目录
* 版本库: 工作区隐藏目录`.git`，是Git的版本库。

Git的版本库中存了很多东西，最重要的有暂存区(stage)，还有git为我们自动创建的第一个分支`master`，以及指向`master`的指针叫`HEAD`
![](https://cdn.liaoxuefeng.com/cdn/files/attachments/001384907702917346729e9afbf4127b6dfbae9207af016000/0)

所以`git add`就是把要提交的多有修改放到暂存区(stage)，然后执行`git commit`就可以一次性把暂存区的所有修改提交到分支。

### 管理修改
第一次修改 -> `git add` -> 第二次修改 -> `git commit`

(第二次修改不会被提交)

第一次修改 -> `git add` -> 第二次修改 -> `git add` -> `git commit`

(这样就能提交第二次修改了)

### 撤销修改
* 场景一：想直接丢掉工作区修改时，用`git checkout -- file`，撤销回和版本库一样的状态。
* 场景二：不但修改了文件，还添加到了暂存区时，想丢弃修改，分两步，第一步用`git reset HEAD <file>`，回到场景1，第二步再按场景一操作。
* 已经提交了不合适的修改到版本库时，想要撤销本次提交，参考之前版本回退一节，使用`git reset --hard commit_id`进行版本回退。前提是没有提交到远程库。

### 删除文件
* 命令`git rm`用于删除一个文件。如果一个文件已经被提交到版本库，那么你永远不用担心误删，但是要小心，你只能恢复文件到最新版本，你会丢失最近一次提交后你修改的内容。
* 不小心删错时，可以用`git checkout -- <file>`，轻松把误删文件恢复到最新版本。这个操作其实是用版本库里的版本替换工作区的版本，无论修改或删除都能一键还原。

## 远程仓库
除了可以自己搭建一台运行Git的服务器，还可以将代码先托管在GitHub(Git的远程仓库)上。

由于本地Git和GitHub仓库之间是通过SSH加密的，所以需要一点设置：

* 第1步：创建SSH key。在用户主目录下，看看有没有.ssh目录，如果有，再看看这个目录下有没有id_rsa和id_rsa.pub这两个文件，如果已经有了，可直接跳到下一步。如果没有，打开Shell（Windows下打开Git Bash），创建SSH Key：
```
$ ssh-keygen -t rsa -C "youremail@example.com"
```
如果一切顺利的话，可以在用户主目录里找到.ssh目录，里面有id_rsa和id_rsa.pub两个文件，这两个就是SSH Key的秘钥对，id_rsa是私钥，不能泄露出去，id_rsa.pub是公钥，可以放心地告诉任何人。

* 第2步：登陆GitHub，打开“Account settings”，“SSH Keys”页面，然后，点“Add SSH Key”，填上任意Title，在Key文本框里粘贴id_rsa.pub文件的内容：
![](https://cdn.liaoxuefeng.com/cdn/files/attachments/001384908342205cc1234dfe1b541ff88b90b44b30360da000/0)
点“Add Key”，你就应该看到已经添加的Key。

当然，GitHub允许你添加多个Key。假定你有若干电脑，你一会儿在公司提交，一会儿在家里提交，只要把每台电脑的Key都添加到GitHub，就可以在每台电脑上往GitHub推送了。

### 添加远程库
* 首先登陆Github新建一个仓库"Create a new repo"
* 在本地仓库下运行命令：

	```
	git remote add origin git@github.com:michaelliao/learngit.git
	```
* 把本地库的内容推送到远程，用`git push`命令，实际上是把当前的分支`master`推送到远程。(`git push -u origin master`，默认叫法`origin`，也可以改成别的)
* 由于远程库是空的，我们第一次推送到分支上时，加上了`-u`参数，Git不但会把本地的`master`分支内容推送到远程的`master`分支，还会把本地的`master`分支和远程的`master`分支关联起来，在以后的推送或者拉取时就可以简化命令
* 之后只要本地做了提交，就可以通过命令`git push origin master`把本地`master`分支的最新修改推送至Github

**分布式版本系统的最大好处之一是在本地工作完全不需要考虑远程库的存在，有没有联网都可以正常工作，当有网络的时候，再把本地提交推送一下就完成了同步。而SVN在没有联网的时候是无法工作的。**

### 从远程库克隆
*如果从0开发，最好的方式是先创建远程库，然后从远程库克隆*

* 知道仓库地址后，使用`git clone`命令克隆

	```
	git clone git@github.com:michaelliao/gitskills.git
	```
* Git支持多种协议，包括`https`，但通过`ssh`支持原生`git`协议速度最快

## 分支管理
*可以创建属于自己的分支，等到开发完毕后再一次性合并到原来的分支上，这样既安全又不影响别人工作。*

### 创建与合并分支

* `HEAD`严格来说不指向提交，而是指向`master`，而`master`才是指向提交的，所以，`HEAD`就是只想当前的分支。

* 每次提交`master`分支都会向前移动一步，这样随着不断提交，`master`分支的线也越来越长。

* 当创建新的分支(例如`dev`)时，Git新建了一个指针叫`dev`，指向`master`相同的提交，再把`HEAD`指向`dev`,就标识当前分支在`dev`上
* 再对工作区的修改和提交就是针对`dev`分支了，比如新提交一次后，`dev`指针往前移动一步，而`master`指针不变。
![](https://cdn.liaoxuefeng.com/cdn/files/attachments/0013849088235627813efe7649b4f008900e5365bb72323000/0)
* 加入在`dev`上的工作完成了，就可以把`dev`合并到`master`上。就是直接把`master`指向`dev`的当前提交，就完成了合并
![](https://cdn.liaoxuefeng.com/cdn/files/attachments/00138490883510324231a837e5d4aee844d3e4692ba50f5000/0)

* 所以合并分支就是相当于修改了指针，工作区内容不变。
* 合并完分之后，甚至可以删除`dev`分支。删除`dev`分支就是把`dev`指针给删掉，删掉后，我们就剩下了一条`matser`分支。

实战:

```
//创建`dev`分支，然后切换到`dev`分支
git checkout -b dev

//`git checkout`命令加上`-b`参数表示创建并切换，相当于以下两条命令：
git branch dev
git checkout dev

//然后用`git branch`命令查看当前分支，`git branch`就会列出所有分支，当前分支前面会标一个`*`号。
git branch

//我们就可以在`dev`分支上正常提交，比如对readme.txt做个修改
git add readme.txt
git commit -m "branch test"

//`dev`分支的工作完成后，我们就可以切换回`master`分支，切换后不会显示刚才的修改。
git checkout master

//把dev分支的工作成果合并到`master`分支上
git merge dev

//合并完成后，就可以放心地删除`dev`分支了
git branch -d dev
```
**因为创建、合并和删除分支非常快，所以Git鼓励你使用分支完成某个任务，合并后再删除分支，这和直接在`master`分支上工作效果是一样的，但过程更安全**

###解决冲突
* `master`分支和`feature1`分支都各自有了新的提交。这种情况下，Git无法执行“快速合并”，只能试图把各自的修改合并起来，但这种合并就可能会有冲突。
![](https://cdn.liaoxuefeng.com/cdn/files/attachments/001384909115478645b93e2b5ae4dc78da049a0d1704a41000/0)

* `git status`也可以告诉我们冲突的文件
* 手动修改之后再做保存，之后再提交就可以了
```
git add readme.txt
git commit -m "conflict fixed"
```
![](https://cdn.liaoxuefeng.com/cdn/files/attachments/00138490913052149c4b2cd9702422aa387ac024943921b000/0)

* 用带参数的`git log`可以看到分支的合并情况

```
git log --graph --pretty==online --abbrev-commit
```

* 最后删除`feature1`分支`git branch -d feature`

### 分支管理策略
合并分支时，加上`--no-ff`参数就可以用普通模式合并，合并后的历史有分支，能看出来曾经做过合并，而**fast forward**合并就看不出来曾经做过合并。

### Bug分支
*软件开发中，bug就像家常便饭一样。有了bug就需要修复，在Git中，由于分支是如此的强大，所以，每个bug都可以通过一个新的临时分支来修复，修复后，合并分支，然后将临时分支删除。*
* 修复bug时，我们会通过创建新的bug分支进行修复，然后合并，最后删除；

* 当手头工作没有完成时，先把工作现场`git stash`一下，然后去修复bug，修复后，再git stash pop，回到工作现场。

### Feature分支
*添加一个新功能时，你肯定不希望因为一些实验性质的代码，把主分支搞乱了，所以，每添加一个新功能，最好新建一个feature分支，在上面开发，完成后，合并，最后，删除该feature分支。*
如果要丢弃一个没有被合并过的分支，可以通过`git branch -D <name>`强行删除

### 多人协作
* 查看远程库信息，使用git remote -v；

* 本地新建的分支如果不推送到远程，对其他人就是不可见的；

* 从本地推送分支，使用git push origin branch-name，如果推送失败，先用git pull抓取远程的新提交；

* 在本地创建和远程分支对应的分支，使用git checkout -b branch-name origin/branch-name，本地和远程分支的名称最好一致；

* 建立本地分支和远程分支的关联，使用git branch --set-upstream branch-name origin/branch-name；

* 从远程抓取分支，使用git pull，如果有冲突，要先处理冲突。

### Rebase
* rebase操作可以把本地未push的分叉提交历史整理成直线；

* rebase的目的是使得我们在查看历史提交的变化时更容易，因为分叉的提交需要三方对比。

## 标签管理
**tag就是一个让人容易记住的有意义的名字，它和某个commit绑在一起**

### 创建标签
* 命令`git tag <tagname>`用于新建一个标签，默认为HEAD，也可以指定一个commit id；

* 命令`git tag -a <tagname> -m "blablabla..."`可以指定标签信息；

* 命令`git tag`可以查看所有标签。

### 操作标签
* 命令`git push origin <tagname>`可以推送一个本地标签；

* 命令`git push origin --tags`可以推送全部未推送过的本地标签；

* 命令`git tag -d <tagname>`可以删除一个本地标签；

* 命令`git push origin :refs/tags/<tagname>`可以删除一个远程标签。

## 使用Github
* 在GitHub上，可以任意Fork开源仓库；

* 自己拥有Fork后的仓库的读写权限；

* 可以推送pull request给官方仓库来贡献代码。

## 码云
使用Github有时候会遇到访问速度慢的问题。
可以使用国内的Git托管服务 码云(gitee.com)
码云也提供免费的Git仓库。此外，还集成了代码质量检测、项目演示等功能。对于团队协作开发，码云还提供了项目管理、代码托管、文档管理的服务，5人以下小团队免费。

## 自定义Git
* 比如让git显示颜色：
```
git config --global color.ui true
```

* 忽略某些文件时，需要编写`.gitignore`
* `.gitignore`文件本身要放到版本库里，并且可以对.gitignore做版本管理！

* 给Git配置好别名，就可以输入命令时偷个懒。我们鼓励偷懒。

	```
	//设置完就可以使用 git st 代替 git status啦
	git config --global alias.st status
	```
* 搭建Git服务器非常简单，通常10分钟即可完成；要方便管理公钥，用Gitosis；
要像SVN那样变态地控制权限，用Gitolite。
