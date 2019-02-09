title: 多线程——sleep() 和 wait() 的区别
categories: 旧文字
tags: [java]
date: 2015-10-21 14:23:36
---
> sleep用于线程控制，而wait用于线程间的通信，与wait配套的方法还有notify和notifyAll.

举个例子

    sleep(1000)

会把线程放到一边, 直到整整一秒之后才再次启动

    wait(1000)

则是把线程放到一边至多一秒. 如果碰到 notify() 或者 notifyAll() 就会提前启动.

而且 wait() 方法是Object类的方法. 而 sleep() 是Thread类的方法.

更多，参阅[java多线程 sleep()和wait()的区别][1]


  [1]: http://www.cnblogs.com/octobershiner/archive/2011/10/28/2227705.html