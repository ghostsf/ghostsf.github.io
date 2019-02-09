title: 使用Jenkins配置自动化构建
categories: 旧文字
tags: [jenkins]
date: 2016-04-19 04:55:00
---
持续集成是个简单重复劳动，人来操作费时费力，使用自动化构建工具完成是最好不过的了。
为了实现这个要求，我选择了Jenkins。
从http://mirrors.jenkins-ci.org/windows/latest下载windows下的最新安装版jenkins。（如果不能安装，从http://mirrors.jenkins-ci.org/war/latest/jenkins.war下载war包，手动配置，配置说明参见https://wiki.jenkins-ci.org/display/JENKINS/Use+Jenkins）

**1.安装**
这里直接使用安装包，安装过程很简单，这里就再说明了。
安装后自动创建了一个windows服务：Jenkins，默认使用的端口是8080，如果需要修改，打开安装目录下的jenkins.xml文件，修改  <arguments>-Xrs -Xmx256m -Dhudson.lifecycle=hudson.lifecycle.WindowsServiceLifecycle -jar "%BASE%\jenkins.war" --httpPort=8081</arguments>后保存，启动jenkins服务。
打开http://192.168.0.10:8081/，看到类似下面的界面（我这里已经创建了一个任务）：

![1.png][1]

说明jenkins已经安装成功。

**2. 创建任务**
  2.1 点“新Job”,界面如下：
![2.png][2]

输入任务名称，任意名称都可以，但最好是有意义的名称，这里输入的名称和项目名称相同为hummer
  2.2 选择项目类型，因我的项目是maven项目，这里选择“构建一个maven2/3项目”点击”OK“进入下一个界面。
  2.3 界面如下：
![3.png][3]

源代码管理根据自己的需要进行选择，我的源代码是使用svn管理的，这里选择“Subversion Modules”，在"Repository URL"录入你的svn仓库地址；第一次录入时还需要录入svn仓库的用户名和口令。
刚才的那个界面比较大，向下滚动，中间部分的界面如下：
![4.png][4]

构建触发器，我选择“Build whenever a SNAPSHOT dependency is built”，意思是依赖于快照的构建，应该是当svn有修改时就构建项目。
2.4 build设置不用修改，就使用pom.xml，目标选项也不用修改。
2.5 设置构建后的步骤，（Post Steps，可选设置 ），我这里要求构建成功后把war文件复制到指定的目录，然后停运tomcat，删除项目web目录，启动tomcat。
2.6 设置邮件通知 
![5.png][5]

勾选“E-mail Notification”，在recipients中录入要接收邮件的邮箱。
点“保存”，完成设置

**3. 在工作区域的左边菜单上点“立即构建”，开始构建项目，**


<!--more-->


![6.png][6]

如果构建成功，则项目状态的S为蓝色，如果失败则为红色。

![8.png][7]

构建完成，左边菜单会显示有“控制台输出”，点击可以查看控制台详细输出。构建错误时也可以根据相应的错误信息进行修改。

转载自 [常绍新的专栏][8] 

By the way : 后续自己尝试用下，再来自己写一篇。


  [1]: http://www.ghostsf.com/usr/uploads/2016/04/2604296297.png
  [2]: http://www.ghostsf.com/usr/uploads/2016/04/355140567.png
  [3]: http://www.ghostsf.com/usr/uploads/2016/04/1349457636.png
  [4]: http://www.ghostsf.com/usr/uploads/2016/04/3945824746.png
  [5]: http://www.ghostsf.com/usr/uploads/2016/04/1206679527.png
  [6]: http://www.ghostsf.com/usr/uploads/2016/04/1445939075.png
  [7]: http://www.ghostsf.com/usr/uploads/2016/04/3516141966.png
  [8]: http://blog.csdn.net/littlechang