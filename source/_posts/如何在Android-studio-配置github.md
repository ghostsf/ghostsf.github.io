title: 如何在Android studio 配置github
categories: 技术栈
tags: [android studio]
date: 2015-07-30 18:40:04
---
想在AS里试试GitHub，点击VCS-->Checkout from Version Control-->GitHub的时候弹出如下错误框：
![请输入图片描述][1]
Android Studio Checkout Github Error “CreateProcess=2” (Windows)有正解，在这里复述下：

1.从Github For Windows下载Windows版Github客户点并安装
2.安装成功后，连接你的GitHub账号
3.设置环境变量，添加git.exe的路径到Path。git.exe的路径类似：C:\Users\Your_Username\AppData\Local\GitHub\PortableGit_ca477551eeb4aea0e4ae9fcd3358bd96720bb5c8\bin
 如果不想设置环境变量，可以直接在AS里通过Setting-->Version Control --> Git --> Path to Git Executable里设置，设置路径例如：
C:\Users\Your_Username\AppData\Local\GitHub\PortableGit_ca477551eeb4aea0e4ae9fcd3358bd96720bb5c8\bin\git.exe
设置完成后，再次点击VCS-->Checkout from Version Control-->GitHub的时候出现如下弹框，在AS可以正常连接github啦^_<
![请输入图片描述][2]


转载自:[http://blog.csdn.net/qq_18495939/article/details/44803369][3]


  [1]: http://img.blog.csdn.net/20140917093950816?watermark/2/text/aHR0cDovL2Jsb2cuY3Nkbi5uZXQvYWxpYW9vb29v/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70/gravity/SouthEast
  [2]: http://img.blog.csdn.net/20140917100304024?watermark/2/text/aHR0cDovL2Jsb2cuY3Nkbi5uZXQvYWxpYW9vb29v/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70/gravity/SouthEast
  [3]: http://blog.csdn.net/qq_18495939/article/details/44803369
