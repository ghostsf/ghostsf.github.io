title: mysql判断字段是否包含某个字符串的方法 - ghostsf博客
categories: 技术栈
tags: []
date: 2016-07-18 07:21:22
---
方法一：

    SELECT * FROM users WHERE emails like "%ghostsf@email.com%";


方法二：
利用MySQL 字符串函数 find_in_set();

    SELECT * FROM users WHERE find_in_set('ghostsf@email.com', emails);

使用注意点：
find_in_set(str1,str2)函数是返回str2中str1所在的位置索引，注意，str2必须以","分割开。
注：当str2为NO1：“3,6,13,24,33,36”，NO2：“13,33,36,39”时，判断两个数据中str2字段是否包含‘3’，该函数可完美解决

    mysql > SELECT find_in_set()('3','3,6,13,24,33,36') as test;
    -> 1
    
    mysql > SELECT find_in_set()('3','13,33,36,39') as test;
    -> 0

方法三：
使用locate(substr,str)函数，如果包含，返回>0的数，否则返回0 

例子：判断site表中的url是否包含'http://'子串,如果不包含则拼接在url字符串开头

    update site set url =concat('http://',url) where locate('http://',url)=0 

> 注意mysql中字符串的拼接不能使用加号+，用concat函数


<!--more-->


摘录自[hechurui的专栏][1]


  [1]: http://blog.csdn.net/hechurui/article/details/49278493
