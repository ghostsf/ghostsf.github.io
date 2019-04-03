title: maven国内中央仓库推荐
categories: 技术栈
tags: [maven]
date: 2016-05-10 07:22:00
---
maven osc 的不能使用了 推荐一个阿里云的

阿里云maven仓库地址
http://maven.aliyun.com/nexus/#view-repositories;public~browsestorage

    <mirror>
            <id>nexus-aliyun</id>
            <mirrorOf>*</mirrorOf>
            <name>Nexus aliyun</name>
            <url>http://maven.aliyun.com/nexus/content/groups/public</url>
    </mirror> 
