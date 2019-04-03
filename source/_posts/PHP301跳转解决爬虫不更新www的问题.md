title: PHP301跳转解决爬虫不更新www的问题
categories: 技术栈
tags: [php,301跳转]
date: 2015-08-10 04:42:00
---
新站长可能遇到过类似的问题，就是自己的网站没有www的地址更新要比有www的地址更新要快，而且可能有www的网址，没有被百度爬虫更新，这个时候就需要做一个301跳转，当访问没有www的网址时自动跳转到有www的网址，这样就能够起到正常更新的作用。当然301跳转的相关代码，也是有很多相关资源的，这里就不赘述了。

 1. 首先查看带www和不带www的网址的更新日期，是否同步，日期是否在最新，如果在最新那么恭喜你，不需要做301跳转，保持目前的就可以了
 2. 如果带www的网址更新时间在很久以前了，这里就建议读者继续往下看，下面贴出PHP的完整的301测试代码：

    $the_host = $_SERVER['HTTP_HOST'];//取得当前域名
    $the_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';//判断地址后面部分
    $the_url = strtolower($the_url);//将英文字母转成小写
    if($the_url=="/index.php")//判断是不是首页
    {
    $the_url="";//如果是首页，赋值为空
    }
    if($the_host !== 'www.ghostsf.com')//如果域名不是带www的网址那么进行下面的301跳转
    {
    header('HTTP/1.1 301 Moved Permanently');//发出301头部
    header('Location:http://www.ghostsf.com'.$the_url);//跳转到带www的网址
    }


 3. 将代码写入首页的文件，即可。验证301跳转是否成功可以F12看看状态码，或者在跳转到带www的网址后面加个参数来验证下。
<!--more-->

参考文章：[PHP301跳转，怎么解决爬虫不更新www的问题？][1]


  [1]: http://jingyan.baidu.com/article/7e440953ea31742fc0e2ef22.html
