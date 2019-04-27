title: Discuz! 全局变量 $_G详解
categories: 技术栈
tags: [discuz模板制作]
date: 2015-09-17 11:06:14
layout: false
---
$_G 保存了 discuz! 中所有的预处理数据
缓存能够很好的提高程序的性能，一些配置数据没必要每次都查询数据库，只要在修改了的时候更新下缓存即可。
Discuz! 中所有的缓存保存在 $_G[cache] 中
$_G[member]	会员信息数据
$_G[uid]	用户 uid
$_G[username]	用户名
$_G[adminid]	用户管理组 id
$_G[groupid]	用户用户组 id
$_G[settting]	设置数据
$_G[cache]	系统缓存
$_G[cache][plugin]	插件缓存
载入缓存可以使用 loadcache() 函数，将缓存载入到 $_G[cache] 数组中

(1) 全局变量系统篇
$_G['uid'] => 当前登录UID 
$_G['username'] => 当前登录用户名 
$_G['adminid'] => 当前登录ID管理组ID 
$_G['groupid'] => 当前登录ID用户组ID

$_G['cookie'] => 客户端cookie 
$_G['formhash'] => 当前登录ID的【FORMHASH】 主要用于表单提交
$_G['timestamp'] => 当前活动时间
$_G['starttime'] => 1317042440.3242
$_G['clientip'] => 当前访问者IP地址 
$_G['referer'] => 当前请求的地址，主要用户表单提交
$_G['charset'] => 程序编码
$_G['PHP_SELF'] => 当前访问页面的相对地址 
$_G['siteurl'] => 程序访问地址 
$_G['siteroot'] => 程序所在域名的相对目录
$_G['fid'] => 当前版块id【主题列表页、帖子页】出现 
$_G['tid'] => 当前帖子ID【帖子页】出现 
$_G['basescript'] => 当前页面所在频道
$_G['basefilename'] => 当前页面php文件名 
$_G['staticurl'] => 程序附件目录 
$_G['mod'] => 当前页面的MOD值【例如：forum.php?mod=xxx】
$_G['inajax'] => 当前ajax请求的值【无-0 有-1】
$_G['page'] => 当前分页ID
$_G['tpp'] => 当前分页每页显示数量
$_G['seokeywords'] => 当前页面seo关键词
$_G['seodescription'] => 当前页面seo介绍
$_G['timenow'] => Array
(
[time] => 2011-9-26 21:07 当前服务器时间
[offset] => +8 当前服务器时区
) 
$_G['config'] => Array(
    $_G['config'][db] => Array( 
        $_G['config'][db][1] => Array(
            $_G['config'][db][1][dbhost] => localhost 数据库连接地址
            $_G['config'][db][1][dbuser] => root 数据库用户名
            $_G['config'][db][1][dbpw] => 123456 数据库密码
            $_G['config'][db][1][dbcharset] => utf8 数据库编码
            $_G['config'][db][1][pconnect] => 0
            $_G['config'][db][1][dbname] => dxutf 数据库名
            $_G['config'][db][1][tablepre] => pre_ 数据表前缀
        )
    )
)
 
(2) 全局后台各项设置篇


<!--more-->


$_G['setting'][sitename] => 全局-站点信息-网站名称
$_G['setting'][siteurl] => 全局-站点信息-网站URL
$_G['setting'][regname] => 全局-注册访问-注册-注册地址
$_G['setting'][reglinkname] => 全局-注册访问-注册-注册链接文字
$_G['setting'][regverify] => 全局-注册访问-注册-新用户注册验证
$_G['setting'][icp] => 全局-站点信息-网站备案信息代码
$_G['setting'][imagelib] => 全局-上传设置-基本设置-图片处理库类型
$_G['setting'][extcredits] => 积分情况 自行打印
$_G['setting'][creditsformula] => 全局-积分设置-基本设置-总积分计算公式
$_G['setting'][cacheindexlife] => 全局-性能优化-论坛页面缓存设置-缓存论坛首页有效期
$_G['setting'][cachethreaddir] => 全局-性能优化-论坛页面缓存设置-缓存目录
$_G['setting'][cachethreadlife] => 全局-性能优化-论坛页面缓存设置-缓存帖子有效期
$_G['setting'][bbrulestxt] => 全局-注册访问-注册-网站服务条款
$_G['setting'][bbname] => 全局-站点信息-站点名称
$_G['setting'][attachurl] => 全局-上传设置-基本设置-本地附件URL地址
$_G['setting'][attachdir] => 全局-上传设置-基本设置-本地附件保存位置
$_G['setting'][anonymoustext] => 界面-界面设置-全局-匿名用户的昵称
$_G['setting'][threadsticky] => 界面-界面设置-主题列表-置顶主题的标识
$_G['setting'][defaultindex] => 默认首页文件名forum.php
$_G['setting'][verify] => 用户-认证设置
$_G['setting'][rewriterule] => 后台伪静态规则情况
$_G['setting'][ucenterurl] => UCenter地址
$_G['setting'][plugins] => 后台插件设置与启用情况
$_G['setting'][navlogos] => 后台界面设置-导航设置-内置导航的logo组
$_G['setting'][navmn] => 后台设置的导航情况，主要用于导航判断
$_G['setting'][navs] => 页头导航数组，可参考此数组进行页头导航重写
$_G['setting'][footernavs] => 页尾导航
$_G['setting'][spacenavs] => 家园模块左侧导航
$_G['setting'][mynavs] => 页头导航右边快捷导航按钮内容
$_G['setting'][topnavs] => 页头顶部导航内容
$_G['setting'][forumpicstyle] => Array 版块主题封面
$_G['setting'][forumpicstyle][thumbwidth] => 主题封面宽度
$_G['setting'][forumpicstyle][thumbheight] => 主题封面高度
$_G['setting'][activityfield] => 全局-站点功能-活动主题-发起者必填信息
$_G['setting'][activityextnum] => 全局-站点功能-活动主题-扩展资料项数量
$_G['setting'][activitypp] => 全局-站点功能-活动主题-用户列表每页显示参与活动的人数
$_G['setting'][activitycredit] => 全局-站点功能-活动主题-使用积分
$_G['setting'][activitytype] => 全局-站点功能-活动主题-内置类型
$_G['setting'][adminemail] => 全局-站点信息-管理员邮箱
 
 
(3)全局当前登录者信息篇
$_G['member'] => Array 当前登录用户个人信息
$_G['member'][uid] => UID
$_G['member'][email] => 邮箱地址
$_G['member'][username] => 用户名
$_G['member'][password] => 经过MD5后的密码（别乱输出！！！切记）$_G['member'][status] => 用户是否已经删除
$_G['member'][emailstatus] => 邮箱验证状态 0未验证 1验证通过
$_G['member'][avatarstatus] => 头像上传状态 0未上传 1已上传
$_G['member'][videophotostatus] => 视频认证 0未认证 1已认证
$_G['member'][adminid] => 所在管理组ID
$_G['member'][groupid] => 所在用户组ID
$_G['member'][groupexpiry] => 所在用户组有效期
$_G['member'][extgroupids] => 扩展用户组
$_G['member'][regdate] => 注册时间
$_G['member'][credits] => 214 现有总积分
$_G['member'][notifysound] => 短消息声音
$_G['member'][timeoffset] => 所在时区
$_G['member'][newpm] => 新短消息数量
$_G['member'][newprompt] => 新提醒数量
$_G['member'][accessmasks] => 这个貌似访问权限，不确定
$_G['member'][allowadmincp] => 是否拥有管理面板权限 0否 1是
$_G['member'][onlyacceptfriendpm] => 是否只接受好友短消息 0否 1是
$_G['member'][conisbind] => 是否绑定QQ 0否 1是
$_G['member'][lastvisit] => 上次访问时间

(4)风格变量篇
$_G['style'] => Array(
$_G['style'][styleid] => 当前风格ID
$_G['style'][name] => 当前风格名
$_G['style'][templateid] => 当前模板体系
$_G['style'][tpldir] => 当前模板目录
$_G['style'][menuhoverbgcolor] => 导航菜单高亮背景颜色
$_G['style'][lightlink] => 浅色链接颜色
$_G['style'][floatbgcolor] => 弹出窗口背景属性
$_G['style'][dropmenubgcolor] => 下拉菜单背景属性$_G['style'][floatmaskbgcolor] => 弹出窗口边框颜色属性
$_G['style'][dropmenuborder] => 下拉菜单边框色
$_G['style'][specialbg] => 彩色区域背景色(帖子用户信息栏、需强调的表头等)
$_G['style'][specialborder] => 彩色区域边框
$_G['style'][commonbg] => 通用显示区域背景颜色
$_G['style'][commonborder] => 通用边框颜色
$_G['style'][inputbg] => 输入框背景色
$_G['style'][inputborderdarkcolor] => 输入框边框深色
$_G['style'][headerbgcolor] => 页头背景
$_G['style'][headerborder] => 页头分割线高度
$_G['style'][sidebgcolor] => 家园侧边背景
$_G['style'][msgfontsize] => 帖子内容字号
$_G['style'][bgcolor] => 页面背景
$_G['style'][noticetext] => 提示信息颜色
$_G['style'][highlightlink] => 高亮链接颜色
$_G['style'][link] => 链接文字颜色
$_G['style'][lighttext] => 浅色文字
$_G['style'][midtext] => 中等文本颜色
$_G['style'][tabletext] => 普通文本颜色
$_G['style'][smfontsize] => 小号字体大小
$_G['style'][threadtitlefont] => 主题列表字体
$_G['style'][threadtitlefontsize] => 主题列表字体大小
$_G['style'][smfont] => 小号字体
$_G['style'][titlebgcolor] => 版块列表标题字体颜色$_G['style'][fontsize] => 正常字体大小
$_G['style'][font] => 正常字体
$_G['style'][styleimgdir] => 扩展图片目录
$_G['style'][imgdir] => 界面基础图片目录
$_G['style'][boardimg] => logo所在路径
$_G['style'][headertext] => 页头文字颜色
$_G['style'][footertext] => 页脚文字颜色
$_G['style'][menubgcolor] => 导航菜单背景颜色
$_G['style'][menutext] => 导航菜单文字颜色
$_G['style'][menuhovertext] => 导航菜单高亮文字颜色
$_G['style'][wrapbg] => 主体表格背景色
$_G['style'][wrapbordercolor] => 主体表格边框色
$_G['style'][contentwidth] => 阅读区域宽度
$_G['style'][contentseparate] => 帖子间隔颜色
$_G['style'][inputborder] => 输入框边框浅色
$_G['style'][menuhoverbgcode] => 导航菜单高亮背景
$_G['style'][floatbgcode] => 弹出窗口背景色
$_G['style'][dropmenubgcode] => 下拉菜单背景色
$_G['style'][floatmaskbgcode] => 弹出窗口边框颜色
$_G['style'][headerbgcode] => 页头背景
$_G['style'][sidebgcode] => 家园侧边栏背景属性
$_G['style'][bgcode] => 全局背景属性属性
$_G['style'][titlebgcode] => 版块列表标题背景$_G['style'][menubgcode] => 导航菜单背景属性
$_G['style'][boardlogo] => LOGO img代码
