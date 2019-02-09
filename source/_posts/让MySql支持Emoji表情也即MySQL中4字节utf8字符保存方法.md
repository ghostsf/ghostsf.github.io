title: 让MySql支持Emoji表情也即MySQL中4字节utf8字符保存方法
categories: 
tags: []
date: 2016-04-12 10:18:15
---
UTF-8编码有可能是两个、三个、四个字节。Emoji表情是4个字节，而Mysql的utf8编码最多3个字节，所以数据插不进去。
 
解决方案：将Mysql的编码从utf8转换成utf8mb4。
 

    CREATE TABLE IF NOT EXISTS we_contact(
     `id` INT AUTO_INCREMENT PRIMARY KEY,
      `openid` VARCHAR(50) NOT NULL  COMMENT '用户标识',
      `nickname` VARCHAR(500) NOT NULL  DEFAULT '' COMMENT '昵称'
    )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

 
对于已建好的表
 
转换成utf8mb4 
   命令：ALTER TABLE `TABLE_NAME` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; （将TABLE_NAME替换成你的表名）
将需要使用emoji的字段设置类型为： 
   命令：ALTER TABLE `TABLE_NAME`MODIFY COLUMN `COLUMN_NAME`  text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
 
使用 java连接数据库时
 
在Connector/J的连接参数中，不要加characterEncoding参数。 不加这个参数时，默认值就时autodetect。
 
使用PHP
SET NAMES 'utf8mb4';
例如Yii框架中  db=>array('connectionString' => '...',  'charset' => 'utf8mb4' ),
测试MySQL版本
Server version: 5.6.20