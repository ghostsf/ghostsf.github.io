---
layout: post
title: git各案例命令记录
date: 2020-03-25 10:20:18
tags:
---

## 更改本地和远程分支的名称

git branch -m old_branch new_branch # Rename branch locally

git push origin :old_branch # Delete the old branch

git push --set-upstream origin new_branch # Push the new branch, set local branch to track the new remote

## 打增量更新包

git diff {old commit version} {new commit version} --name-only | xargs tar -czvf update.tar.gz
