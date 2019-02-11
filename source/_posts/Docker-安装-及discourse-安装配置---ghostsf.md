title: Docker 安装 及discourse 安装配置 - ghostsf
categories: 技术栈
tags: [docker,discourse]
date: 2017-01-06 09:38:00
---
![index.png][1]

前言：之前ghostsf随意装了一个docker，docker的存储驱动为Devicemapper。这次索性也就将底层的docker版本也升级到新版，并更改Devicemapper为overlayfs。

由于操作系统是CentOS Linux release 7.1.1503 (Core)，内核版本3.10.0-229.el7.x86_64，该内核版本已经支持overlayfs。但是由于新的内核4.9已经发布，在4.9的内核版本中，对硬件和文件系统方面的改进也很多，涉及到 Btrfs、XFS、F2FS、OverlayFS 的 UBIFS 支持、FUSE 支持 POSIX ACL、OverlayFS SELinux 等方面。所以本次也将内核版本升级到4.9。


**1，系统环境**

       Centos 7
       Kernel Version:  3.10.0-->4.9.0
       Storage Driver:  DeviceMapper-->Overlayfs

**一：升级Kernel版本**
(1)安装yum源

    $ rpm -Uvh http://www.elrepo.org/elrepo-release-7.0-2.el7.elrepo.noarch.rpm
    Retrieving http://www.elrepo.org/elrepo-release-7.0-2.el7.elrepo.noarch.rpm
    warning: /var/tmp/rpm-tmp.X3PpyZ: Header V4 DSA/SHA1 Signature, key ID baadae52: NOKEY
    Preparing...                          ################################# [100%]
    Updating / installing...
       1:elrepo-release-7.0-2.el7.elrepo  ################################# [100%]

**(2)安装Kernel**

    $ yum -y --enablerepo=elrepo-kernel install  kernel-ml-devel-4.9.0 kernel-ml-4.9.0 
    ======================================================================= 
    Package           Arch      Version             Repository         Size
    ======================================================================= 
    Installing:
    kernel-ml         x86_64    4.9.0-1.el7.elrepo  elrepo-kernel      39 M
    kernel-ml-devel   x86_64    4.9.0-1.el7.elrepo  elrepo-kernel      11 M
    Transaction Summary
    ======================================================================== 
    Install  2 Packages
    Installed:
       kernel-ml.x86_64 0:4.9.0-1.el7.elrepo 
       kernel-ml-devel.x86_64 0:4.9.0-1.el7.elrepo

(3)检查当前版本

     $ uname -r

(4)检查kernel启动顺序

    $ awk -F\' '$1=="menuentry " {print $2}' /etc/grub2.cfg
    CentOS Linux (4.9.0-1.el7.elrepo.x86_64) 7 (Core)
    CentOS Linux (4.9.0-1.el7.elrepo.x86_64) 7 (Core) with debugging
    CentOS Linux 7 (Core), with Linux 3.10.0-229.el7.x86_64
    CentOS Linux 7 (Core), with Linux 0-rescue-f7e36a944a3d4035a61da37d8d4e2313

(5)设置启动kernel
 根据上面检查kernel启动顺序自上而下，从0开始的顺序。如果设置4.9启动那么如下命令
$ grub2-set-default 0
重启
$ reboot

(6)检查kernel版本
$ uname -r

Kernel 升级完毕！！！！

**二：Docker的升级、卸载、安装**
(1)关闭docker进程,卸载老版本

    $ systemctl stop docker 
    $ rpm -qa|grep docker
    docker-engine-1.9.1-1.el7.centos.x86_64
    docker-storage-setup-0.5-3.el7.centos.noarch
    docker-engine-selinux-1.9.1-1.el7.centos.noarch
    $ rpm -e docker-engine-1.9.1-1.el7.centos.x86_64
    $ rpm -e docker-engine-selinux-1.9.1-1.el7.centos.noarch

(2)安装新版本

    $ wget https://yum.dockerproject.org/repo/main/centos/7/Packages/docker-engine-selinux-1.12.2-1.el7.centos.noarch.rpm
    $ wget https://yum.dockerproject.org/repo/main/centos/7/Packages/docker-engine-1.12.2-1.el7.centos.x86_64.rpm

使用yum命令可以解决依赖问题，如果直接rpm命令安装可能会报错。

    $ yum install -y docker-engine-selinux-1.12.2-1.el7.centos.noarch.rpm
    $ yum install -y docker-engine-1.12.2-1.el7.centos.x86_64.rpm

安装最新版本的docker也可以采用下面这种方案：
官方支持 devicemapper，但是这东西一直出问题，应该说 Docker 跑在 devicemapper 上都不稳定。所以你要找办法装 aufs。你要装一个支持 AUFS 的内核，然后 Docker 应该就不会退而求其次地用 devicemapper 了

    1.   将OverlayFS加到module目录下	
    $ echo "overlay" > /etc/modules-load.d/overlay.conf
    2.   reboot 系统，执行lsmod看时候看到overlay
    $  lsmod | grep over
    overlay                42451  0
    3.    将Docker源添加到系统里
    $  cat >/etc/yum.repos.d/docker.repo<<E
    [dockerrepo]
    name=Docker Repository
    baseurl=https://yum.dockerproject.org/repo/main/centos/$releasever/
    enabled=1
    gpgcheck=1
    gpgkey=https://yum.dockerproject.org/gpg
    E
    到/etc/yum.repos.d/docker.repo查看baseurl的路径
    https://yum.dockerproject.org/repo/main/centos/7/---centos7
    https://yum.dockerproject.org/repo/main/centos/6/----centos6

4.   配置Docker Daemon用OverlayFS启动

    $ sudo mkdir -p /etc/systemd/system/docker.service.d
    sudo cat >/etc/systemd/system/docker.service.d/override.conf <<E
    [Service] 
    ExecStart= 
    ExecStart=/usr/bin/docker daemon --storage-driver=overlay -H fd:// 
    E

--说明
在修改docker启动配置时docker.service原来的默认配置中是这样的
ExecStart=/usr/bin/dockerd -H fd://
当我改成
ExecStart=/usr/bin/docker daemon --storage-driver=overlay -H fd://
启动的时候，docker报错了。
重点：在github查到了这个更新。1.12版本之后这个配置发生了改变。解决办法中将-H fd://从ExecStart指令中删除，改成如下方式解决。
ExecStart=/usr/bin/dockerd  daemon --storage-driver=overlay
就成功了！
每次修改conf配置文件都得执行

    # systemctl daemon-reload 
    5.   安装Docker，设置开机自启动
    $ sudo yum -y install docker-engine
    $ sudo sysctemctl start docker
    $ sudo systemctl enable docker

6.   Docker info 看一下，如果看到

    Storage Driver: overlay

那就证明更改成功，已经从Devicemapper换到了ovelay了（这也是个比较蛋疼的点，ghostsf曾用Devicemapper把CPU跑到了100%，= =）。

（3）检查新的docker版本

    $ docker -v
    Docker version 1.12.2, build bb80604

Docker升级完毕！！！


三：安装discourse
(1)安装 discourse

    $  sudo -s
    $  mkdir /var/discourse
    $  git clone https://github.com/discourse/discourse_docker.git /var/discourse
    $  cd /var/discourse

(2)配置 app.xml
app 的名称自取，此处直接命名为 app。
    拷贝默认配置文件
$ cp samples/standalone.yml containers/app.yml
配置 ruby 国内源
在 app.yml 添加一行 templates/web.china.template.yml。

    templates:
      - "templates/postgres.template.yml"
      - "templates/redis.template.yml"
      - "templates/web.template.yml"
      - "templates/web.ratelimited.template.yml"
      - "templates/web.china.template.yml"
     配置默认端口
这里改默认端口为 10080。
expose:
  - "10080:80"   # http
  - "10443:443" # https
配置邮箱
用于 administrator 的激活邮件。至关重要！
此处用的 163 邮箱。

    env:
      LANG: en_US.UTF-8
      # DISCOURSE_DEFAULT_LOCALE: en
      ## How many concurrent web requests are supported? Depends on memory and CPU cores.
      ## will be set automatically by bootstrap based on detected CPUs, or you can override
      #UNICORN_WORKERS: 3
      ## TODO: The domain name this Discourse instance will respond to
      ## 此处我个人直接配置 IP
      DISCOURSE_HOSTNAME: '172.18.xxx.xxx'
      ## Uncomment if you want the container to be started with the same
      ## hostname (-h option) as specified above (default "$hostname-$config")
      #DOCKER_USE_HOSTNAME: true
      ## TODO: List of comma delimited emails that will be made admin and developer
      ## on initial signup example 'user1@example.com,user2@example.com'
      ## 管理员邮箱列表，多个以逗号隔开
      DISCOURSE_DEVELOPER_EMAILS: 'your@163.com'
      ## TODO: The SMTP mail server used to validate new accounts and send notifications
      DISCOURSE_SMTP_ADDRESS: 'smtp.163.com'         # required
      DISCOURSE_SMTP_PORT: 25                        # (optional, default 587)
      DISCOURSE_SMTP_USER_NAME: 'your@163.com'      # required
      DISCOURSE_SMTP_PASSWORD: 'password'               # required, WARNING the char '#' in pw can cause problems!
      DISCOURSE_SMTP_ENABLE_START_TLS: true           # (optional, default true)
      DISCOURSE_SMTP_AUTHENTICATION: login
      DISCOURSE_SMTP_OPENSSL_VERIFY_MODE: none

强调：
   如果服务器是阿里的则要添加上：

     DISCOURSE_SMTP_AUTHENTICATION: login
     DISCOURSE_SMTP_OPENSSL_VERIFY_MODE: none

   如果服务器是国外的则不需要添加：

配置邮件的默认发送者：

将 ##- exec: rails r "SiteSetting.notification_email... 的 # 号去掉，并把邮箱设置为你自己的邮箱。

    ## Any custom commands to run after building
    run:
      - exec: echo "Beginning of custom commands"
      ## If you want to set the 'From' email address for your first registration, uncomment and change:
      ## After getting the first signup email, re-comment the line. It only needs to run once.
      - exec: rails r "SiteSetting.notification_email='your@163.com'"
      - exec: echo "End of custom commands"

调试邮件发送情况，查看 Log 文件 shared/standalone/log/rails/production.log。一个样例：

    Sent mail to sunnogo@163.com (20111.6ms)
    Job exception: end of file reached
    Sent mail to sunnogo@163.com (20241.3ms)
    Job exception: end of file reached

编译、启动 app

bootstrap 或 rebuild 的时间很长，特别是第一次运行时，要下载多个组件。

    sudo ./launcher bootstrap app
    sudo ./launcher start app

即可登陆你的 discourse 论坛开始配置了。


  [1]: http://www.ghostsf.com/usr/uploads/2017/01/2261348110.png
