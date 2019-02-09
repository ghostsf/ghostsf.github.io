title: PHP Warning： Cannot send session cookie – headers already sent…或者Cannot add/modify header information – headers already sent…
categories: 
tags: []
date: 2015-09-10 16:42:00
---
首先：这错误是怎么产生的呢？
PHP手册的回答如下：

> 消息“Warning： Cannot send session cookie – headers already
> sent…”或者“Cannot add/modify header information – headers already
> sent…”。 函数 header()，setcookie() 和 session
> 函数需要在输出流中增加头信息。但是头信息只能在其它任何输出内容之前发送。在使用这些函数前不能有任何（如 HTML）的输出。函数
> headers_sent() 能够检查您的脚本是否已经发送了头信息。请参阅“输出控制函数”。

让我们来看看PHP是如何处理HTTP header输出和主体输出的。

PHP脚本开始执行时，它可以同时发送header(标题)信息和主体信息。 Header信息(来自 header() 或 SetCookie() 函数)并不会立即发送，相反，它被保存到一个列表中。 这样就可以允许你修改标题信息，包括缺省的标题(例如 Content-Type 标题）。但是，一旦脚本发送了任何非标题的输出（例如，使用 HTML 或 print() 调用)，那么PHP就必须先发送完所有的Header，然后终止 HTTP header。而后继续发送主体数据。从这时开始，任何添加或修改Header信息的试图都是不允许的，并会发送上述的错误消息之一。

好!那我们来解决它：笨方法：把错误警告全不显示! 掩耳盗铃之计
error_reporting(E_ERROR | E_PARSE); 这里不要显示E_WARNING即可

**解决方案：**

**1)适用于有权限编辑PHP.INI的人**
打开php.ini文件(你应试比我清楚你的php.ini在哪里)，找到
output_buffering =改为on或者任何数字。如果是IIS6，请一定改为ON，不然你的PHP效率会奇慢。

**2)使用虚拟主机，不能编辑PHP.INI，怎么办？**
简单：
在你的空间根目录下建立一个.htaccess文件，内容如下：

AllowOverride All
PHP_FLAG output_buffering On

不幸的情况是：还是不行？全部网页都不能显示啦？

那么，再用下面的方法：

在PHP文件的最开始加入：ini_set(“output_buffering”, “1″);

让这个页面打开PHP的输出缓存。

**3)在PHP文件里解决**

ob_start()
启用output buffering机制。 Output buffering支持多层次 — 例如，可以多次调用 ob_start() 函数。

ob_end_flush()
发送output buffer（输出缓冲）并禁用output buffering机制。

ob_end_clean()
清除output buffer但不发送，并禁用output buffering。

ob_get_contents()
将当前的output buffer返回成一个字符串。允许你处理脚本发出的任何输出。

原理：
output_buffering被启用时，在脚本发送输出时，PHP并不发送HTTP header。相反，它将此输出通过管道（pipe）输入到动态增加的缓存中（只能在PHP 4。0中使用，它具有中央化的输出机制）。你仍然可以修改/添加header，或者设置cookie，因为header实际上并没有发送。当全部脚本终止时，PHP将自动发送HTTP header到浏览器，然后再发送输出缓冲中的内容。

**4）绝杀技巧**
如果以上方法都不能等到满意的解决办法，请用如下办法：

先用记事本打开出现问题的网页，另存为ANSI编码的同名文件。
再用EditPlus将该文件另存为UTF-8编码的文件。
再试试，应该可以显示了。
造成的原因主要由以下两点：
一：在Header（）函数之间输出了其他内容（一般由浏览器隐藏发送），导致了后来的Header不能再次发送新的页面类型。这可以通过开启Output_Buffering来解决，方法2）与3）就是这样。
二：PHP文件采用UTF-8编码，由于编码不兼容（特别是通过其他编码转换过来的），产生了BOM《在UCS 编码中有一个叫做”ZERO WIDTH NO-BREAK SPACE”的字符，它的编码是FEFF。而FFFE在UCS中是不存在的字符，所以不应该出现在实际传输中。UCS规范建议我们在传输字节流前，先传输 字符”ZERO WIDTH NO-BREAK SPACE”。这样如果接收者收到FEFF，就表明这个字节流是Big-Endian的；如果收到FFFE，就表明这个字节流是Little- Endian的。因此字符”ZERO WIDTH NO-BREAK SPACE”又被称作BOM。
　　UTF-8不需要BOM来表明字节顺序，但可以用BOM来表明编码方式。字符”ZERO WIDTH NO-BREAK SPACE”的UTF-8编码是EF BB BF。所以如果接收者收到以EF BB BF开头的字节流，就知道这是UTF-8编码了。

**[ghostsf PHP学习笔记][1]**


  [1]: http://www.ghostsf,com