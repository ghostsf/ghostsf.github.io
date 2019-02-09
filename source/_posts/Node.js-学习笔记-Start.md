title: Node.js 学习笔记 Start
categories: 旧文字
tags: [nodejs]
date: 2015-12-05 05:52:10
---
**下载&安装：**
[https://nodejs.org/dist/v4.2.1/node-v4.2.1-x64.msi][1]

**Hello World**
打开你最喜欢的编辑器，创建一个helloworld.js文件

    console.log("Hello World");

保存，并通过Node.js来执行：
正常的话，就会在终端输出 Hello World

    node helloworld.js

**一个基础的HTTP服务器**
在你的项目的根目录下创建一个叫server.js的文件，并写入以下代码：


<!--more-->


    var http = require("http");
    
    http.createServer(function(request, response) {
      response.writeHead(200, {"Content-Type": "text/plain"});
      response.write("Hello World");
      response.end();
    }).listen(8888);

    node server.js
打开浏览器访问http://localhost:8888/，你会看到一个写着“Hello World”的网页。

**增加路由功能**
路由，顾名思义，是指我们要针对不同的URL有不同的处理方式。
创建 server.js

    var http = require("http");
    var url = require("url");
    
    function start(route, handle){
        function onRequest(request, response){
            var pathname = url.parse(request.url).pathname;
            console.log("Request for " + pathname + " received.");
            response.writeHead(200, {"Content-Type": "text/html"});
            //分发路由
            var content = route(handle, pathname);
            response.write("<h1>" + content + "</h1>");
            response.end();
        }
        http.createServer(onRequest).listen(8888);
        console.log("Server has started.");
    }
    
    exports.start = start;

**创建 requestHandlers.js**

    function index() {
      console.log("Request handler 'index' was called.");
      return "index";
    }
    
    function login() {
       console.log("Request handler 'login' was called.");
       return "login";
    }
    
    function register() {
       console.log("Request handler 'register' was called.");
       return "register";
    }
    
    exports.index = index;
    exports.login = login;
    exports.register = register;

**创建 router.js**

    function route(handle, pathname){
         console.log("About to route a request for " + pathname);
         console.log(handle);
         if (typeof handle[pathname] === 'function') {
                return handle[pathname]();
          } else {
                console.log("No request handler found for " + pathname);
                return "404 Not found";
          }
    }
    
    exports.route = route;

**创建 index.js**

    var server = require("./server");
    var router = require("./router");
    var requestHandlers = require("./requestHandlers");
    
    var handle = {}
    handle["/"] = requestHandlers.index;
    handle["/login"] = requestHandlers.login;
    handle["/register"] = requestHandlers.register;
    
    server.start(router.route, handle)

**循序渐进，非阻塞**
创建 server.js

  

      var http = require("http"),
            url = require("url");
        
        function start(route, handle){
        
            function onRequest(request, response){
                var pathname = url.parse(request.url).pathname;
                console.log("The path name is -> " + pathname);
                route(handle, pathname, response);
            }
        
            http.createServer(onRequest).listen(8888);
            console.log("Server has started.");
        }
        
        exports.start = start;
    
    **创建 requestHandlers.js**
    var exec = require("child_process").exec;//非阻塞
    
    function index(response) {
      console.log("Request handler 'index' was called.");
    
      exec("ls -lah", function (error, stdout, stderr){
        write(response, "text/html", "<h1>你好！ :)</h1>");
      });
    
    }
    
    function login(response) {
       console.log("Request handler 'login' was called.");
       write(response, "text/plain", "Request handler 'login' was called.");
    }
    
    function register(response) {
       console.log("Request handler 'register' was called.");
       write(response, "text/plain", "Request handler 'register' was called.");
    }
    
    function write(response,contentType,content){
        response.writeHead(200, {"Content-Type": contentType});
        response.write(content);
        response.end();
    }
    
    exports.index = index;
    exports.login = login;
    exports.register = register;

**创建 router.js**

    function route(handle, pathname, response){
    
        console.log("Analysing "+pathname);
        if(typeof handle[pathname] === "function"){
            handle[pathname](response);//response 交给handle
        }else{
            console.log("No request handler found for " + pathname);
            response.writeHead(404, {"Content-Type": "text/plain"});
            response.write("404 Not found");
            response.end();
        }
    }
    
    exports.route = route;

**创建 index.js**

    var server = require("./server");
    var router = require("./router");
    var requestHandlers = require("./requestHandlers");
    
    var handle = {}
    handle["/"] = requestHandlers.index;
    handle["/login"] = requestHandlers.login;
    handle["/register"] = requestHandlers.register;
    
    server.start(router.route, handle)


> Node.js官网：[https://nodejs.org/en/][3] 
> 维基百科：[https://zh.wikipedia.org/wiki/Node.js ][2]
> 一个不错的入门教程：[http://www.nodebeginner.org/index-zh-cn.html#javascript-and-nodejs][4]

FROM : [http://xc66.cc/i/#!53][5]


  [1]: https://nodejs.org/dist/v4.2.1/node-v4.2.1-x64.msi
  [2]: https://zh.wikipedia.org/wiki/Node.js
  [3]: https://nodejs.org/en/
  [4]: http://www.nodebeginner.org/index-zh-cn.html#javascript-and-nodejs
  [5]: http://xc66.cc/i/#!53