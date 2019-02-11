title: IDEA如何快速编写代码并自定义快捷方式
categories: 技术栈
tags: [idea快捷键,idea快速便捷代码]
date: 2015-09-02 06:38:22
---
用eclipse的人都知道,syso加alt+/就可以快速的编写出System.out.println(); 那么在IDEA里怎么快速编写呢？
其实IDEA的智能提示已经很强大了，强大到几乎每一次正常的编写代码都是快捷键。
那么IDEA要如何快速编写syso呢？
有用过IDEA的人就会站出来回答了:sout+TAB即可。然后又会有人问main方法怎么快速编写呢？然后又有人会回答:psvm+TAB即可。
这样的回答都不像是喜欢用IDEA的人回答的。IDEA在代码智能提示上这么强大，怎么会没有快速编码的自定义方式呢？ 
![Live Templates][1]
IDEA有强大的Live Templates设置，大家想怎么设置就怎么设置啦.

当然关于IDE快捷键的使用key map类的，也顺便说下，也很简单啦。有些人还是比较愁,怎么从eclipse的快捷键过度到IDEA。
IDEA当然已经解决了这些问题啦，如图：
![KeyMap自定义][2]
IDEA提供了一系列主流IDE的快捷键方案，可自选并可继续自定义哦。同时IDEA的keyMap方案都是保存在.xml文件(默认快捷键在\lib\resources.jar\idea\KeyMap_***.xml)中的，格式很清晰。当然你比较极客的话，可以简单写个解析程序将xml解析出来然后生成一个excel，然后再打印出来，慢慢欣赏。
当然自定义的KeyMap方案就会出现在user用户文件夹的\.IntelliJIdeaXX\config\keymaps\*.xml中了。有什么好的快捷键配置方案，将此文件分享给别人即可啦。


  [1]: http://www.ghostsf.com/usr/uploads/2015/09/4165256313.jpg
  [2]: http://www.ghostsf.com/usr/uploads/2015/09/3893677072.jpg
