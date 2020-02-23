hexo new [layout] <title>

hexo server

在静态模式下，服务器只处理 public 文件夹内的文件，而不会处理文件变动，在执行时，您应该先自行执行 hexo generate，此模式通常用于生产环境（production mode）下。

hexo server -s

生成部署

hexo g -d