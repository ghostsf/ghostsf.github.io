title: Java开发企业号的注意点 illegal Key Size的解决方案
categories: 技术栈
tags: []
date: 2016-03-01 11:49:08
---
异常java.security.InvalidKeyException:illegal Key Size的解决方案：

在官方网站下载JCE无限制权限策略文件（请到官网下载对应的版本， 例如JDK7的下载地址：http://www.oracle.com/technetwork/java/javase/downloads/jce-7-download-432124.html )：

下载后解压，可以看到local_policy.jar和US_export_policy.jar以及readme.txt。如果安装了JRE，将两个jar文件放到%JRE_HOME% \lib\security目录下覆盖原来的文件，如果安装了JDK，将两个jar文件放到%JDK_HOME%\jre\lib\security目录下覆盖原来文件。
