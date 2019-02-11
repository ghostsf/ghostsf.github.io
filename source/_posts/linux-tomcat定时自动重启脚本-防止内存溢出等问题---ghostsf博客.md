title: linux tomcat定时自动重启脚本 防止内存溢出等问题 - ghostsf博客
categories: 技术栈
tags: [tomcat]
date: 2016-07-28 06:38:00
---
为了防止tomcat的内存溢出等问题，可以定时自动重启，以降低运行风险，保持tomcat最佳性能。
写一个shell脚本timerestart.sh来做这件事情，然后用crontab定时执行即可：

       #!/bin/sh  
      
    . /etc/profile  
      
    pid=`ps aux | grep tomcat | grep -v grep | grep -v retomcat | awk '{print $2}'`  
    echo $pid  
      
    if [ -n "$pid" ]  
    then  
    {  
       echo ===========shutdown================  
       /var/apache-tomcat-7.0.63/bin/shutdown.sh  
       sleep 1   
       pid=`ps aux | grep tomcat | grep -v grep | grep -v retomcat | awk '{print $2}'`  
       if [ -n "$pid" ]  
       then  
        {  
          sleep 1   
          echo ========kill tomcat==============    
          kill -9 $pid  
        }  
       fi  
       sleep 1  
       echo ===========startup.sh==============  
       /var/apache-tomcat-7.0.63/bin/startup.sh  
     }  
    else  
    echo ===========startup.sh==============  
    /var/apache-tomcat-7.0.63/bin/startup.sh  
      
    fi

将此shell脚本文件timerestart.sh放到服务器，然后赋予可执行权限：

    chmod a+x timerestart.sh

在控制台上输入以下命令

      crontab -e

按i键编辑这个文本文件，输入以下内容，每天凌晨3：30重启tomcat

      30 03 * * * /root/timerestart.sh

启动定时服务

    service crond stop
    
    service crond start

查看定时任务

    crontab -l -u xxx

列出所有xxx用户的定时任务

查看定时任务日志

    tail -f /var/log/cron 
