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

```
// Unix & OS X
./nexus run

// Windows  
nexus.exe /run
```

```
nexus run 前台运行，可以实时查看运行log

nexus start 后台运行

nexus stop 关闭
```

默认端口: 8081

默认的管理员账号密码为

```
username：admin
password：admin123
```

nexus3 安全性提高了些，admin的密码在`~/sonatype-work/nexus3/admin.password`文件里


## 0x04 配置

配置文件地址

`./etc/nexus-default.properties` 可配置端口等参数

`./bin/nexus.vmoptions` 可配置数据存储的目录以及内存参数等


## 0x05 其他配置

**服务自启**

在/etc/systemd/system/下创建nexus.service文件

`vi /etc/systemd/system/nexus.service`

```
[Unit]

Description=nexus service

After=network.target
  
[Service]

Type=forking

LimitNOFILE=65536

ExecStart=~/bin/nexus start

ExecStop=~/bin/nexus stop

User=nexus

Restart=on-abort
  
[Install]

WantedBy=multi-user.target
```



**systemctl命令**

更新systemctl

`sudo systemctl daemon-reload`

设置开机启动

`sudo systemctl enable nexus.service`

启动nexus服务

`sudo systemctl start nexus.service`

查看nexus服务状态

`sudo systemctl status nexus.service`

查看日志

`tail -f ~/sonatype-work/nexus3/log/nexus.log`



## 0x06 使用配置

**maven**

**maven发布包**

pom.xml 参考

```
<distributionManagement>

    <repository>
    
        <id>nexus-releases</id>
        
        <name>private-nexus-library-releases</name>
        
        <url>http://{host}/repository/maven-releases/</url>
        
    </repository>
    
    <snapshotRepository>
    
        <id>nexus-snapshots</id>
        
        <name>private-nexus-library-snapshots</name>
        
        <url>http://{host}/repository/maven-snapshots/</url>
        
    </snapshotRepository>
</distributionManagement>
```

maven settings.xml 参考

```
<servers>

<server>

  <id>nexus-releases</id>

  <username>username</username>

  <password>password</password>

</server>

<server>

  <id>nexus-snapshots</id>

  <username>username</username>

  <password>password</password>

</server>

</servers>
```

**maven使用 **

mirrors add

```xml
<mirror>

    <id>nexus-private</id>
    
    <mirrorOf>*</mirrorOf>
    
    <name>Nexus private</name>
    
    <url>http://{host}/repository/maven-public/</url>
</mirror>
```


ps：若设置了不允许匿名用户访问
则使用远程仓库的时候需要使用鉴权URL

eg: 

```xml
<mirror>

    <id>nexus-private</id>
    
    <mirrorOf>*</mirrorOf>
    
    <name>Nexus private</name>
    
    <url>http://{username}:{password}@{host}/repository/maven-public/</url>
</mirror>
```


// todo 还有很多要整理 有空出个相关专题文章吧


## 0x07 注意事项

**修改运行用户**

```shell
WARNING: ************************************************************

WARNING: Detected execution as "root" user.  This is NOT recommended!

WARNING: ************************************************************
```

创建一个单独的用户进行运行，安全一些

`adduser nexus`

`passwd nexus`

然后修改nexus为运行用户

`vi ./bin/nexus.rc`

取消注释，并修改为如下内容

`run_as_user="nexus"`

修改nexus3文件的所有者

`chown -R nexus:nexus ~/nexus3/`


**备份迁移**

默认配置 nexus的数据都在此目录下

`sonatype-work`

该目录可在`./bin/nexus.vmoptions`自定义配置

需要备份迁移，只要打包这个目录即可











