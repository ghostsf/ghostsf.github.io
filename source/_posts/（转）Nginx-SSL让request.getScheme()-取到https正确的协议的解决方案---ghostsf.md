title: （转）Nginx SSL让request.getScheme() 取到https正确的协议的解决方案 - ghostsf
categories: 技术栈
tags: [nginx,https]
date: 2017-01-09 04:56:15
---
最近在做一个项目, 架构上使用了 Nginx +tomcat 集群, 且nginx下配置了SSL,tomcat no SSL,项目使用https协议
![1.png][1]

但是,明明是https url请求,发现 log里面,

    0428 15:55:55 INFO  (PaymentInterceptor.java:44) preHandle() - requestStringForLog:    {  
            "request.getRequestURL():": "http://trade.feilong.com/payment/paymentChannel?id=212&s=a84485e0985afe97fffd7fd7741c93851d83a4f6",  
            "request.getMethod:": "GET",  
            "_parameterMap":         {  
                "id": ["212"],  
                "s": ["a84485e0985afe97fffd7fd7741c93851d83a4f6"]  
            }  
        }  

request.getRequestURL() 输出出来的 一直是  
http://trade.feilong.com/payment/paymentChannel?id=212&s=a84485e0985afe97fffd7fd7741c93851d83a4f6
 
但是浏览器中的URL却是
https://trade.feilong.com/payment/paymentChannel?id=212&s=a84485e0985afe97fffd7fd7741c93851d83a4f6
 
 
瞬间要颠覆我的Java观尴尬,API上写得很清楚:
 
getRequestURL():

    Reconstructs the URL the client used to make the request.   
      
    The returned URL contains a protocol, server name, port number, and server path,   
    but it does not include query string parameters.  

也就是说, getRequestURL() 输出的是不带query string的路经(含协议,端口,server path等信息).

![2.png][2]

并且,还发现

    request.getScheme()  //总是 http，而不是实际的http或https  
    request.isSecure()  //总是false（因为总是http）  
    request.getRemoteAddr()  //总是 nginx 请求的 IP，而不是用户的IP  
    request.getRequestURL()  //总是 nginx 请求的URL 而不是用户实际请求的 URL  
    response.sendRedirect( 相对url )  //总是重定向到 http 上 （因为认为当前是 http 请求） 

查阅了一些资料,找到了解决方案:
 
解决方法很简单，只需要分别配置一下 Nginx 和 Tomcat 就好了，而不用改程序。
 
配置 Nginx 的转发选项：

    proxy_set_header       Host $host;  
    proxy_set_header  X-Real-IP  $remote_addr;  
    proxy_set_header  X-Forwarded-For $proxy_add_x_forwarded_for;  
    proxy_set_header X-Forwarded-Proto  $scheme;  

> proxy_set_header X-Forwarded-Proto $scheme;

配置Tomcat server.xml 的 Engine 模块下配置一个 Valve：

    <Valve className="org.apache.catalina.valves.RemoteIpValve"  
    remoteIpHeader="X-Forwarded-For"  
    protocolHeader="X-Forwarded-Proto"  
    protocolHeaderHttpsValue="https"/>  

配置双方的 X-Forwarded-Proto 就是为了正确地识别实际用户发出的协议是 http 还是 https。
 
这样以上5项测试就都变为正确的结果了，就像用户在直接访问 Tomcat 一样。


关于 RemoteIpValve,有兴趣的可以阅读下 doc：
[http://tomcat.apache.org/tomcat-6.0-doc/api/org/apache/catalina/valves/RemoteIpValve.html][3]

    Tomcat port of mod_remoteip, this valve replaces the apparent client remote IP address and hostname for the request with the IP address list presented by a proxy or a load balancer via a request headers (e.g. "X-Forwarded-For").   
       
    Another feature of this valve is to replace the apparent scheme (http/https) and server port with the scheme presented by a proxy or a load balancer via a request header (e.g. "X-Forwarded-Proto").   

看了下他们的源码,比较简单,在各种框架,各种算法面前,这个类对性能影响很小
 

 - 如果没有配置protocolHeader 属性, 什么都不做.
 - 如果配置了protocolHeader,但是request.getHeader(protocolHeader)取出来的值是null,什么都不做
 - 如果配置了protocolHeader,但是request.getHeader(protocolHeader)取出来的值(忽略大小写)是配置的protocolHeaderHttpsValue(默认https),scheme设置为https,端口设置为 httpsServerPort
 - 其他设置为 http

    if (protocolHeader != null) {  
        String protocolHeaderValue = request.getHeader(protocolHeader);  
        if (protocolHeaderValue == null) {  
            // don't modify the secure,scheme and serverPort attributes  
            // of the request  
        } else if (protocolHeaderHttpsValue.equalsIgnoreCase(protocolHeaderValue)) {  
            request.setSecure(true);  
            // use request.coyoteRequest.scheme instead of request.setScheme() because request.setScheme() is no-op in Tomcat 6.0  
            request.getCoyoteRequest().scheme().setString("https");  
              
            request.setServerPort(httpsServerPort);  
        } else {  
            request.setSecure(false);  
            // use request.coyoteRequest.scheme instead of request.setScheme() because request.setScheme() is no-op in Tomcat 6.0  
            request.getCoyoteRequest().scheme().setString("http");  
              
            request.setServerPort(httpServerPort);  
        }  
    }  

转载自 [飞天奔月的java博客][4]

刚好ghostsf，也遇到一样的情况，刚好看到这位写的博文，遂转载之。

  [1]: http://www.ghostsf.com/usr/uploads/2017/01/706349000.png
  [2]: http://www.ghostsf.com/usr/uploads/2017/01/601473297.png
  [3]: http://tomcat.apache.org/tomcat-6.0-doc/api/org/apache/catalina/valves/RemoteIpValve.html
  [4]: http://feitianbenyue.iteye.com/blog/2056357
