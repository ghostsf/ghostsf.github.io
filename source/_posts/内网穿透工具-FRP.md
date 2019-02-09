title: 内网穿透工具 FRP
categories: 
tags: []
date: 2017-06-13 06:12:47
---
![QQ截图20170613141154.png][1]

> frp 是一个高性能的反向代理应用，可以帮助您轻松地进行内网穿透，对外网提供服务，支持 tcp, http, https 等协议类型，并且
> web 服务支持根据域名进行路由转发。

**frp 的作用**

 - 利用处于内网或防火墙后的机器，对外网环境提供 http 或 https 服务。
 - 对于 http 服务支持基于域名的虚拟主机，支持自定义域名绑定，使多个域名可以共用一个80端口。
 - 利用处于内网或防火墙后的机器，对外网环境提供 tcp 服务，例如在家里通过 ssh 访问处于公司内网环境内的主机。
 - 可查看通过代理的所有 http 请求和响应的详细信息。（待开发）

**frp开源**

frp 目前正在前期开发阶段，master 分支用于发布稳定版本，dev 分支用于开发，您可以尝试下载最新的 release 版本进行测试。
目前的交互协议可能随时改变，不能保证向后兼容，升级新版本时需要注意公告说明。

[https://github.com/fatedier/frp][2] 
[http://getfrp.yzxx-soft.com/index.html][3]

**使用示例**

    根据对应的操作系统及架构，从 [Release][4] 页面下载最新版本的程序。

    将 frps 及 frps.ini 放到有公网 IP 的机器上。
    将 frpc 及 frpc.ini 放到处于内网环境的机器上。

**通过 ssh 访问公司内网机器**

 1. 修改 frps.ini 文件，配置一个名为 ssh 的反向代理：

    # frps.ini
    [common]
    bind_port = 7000
    
    [ssh]
    listen_port = 6000
    auth_token = 123

 2. 启动 frps：

    ./frps -c ./frps.ini

 3. 修改 frpc.ini 文件，设置 frps 所在服务器的 IP 为 x.x.x.x：

    # frpc.ini
    [common]
    server_addr = x.x.x.x
    server_port = 7000
    auth_token = 123
    
    [ssh]
    local_port = 22

 4. 启动 frpc：

    ./frpc -c ./frpc.ini

 5. 通过 ssh 访问内网机器，假设用户名为 test：

    ssh -oPort=6000 test@x.x.x.x


**通过指定域名访问部署于内网的 web 服务**
有时想要让其他人通过域名访问或者测试我们在本地搭建的 web 服务，但是由于本地机器没有公网 IP，无法将域名解析到本地的机器，通过 frp 就可以实现这一功能，以下示例为 http 服务，https 服务配置方法相同， vhost_http_port 替换为 vhost_https_port， type 设置为 https 即可。

 1. 修改 frps.ini 文件，配置一个名为 web 的 http 反向代理，设置 http 访问端口为 8080，绑定自定义域名
    www.yourdomain.com:
    # frps.ini
    [common] bind_port = 7000
    vhost_http_port = 8080
    
    [web]
    type = http
    custom_domains = www.yourdomain.com
    auth_token = 123

 2. 启动 frps；

    ./frps -c ./frps.ini

 3. 修改 frpc.ini 文件，设置 frps 所在的服务器的 IP 为 x.x.x.x，local_port 为本地机器上 web 服务对应的端口：

    # frpc.ini
    [common]
    server_addr = x.x.x.x
    server_port = 7000
    auth_token = 123
    
    [web]
    type = http
    local_port = 80

 4. 启动 frpc：

     ./frpc -c ./frpc.ini

 5. 将 www.yourdomain.com 的域名 A 记录解析到 x.x.x.x，如果服务器已经有对应的域名，也可以将 CNAME 记录解析到服务器原先的域名。

 6. 通过浏览器访问 http://www.yourdomain.com:8080 即可访问到处于内网机器上的 web 服务。

**配置参考：**
**服务端端配置 frps.ini**
假如服务端的IP地址为：121.35.99.12

    [common]
    bind_port = 7000 
    vhost_http_port = 9988 #由于80端口已暂用这里我们使用Nginx做端口映射到80端口来做微信开发的调试，如何映射后文会介绍
    #连接池
    max_pool_count = 5
    #token验证
    privilege_token = javen
    #自定义二级域名
    subdomain_host = javen.abc.com
    #控制面板
    dashboard_port = 9999
    dashboard_user = javen
    dashboard_pwd = javen
    #日志
    log_file = ./frps.log
    log_level = info
    log_max_days = 3

**客户端配置 frpc.ini**

    [common]
    server_addr = 121.35.99.12 # 服务器IP
    server_port = 7000 # 服务器bind_port
    privilege_token = javen
    
    [web]
    type = http
    local_port = 8080 # 映射到本地的8080端口
    subdomain = mac
    
    # 如果不使用SSH可以将其注释掉
    [ssh]
    type = tcp
    local_ip = 127.0.0.1
    local_port = 22
    remote_port = 6000

**自定义二级域名配置示例：**
在多人同时使用一个 frps 时，通过自定义二级域名的方式来使用会更加方便。

通过在 frps 的配置文件中配置 subdomain_host，就可以启用该特性。之后在 frpc 的 http、https 类型的代理中可以不配置 custom_domains，而是配置一个 subdomain 参数。

只需要将 *.{subdomain_host} 解析到 frps 所在服务器。之后用户可以通过 subdomain 自行指定自己的 web 服务所需要使用的二级域名，通过 {subdomain}.{subdomain_host} 来访问自己的 web 服务。

**假如域名为：abc.com 
去域名的控制面板添加解析 *.ghostsf 到 121.35.99.12**

**Dashboard**
通过浏览器查看 frp 的状态以及代理统计信息展示。
![1342351-76ce765f8cade862.png][5]

**端口映射配置：**
**这里使用Nginx将9988端口映射到80端口供微信开发调试使用**

    #user  nobody;
    worker_processes  2;
    worker_cpu_affinity 01 10;
    #error_log  logs/error.log;
    #error_log  logs/error.log  notice;
    #error_log  logs/error.log  info;
    
    #pid        logs/nginx.pid;
    
    
    events {
        worker_connections  1024;
    }
    
    
    http {
        include       mime.types;
        default_type  application/octet-stream;
    
        #log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
        #                  '$status $body_bytes_sent "$http_referer" '
        #                  '"$http_user_agent" "$http_x_forwarded_for"';
    
        #access_log  logs/access.log  main;
    
        sendfile        on;
        #tcp_nopush     on;
    
        #keepalive_timeout  0;
        keepalive_timeout  65;
    
        #gzip  on;
    
        upstream wx {
           ip_hash;
           server localhost:8080 weight=1 max_fails=3 fail_timeout=60s;
               server localhost:8088 weight=1 max_fails=3 fail_timeout=60s;
        }
    
        server {
            listen       80;
            server_name  localhost;
            access_log  /home/nginxlog/wx_access.log;
    
            location / {
                proxy_redirect          off;
                proxy_set_header Host $host:$server_port;
                proxy_set_header X-Forwarded-For $remote_addr;
                client_max_body_size      20m;
                client_body_buffer_size 128k;
                proxy_connect_timeout   600;
                proxy_send_timeout      600;
                proxy_read_timeout      900;
                proxy_buffer_size       4k;
                proxy_buffers           4 32k;
                proxy_busy_buffers_size 64k;
                proxy_temp_file_write_size 64k;
                proxy_pass http://wx;
            }
    
        }
    
            server {
                    listen       80;
                    server_name  *.javen.abc.com;
                    access_log  /home/nginxlog/frp_access.log;
    
                    location / {
                            proxy_redirect          off;
                            proxy_set_header Host $host:$server_port;
                            proxy_set_header X-Forwarded-For $remote_addr;
                            client_max_body_size      20m;
                            client_body_buffer_size 128k;
                            proxy_connect_timeout   600;
                            proxy_send_timeout      600;
                            proxy_read_timeout      900;
                            proxy_buffer_size       4k;
                            proxy_buffers           4 32k;
                            proxy_busy_buffers_size 64k;
                            proxy_temp_file_write_size 64k;
                            proxy_pass http://127.0.0.1:9988/;
                    }
    
            }
    
        server {
            listen       8888;
            server_name  localhost;
            access_log   /home/nginxlog/static_access.log;
    
            location ~ .*\.(gif|jpg|jpeg|bmp|png|ico|txt|js|css|apk)$
            {
                root /home/ftp/private; 
                expires 7d; 
            }
        }
    
        # another virtual host using mix of IP-, name-, and port-based configuration
        #
        #server {
        #    listen       8000;
        #    listen       somename:8080;
        #    server_name  somename  alias  another.alias;
    
        #    location / {
        #        root   html;
        #        index  index.html index.htm;
        #    }
        #}
    
    
        # HTTPS server
        #
        #server {
        #    listen       443 ssl;
        #    server_name  localhost;
    
        #    ssl_certificate      cert.pem;
        #    ssl_certificate_key  cert.key;
    
        #    ssl_session_cache    shared:SSL:1m;
        #    ssl_session_timeout  5m;
    
        #    ssl_ciphers  HIGH:!aNULL:!MD5;
        #    ssl_prefer_server_ciphers  on;
    
        #    location / {
        #        root   html;
        #        index  index.html index.htm;
        #    }
        #}
    
    }

**参考文档：**
[https://www.oschina.net/p/frp][6]


  [1]: http://www.ghostsf.com/usr/uploads/2017/06/2619321278.png
  [2]: https://github.com/fatedier/frp
  [3]: http://getfrp.yzxx-soft.com/index.html
  [4]: https://github.com/fatedier/frp/releases
  [5]: http://www.ghostsf.com/usr/uploads/2017/06/3707756618.png
  [6]: https://www.oschina.net/p/frp