---
title: 修改git历史提交信息
copyright: true
date: 2019-12-26 10:33:53
tags: [git]
categories: 技术栈
---


修复 git 历史提交信息
To change the name and/or email address recorded in existing commits, you must rewrite the entire history of your Git repository.

为了修改 commit 的作者邮箱地址，你必须重写整个 git 仓库历史

Warning: This action is destructive to your repository's history. If you're collaborating on a repository with others, it's considered bad practice to rewrite published history. You should only do this in an emergency.

警告： 这个操作会破坏你的仓库历史， 如果你和别人在协同开发这个仓库，重写已发布的历史记录是一个不好的操作。建议只在紧急情况操作

操作步骤：

<!--more-->

打开 bash

Create a fresh, bare clone of your repository: （新建一个全新的仓库信息：)

    git clone --bare https://github.com/user/repo.git
    cd repo.git

Copy and paste the script, replacing the following variables based on the information you gathered: (在终端复制并粘贴以下脚本，并将以下的变量修改为你需要的)

**OLD_EMAIL**

**CORRECT_NAME**

**CORRECT_EMAIL**

脚本信息：

[git-commit-change.sh](https://gist.github.com/ghostsf/de39ebde3a50b0fcaf4f3de172940969)

Press Enter to run the script.（按下 enter 键来运行这个脚本

Review the new Git history for errors.(校对新的 git 仓库历史）

Push the corrected history to GitHub:（将修改后的仓库历史推到远程）

git push --force --tags origin 'refs/heads/*'
Clean up the temporary clone: (删除这个仓库)

cd ..
rm -rf repo.git