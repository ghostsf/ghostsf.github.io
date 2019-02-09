title: php5.3.3拓展mcrypt模块error: ‘PHP_FE_END’ undeclared here (not in a function)
categories: 
tags: []
date: 2016-02-23 07:49:25
---
在php-5.3.3安装mcrypt拓展模块时，使用源代码目录中ext/mcrypt动态添加，安装过程中竟然出错了：

    error: ‘PHP_FE_END’ undeclared here (not in a function)

解决方法： 源代码有错误，进入ext/mcrypt目录

    sed -i 's|PHP_FE_END|{NULL,NULL,NULL}|' ./*.c
    sed -i 's|ZEND_MOD_END|{NULL,NULL,NULL}|' ./*.c

再重新make && make install
即可