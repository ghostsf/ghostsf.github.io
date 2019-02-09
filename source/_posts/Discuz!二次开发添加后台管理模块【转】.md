title: Discuz!二次开发添加后台管理模块【转】
categories: 旧文字
tags: [discuz]
date: 2015-11-23 03:18:17
---
> 现在Discuz论坛越来越火热，那么Discuz!二次开发如何添加后台管理模块？

涉及到的文件:
admincp.php 后台入口文件
main.inc.php 定义后台界面模板显示文件
admincp.menu.lang.php 后台管理语言文件
menu.inc.php 后台界面菜单定义文件

1、在变量$action中声明

admincp.php 86行加入‘menu_class_list’、‘menu_teacher_list’:
in_array($action, array('home', 'settings', 'members', 'profilefields', 'admingroups', 'usergroups', 'ranks', 'forums', 'threadtypes', 'threads', 'moderate', 'attach', 'smilies', 'recyclebin', 'prune', 'styles', 'plugins', 'tasks', 'magics', 'medals', 'google', 'qihoo', 'video', 'announce', 'faq', 'ec', 'tradelog', 'creditwizard', 'jswizard', 'project', 'counter', 'misc', 'adv', 'insenz', 'logs', 'tools', 'checktools', 'search', 'upgrade','menu_class_list','menu_teacher_list')；
2、定义自定义顶部菜单的默认显示，main.inc.php  55行加入

//添加顶部菜单
showheader('family','menu_class_list');
3、定义自定义菜单的语言文件，admincp.menu.lang.php 24行加入

//添加顶部菜单
    'header_family' => '家庭平台',
    'menu_class_list' => '课程',
    'menu_teacher_list' => '老师',
4、定义侧栏菜单，menu.inc.php 96行加入

//添加顶部菜单
showmenu('family', array(
    array('menu_class_list', 'members'),
    array('menu_teacher_list', 'adv'),
));
//------
5、由于discuz后台显示通过JS调用显示，所以必须在main.inc.php111行加入

var headers = new Array('index', 'global', 'style', 'forum', 'user', 'topic', 'extended', 'adv','family', 'tool'$ucadd);
6、/admin文件中定义程序文件
menu_class_list.inc.php
menu_teacher_list.inc.php