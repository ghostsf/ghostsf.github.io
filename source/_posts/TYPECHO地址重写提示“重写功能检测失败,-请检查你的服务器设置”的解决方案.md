title: TYPECHO地址重写提示“重写功能检测失败, 请检查你的服务器设置”的解决方案
categories: 技术栈
tags: [typecho]
date: 2015-07-30 08:45:28
---
进入设置——永久链接，可以看到伪静态设置。不过这个功能遇到一点小问题，提示如下：
![3061734681.png][1]


  [1]: http://www.ghostsf.com/usr/uploads/2015/07/3321898248.png

我服务器是支持伪静态的，为何还会有此提示？FTP上也看不到.htaccess文件，会否是.htaccess文件没有生成的缘故。于是我就找了typecho的伪静态规则，自己建了一个.htaccess文件上传到根目录。(PS：windows里创建.开头的文件，在文件名末尾也加一个.即可)
然后，无视上面的提示，点击了“你如果任然想启用此功能，请勾选这里”，回到页面，伪静态成功。

问题可能出现在空间没有给予足够的权限，即便是支持伪静态，也需要用户手动上传.htaccess文件。

以下是.htaccess文件内容：

    RewriteEngine On 
    RewriteBase / 
    RewriteCond %{REQUEST_FILENAME} !-f 
    RewriteCond %{REQUEST_FILENAME} !-d 
    RewriteRule ^(.*)$ /index.php/$1 [L]
