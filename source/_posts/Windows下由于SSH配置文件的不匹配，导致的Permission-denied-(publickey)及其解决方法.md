title: Windows下由于SSH配置文件的不匹配，导致的Permission denied (publickey)及其解决方法
categories: 旧文字
tags: [git,ssh]
date: 2016-11-05 05:33:50
---
很多情况下，Windows平台由于不原生支持ssh，只能使用如git bash openssh，putty等等工具或连接了不同的平台比如同时连接了码云和github等等会因为密钥文件储存位置不一致或者各个工具生成了自己的密钥而导致在连接码云的时候出现Permission denied (publickey)，当遇上这种问题是一般有两种解决办法，一种是只使用一种工具，这样就能保证密钥位置不会变动，然后在密钥的文件夹下创建config文件，然后填写如下内容：

    Host git.oschina.net
        HostName git.oschina.net
        User git
        IdentityFile ~/.ssh/id_rsa
        IdentitiesOnly yes

注意：以上参数中id_rsa这一栏请填写绝对地址，并且这一栏指定的私钥文件名字不一定要是id_rsa，也可以是别的文件名，这样就能保证使用ssh连接码云时使用的是指定的密钥而不会被干扰，但请注意，使用这种方法是请保证该密钥不会被覆盖
另一种方法是只使用一个密钥，所有平台均使用同一个密钥，这样就不会出现密钥不匹配的情况。