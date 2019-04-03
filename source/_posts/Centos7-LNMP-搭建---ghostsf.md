title: Centos7 LNMP 搭建 - ghostsf
categories: 技术栈
tags: [lnmp]
date: 2016-10-31 06:08:27
---
**一、关闭SELINUX**
       1、 查看SELINUX状态：
       /usr/sbin/sestatus -v
        或
       getenforce

       ##如果SELinux status参数为enabled即为开启状态
       SELinux status:                 enabled
       
       2、临时关闭（不用重启机器）：
        `setenforce 0`                  ##设置SELinux 成为permissive模式
        
        `setenforce 1`                   ## 设置SELinux 成为enforcing模式
        
      3、修改配置文件需要重启机器：
         vi /etc/selinux/config
         #SELINUX=enforcing #注释掉

         #SELINUXTYPE=targeted #注释掉

         SELINUX=disabled #增加

         :wq! #保存退出

         #重启之后使配置永久生效


**二、更新centos源**

   centos 7  :
   yum install epel-release
   rpm -Uvh https://dl.fedoraproject.org/pub ... latest-7.noarch.rpm
   #=====================================================
   centos 6 :
   yum install epel-release
   rpm -Uvh https://dl.fedoraproject.org/pub ... latest-6.noarch.rpm

**三、安裝 MySQL，現在可改為 MariaDB**    

   yum -y install mariadb-server mariadb
   systemctl start mariadb.service
   systemctl enable mariadb.service

如果出現這樣的錯誤，那就重開 Linux 吧，比較快…
  Another app is currently holding the yum lock; waiting for it to exit...
  The other application is: PackageKit
  Memory : 136 M RSS (1.5 GB VSZ)
  Started: Tue Dec  8 01:09:47 2015 - 01:21 ago
  State  : Uninterruptible, pid: 12947
  #==============================================

安装完毕后,启动数据库安全模式进行处理
    sudo  mysql_secure_installation 
    You will be asked for the root password. Because you didn't set it earlier, press Enter to set a password now.
    Type "Y" to set the root password.
    Enter and confirm the new password.
    You will be asked more questions as part of the security configuration. It is a best practice to respond "Y" to these system prompts

**四、安装Apache**     

    yum -y install httpd
    systemctl start httpd.service
    systemctl enable httpd.service
    firewall-cmd --permanent --zone=public --add-service=http
    firewall-cmd --permanent --zone=public --add-service=https
    firewall-cmd --reload

查看 localhost 就會出現畫面了。讓 Apache 可以支援 .htaccess ，須要把 AllowOverride 的功能開啟。如使用框架 Codeigniter 就須要設定。

    vim /etc/httpd/conf/httpd.conf

因為我的網頁預設在

    DocumentRoot "/var/www/html"

所以將 None 修改為 All 

    <Directory "/var/www/html">
         AllowOverride All
    </Directory>

重新启动

    sudo systemctl restart httpd

**五、安装php**
PHP5.6安装centos
yum install --enablerepo=remi,remi-php56 php php-devel php-mbstring php-pdo php-gd php-mysql php-common php-xmlrpc php-pear php-xml php-fpm ----可以添加
php-ldap php-odbc php-snmp php-soap php-mcrypt curl curl-devel  --未测试

Php7.x 安装 centos
yum install --enablerepo=remi,remi-php70 php php-devel php-mbstring php-pdo php-gd php-mysql php-common php-xmlrpc php-pear php-xml php-fpm ---可以添加
Test PHP processing on Apache
Create a new PHP file under the /var/www/html directory:         sudo vim /var/www/html/info.php
When the file opens, type in the following code:<?phpphpinfo();?>
Save and close the file:      :wq!
To verify it worked, type this URL in your browser:
http://your server's IP address/info.php
A page displays with the PHP version, extensions, build date, and other information.

**六、建立FTP**     

    yum -y install vsftpd
    vim /etc/vsftpd/vsftpd.conf

透過 vi 修改為

    anonymous_enable=NO

接著下指令

    systemctl restart vsftpd
    systemctl enable vsftpd
    firewall-cmd --permanent --add-port=21/tcp
    firewall-cmd --reload

啟動FTP

    firewall-cmd --permanent --zone=public --add-service=http
    firewall-cmd --permanent --zone=public --add-service=https 
    firewall-cmd --reload
    #================================================firewall-cmd --permanent --add-port=21/tcp 
    firewall-cmd --permanent --add-service=ftp 
    firewall-cmd --reload
    #================================================
    setsebool -P ftp_home_dir   1
    setsebool -P ftpd_use_passive_mode  1
    #================================================
    setsebool -P ftpd_anon_write  1
    setsebool -P ftpd_full_access  1
    setsebool -P httpd_can_network_connect on    (要設定這個，才能透過smtp.gmail.com寄信)
    #===============================================
    sudo systemctl   restart   vsftpd 

接著就可以使用 Linux 原本系統已存在的使用者做登入。
