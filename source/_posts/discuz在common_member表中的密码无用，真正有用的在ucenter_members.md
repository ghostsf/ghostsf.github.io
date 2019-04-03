title: discuz在common_member表中的密码无用，真正有用的在ucenter_members
categories: 技术栈
tags: [discuz]
date: 2016-04-22 09:13:55
---
common_member表中的password是随机生成的，没有用。
ucenter_members表中的用户名密码才会用于登录验证，以及修改密码等。
其中DZ的password加密方式是 md5(md5(password)+salt)
salt是在用户注册时产生的6位随机字符，用于密码加密，会保存在ucenter_members表的salt字段中，可用于密码修改。
