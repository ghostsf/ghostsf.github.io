---
title: 自建maven私有仓库实践
copyright: true
date: 2019-12-24 15:20:35
tags: [maven,nexus,私有仓库]
categories: 技术栈
---

> 记录一次自建maven私有仓库的过程 = = ， 其实是为了凑个更新

## 0x01 仓库管理软件

目前比较流行的有Apache基金会的 Archiva，JFrog 的 Artifactory ，Sonatypec 的 Nexus

## 0x02 环境

要求 Java 8 Runtime Environment或者以上

## 0x03 下载运行Nexus

去 [官网](https://help.sonatype.com/repomanager3/download/download-archives---repository-manager-3) 根据你的操作系统选择下载

进入bin目录，运行即可

`// Unix & OS X
./nexus run

// Windows  
nexus.exe /run`

`nexus run 前台运行，可以实时查看运行log
nexus start 后台运行
nexus stop 关闭`

默认端口: 8081

默认的管理员账号密码为

`username：admin
password：admin123`

nexus3 安全性提高了些，admin的密码在`~/sonatype-work/nexus3/admin.password`文件里


## 0x04 配置

配置文件地址

`./etc/nexus-default.properties` 可配置端口等参数

`./bin/nexus.vmoptions` 可配置内存参数


## 0x05 发布包配置

> todo
> - - 有空再整理吧



## 0x06 注意事项

`WARNING: ************************************************************
WARNING: Detected execution as "root" user.  This is NOT recommended!
WARNING: ************************************************************`

创建一个单独的用户进行运行，安全一些

`useradd nexus`
`password nexus`

> todo


