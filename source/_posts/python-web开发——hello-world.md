title: python web开发——hello world
categories: 技术栈
tags: [python,python web]
date: 2015-11-10 17:57:52
---
**python框架**
**Django**:这是一个被广泛应用的框架。在网上搜索，会发现很多公司在招聘的时候就说要会这个。框架只是辅助，真正的程序员，用什么框架，都应该是根据需要而来。当然不同框架有不同的特点，需要学习一段时间。
**Flask**：一个用Python编写的轻量级Web应用框架。基于Werkzeug WSGI工具箱和Jinja2模板引擎。
**Web2py**：是一个为Python语言提供的全功能Web应用框架，旨在敏捷快速的开发Web应用，具有快速、安全以及可移植的数据库驱动的应用，兼容Google App Engine。
**Bottle**: 微型Python Web框架，遵循WSGI，说微型，是因为它只有一个文件，除Python标准库外，它不依赖于任何第三方模块。
**Tornado**：全称是Tornado Web Server，从名字上看就可知道它可以用作Web服务器，但同时它也是一个Python Web的开发框架。最初是在FriendFeed公司的网站上使用，FaceBook收购了之后便开源了出来。
webpy: 轻量级的Python Web框架。webpy的设计理念力求精简（Keep it simple and powerful），源码很简短，只提供一个框架所必须的东西，不依赖大量的第三方模块，它没有URL路由、没有模板也没有数据库的访问。

----------

**安装Tornado**
Tornado的官方网站：[http://www.tornadoweb.org][1]
因为Tornado已经列入PyPI，因此可以通过 pip 或者 easy_install 来安装。

    pip install tornado

Windows上：

> Tornado will also run on Windows, although this configuration is not
> officially supported and is recommended only for development use.


----------


**写个hello demo：**
hello.py

    #!/usr/bin/env python
    #coding:utf-8
    
    import tornado.httpserver
    import tornado.ioloop
    import tornado.options
    import tornado.web
    
    from tornado.options import define, options
    define("port", default=8000, help="run on the given port", type=int)
    
    class IndexHandler(tornado.web.RequestHandler):
        def get(self):
            greeting = self.get_argument('greeting', 'Hello')
            self.write(greeting + ', welcome to : www.ghostsf.com')
    
    if __name__ == "__main__":
        tornado.options.parse_command_line()
        app = tornado.web.Application(handlers=[(r"/", IndexHandler)])
        http_server = tornado.httpserver.HTTPServer(app)
        http_server.listen(options.port)
        tornado.ioloop.IOLoop.instance().start()

然后运行即可：

    $ python hello.py

当然在linux系统的shell中也可以这样:

    $ curl http://localhost:8000/
    Hello, welcome to : www.ghostsf.com
    
    $ curl http://localhost:8000/?greeting=ghostsf
    ghostsf, welcome to : www.ghostsf.com 

至此，恭喜你，迈出了决定性一步，已经可以用Tornado发布网站了。在这里似乎没有做什么部署，只是安装了Tornado。是的，不需要多做什么，因为Tornado就是一个很好的server，也是一个开发框架。



  [1]: http://www.tornadoweb.org
