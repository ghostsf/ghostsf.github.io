title: linux删除服务器上tomcat或apache等log日志shell脚本 - ghostsf
categories: 技术栈
tags: []
date: 2017-03-13 08:48:51
---
废话不多说，直接上脚本。

    #!/bin/sh
    #File date format
    DATE='/bin/date +%Y%m%d'
    #Arcive period
    DAYS=60                #删除多少天的日志 #删除多少天的日志
    HOSTNAME='hostname -a'
    #日志路径
    TOMCAT_LOG_DIR=/home/www/logs/tomcat    
    #日志位置
    APACHE_LOG_DIR=/var/log/httpd

    ### Delete old log ###
    **delete_old_log**(){
    find $TOMCAT_LOG_DIR -mtime +$DAYS -name "catalina.out*" -exec rm -fr {} \;
    find $APACHE_LOG_DIR -mtime +$DAYS -name "access_log*"   -exec rm -fr {} \;
    find $APACHE_LOG_DIR -mtime +$DAYS -name "error_log*"    -exec rm -fr {} \;
    }

    ## compress tomcat log files
    **compress_log**(){
    if[-f $TOMCAT_LOG_DIR/catalina.out.$HOSTNAME.$DATE];
    then/bin/nice /usr/bin/gzip -f $TOMCAT_LOG_DIR/catalina.out.$HOSTNAME.$DATE fi
    #compress apache log files
    if[-f $APACHE_LOG_DIR/access.log.$DATE3];
    then/bin/nice /usr/bin/gzip -f $APACHE_LOG_DIR/access.log.$DATE3 fi
    if[-f $APACHE_LOG_DIR/error.log.$DATE3];
    then/bin/nice /usr/bin/gzip -f $APACHE_LOG_DIR/error.log.$DATE3 fi
    if[-f $APACHE_LOG_DIR/mod_jk.log.$DATE4];
    then/bin/nice /usr/bin/gzip -f $APACHE_LOG_DIR/mod_jk.log.$DATE4 fi
    }

    ###Rotate catalina log###
     **rotate_catalina_log**(){
    if[-f $TOMCAT_LOG_DIR/catalina.out];
    then/bin/nice /bin/cp $TOMCAT_LOG_DIR/catalina.out $TOMCAT_LOG_DIR/catalina.out.$HOSTNAME.$DATE cat /dev/null>$TOMCAT_LOG_DIR/catalina.out fi
    }

    ###Main###
    echo "######## start script $0 exec:'date +%Y-%m-%d_%H:%M:%S'#############"
    delete_old_log 
    echo "######## end script $0 exec:'date +%Y-%m-%d_%H:%M:%S'##############"


相关方法已注释说明。

**用途：**
ghostsf维护服务器有几次发现服务器出现奇葩错误，检查了下发现是写入异常，然后发现磁盘满了。然后再已检查，累积的服务器log达到了上百G，这就尴尬了。所以定期清理这些日志文件是有必要的，尤其对那些空间容量小的服务器。

**使用方法：**
建一个.sh结尾的shell脚本文件，然后修改下相关服务器log日志文件目录，直接执行接口。
可以结合crontab，进行定期执行清理log的脚本。
当然脚本代码都在这里了，想怎么改就怎么改。

**方法说明：**
脚本里写了三个简单方法，当然你也可以自己修改或增加的。
delete_old_log（） 用来删除指定目录，指定时间内的log日志。当然这里指定的时间，是指设定的DAYS之前的日志。具体可参考find -mtime + 的含义。
compress_log() 用于压缩备份一下日志
rotate_catalina_log() 用于清空日志以及备份日志，不要备份就直接删掉`/bin/cp $TOMCAT_LOG_DIR/catalina.out $TOMCAT_LOG_DIR/catalina.out.$HOSTNAME.$DATE`即可。

