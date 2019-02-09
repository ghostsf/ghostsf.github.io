title: 新版本Android Studio安装后启动报错SDK tools director is missing的解决方案
categories: 旧文字
tags: [android studio]
date: 2015-07-13 06:44:05
---
错误案例:
When I start the "android studio" program, displayed a window of "downloading components" which says:   "Android SDK was installed to: C: / Users / user / AppData / Local / android / SDK2   SDK tools directory is missing " .

解决方案:不用点Finish按钮，此时点了Finish按钮整个程序会退出。此时点右上角关闭按钮，然后会进入到启动页，然后设置下Android SDK的路径即可: Configure -> Project Defaults -> Project Structure