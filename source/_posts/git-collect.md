---
layout: drafts
title: git-all
date: 2019-05-29 10:20:18
tags:
---

## git-更改本地和远程分支的名称

git branch -m old_branch new_branch # Rename branch locally 

git push origin :old_branch # Delete the old branch 

git push --set-upstream origin new_branch # Push the new branch, set local branch to track the new remote
