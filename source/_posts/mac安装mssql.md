+++
title =  "mac docker安装mssql"
date = 2018-05-16T13:19:16+08:00
tags = [
    "mssql","docker","mac"
]
+++

# mac docker安装mssql

### 1. 安装docker

+ 阿里云提供的

  http://mirrors.aliyun.com/docker-toolbox/mac/docker-for-mac/?spm=5176.8351553.0.0.400c1991vRDiR9

+ 官网下载

  https://www.docker.com/enterprise-edition

### 2.设置阿里云镜像

关于加速器的地址，你只需要登录[容器Hub服务](https://cr.console.aliyun.com/)的控制台，左侧的加速器帮助页面就会显示为你独立分配的加速地址。

![image-20180516124735171](https://ws2.sinaimg.cn/large/006tNc79gy1frd32y4siij30w00b4dh7.jpg)

右键点击桌面顶栏的 docker 图标，选择 Preferences ，在 Daemon 标签（Docker 17.03 之前版本为 Advanced 标签）下的 Registry mirrors 列表中将分配的加速地址加到"registry-mirrors"的数组里，点击 Apply & Restart按钮，等待Docker重启并应用配置的镜像加速器。

### 3. docker安装mssql-server-linux

`` docker pull microsoft/mssql-server-linux ``

### 4. 启动docker镜像

```
docker run -d --name mssql -e'ACCEPT_EULA=Y' -e 'SA_PASSWORD=reallyStrongPwd123' -p  1433:1433 microsoft/mssql-server-linux
```

这里是参数的解释：

- `-d`

  此可选参数以守护进程模式启动Docker容器。 这意味着它在后台运行，不需要打开自己的终端窗口。 您可以省略此参数以使容器在其自己的“终端”窗口中运行。

- `--name mssql`

  另一个可选参数。 这个参数允许你命名容器。 从终端停止并启动容器时，这可能非常方便。

- `-e 'ACCEPT_EULA=Y'`

  `Y`表示您同意EULA（最终用户许可协议）。 为了在Linux上运行SQL Server for Linux，这是必需的。

- `-e 'SA_PASSWORD=reallyStrongPwd123'`

  设置`sa`数据库密码的必需参数。

- `-p 1433:1433`

  这将本地端口1433映射到容器上的端口1433。 这是SQL Server用来侦听连接的默认TCP端口。

- `microsoft/mssql-server-linux`

  这告诉Docker使用哪个图像。

**密码强度**

官方的文档和说明已经很详细了，这里需要注意一点，SA的密码一定要设置成强密码。不然回报如下的错误：

```
Microsoft（R）SQL Server（R）安装失败，错误代码为1.请查看/ var / opt / mssql / log中的安装日志以获取更多信息。
```

**SA管理员强密码：至少8歌字符，包含大小写字母，数字或者特殊符号。**

### 5. Enjoy!

启动成功后即可使用mssql了。可以使用Navicat Premium之类的工具连接使用。

