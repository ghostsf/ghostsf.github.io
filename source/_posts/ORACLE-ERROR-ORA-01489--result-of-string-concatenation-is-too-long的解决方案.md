layout: false
title: ORACLE ERROR ORA-01489 result of string concatenation is too long的解决方案
categories: 旧文字
tags: [oracle]
date: 2017-02-15 02:23:31
---
> ORACLE ERROR ORA-01489: result of string concatenation is too long

一般遇到这种oracle的问题，DBA都会说去搜下ORA-01489即可。
然后我就去搜了，- -。

一般这种就是string concatenation作为结果输出太长了，放不下。
于是可以用TO_CLOB转型。

原来的长字符串拼接，比如是

    t.SUGGESTIONS1 || t.SUGGESTIONS2 || t.SUGGESTIONS3

这是里每个字段都存储着超长的文本，再拼接就太长了。

所以得这么写 = =

    TO_CLOB(t.SUGGESTIONS1) || TO_CLOB(t.SUGGESTIONS2) || TO_CLOB(t.SUGGESTIONS3)

这样就不会报这个错了。
