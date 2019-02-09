title: Discuz模板开发技术手册
categories: 旧文字
tags: [discuz模板制作,discuz]
date: 2016-06-18 09:40:00
---
登录

    <a href="member.php?mod=logging&action=login" title="登录">登录</a>

注册

    <a href="member.php?mod=register" title="立即注册">立即注册</a>

忘记密码

    <a href="javascript:;" title="找回密码">找回密码</a>


购买邀请码 

    misc.php?mod=buyinvitecode


JS跳转

    onclick="window.location.href='home.php?mod=mobile&do=friend';"


JS更换class的名称

    document.getElementById('idname').className='a';
    document.getElementById('idname').style.display='block';
    document.getElementById("idname").style.marginTop="30px";


批量替换超链接：

    href="[^"]*"


过滤DZ代码：

    preg_replace ("/\[[a-z][^\]]*\]|\[\/[a-z]+\]/i",'',preg_replace("/\[attach\]\d+\[\/attach\]/i",'',$message));


调用单个数据


<!--more-->


    $a = DB::result(DB::query("SELECT qi FROM ".DB::table('abc')." WHERE id = '1'"));


调用统计数据

    $a = DB::result(DB::query("SELECT count(*) FROM ".DB::table('abc')." WHERE id = '1'"));


单数据表调用

    $perpage = 20;
    $curpage = empty ( $_GET['page'] ) ? 1 : intval ( $_GET['page'] );
    $start = ($curpage-1)*$perpage;
    $askcount = DB::result(DB::query("SELECT COUNT(*) FROM ".DB::table('forum_thread')." WHERE fid = '2' AND authorid > 1"));
    //$asklist
    $asklist = array();
    if ($askcount) {
            $query = DB::query("SELECT * FROM ".DB::table('forum_thread')." WHERE fid = '2' AND displayorder > -1 ORDER BY tid ASC LIMIT $start,$perpage");
            while ($value = DB::fetch($query)) {
                    $asklist[] = $value;
            }
    }
    $multi = multi($askcount, $perpage, $curpage, "这里填写跳转地址");


多数据表调用

    $perpage = 40;
    $curpage = empty ( $_GET['page'] ) ? 1 : intval ( $_GET['page'] );
    $start = ($curpage-1)*$perpage;
    $acount = DB::result(DB::query("SELECT count(*) FROM ".DB::table('forum_forum')." b LEFT JOIN ".DB::table('forum_forumfield')." bf ON bf.fid=b.fid WHERE b.type='sub' AND b.status = 3 AND bf.icon != ''"));
    //$alist
    $alist = array();
    if ($acount) {
            $query = DB::query("SELECT bf.*, b.* FROM ".DB::table('forum_forum')." b LEFT JOIN ".DB::table('forum_forumfield')." bf ON bf.fid=b.fid WHERE b.type='sub' AND b.status = 3 AND bf.icon != '' ORDER BY bf.shoplevel DESC, b.commoncredits DESC, bf.fid DESC LIMIT $start,$perpage");
            while ($value = DB::fetch($query)) {
                    $alist[] = $value;
            }
    }
    $multi = multi($acount, $perpage, $curpage, "这里填写跳转地址");


前台数据显示

    <!--{loop $alist $key $value}-->
    <!--{eval $tupianfm = DB::result(DB::query("SELECT attachment FROM ".DB::table('forum_threadimage')." WHERE tid = '$value[tid]'"));}-->
    <img src="$tupianfm"><br>$value[authorid]
    <!--{/loop}-->


取数据表中符合条件的第一条数据

    $app=array();
    $app=DB::fetch_first("select * from ".DB::table('abc')." where id='{$id}'");


人性化时间戳

    <!--{echo dgmdate(这里填写时间参数, 'u', '9999', getglobal('setting/dateformat'))}-->
    <!--{echo date("Y-m/d H:i:s",这里填写时间参数)}-->


截取字符字数

    <!--{echo cutstr(这里填写参数,40)}-->


过滤DISCUZ代码

    preg_replace ("/\[[a-z][^\]]*\]|\[\/[a-z]+\]/i",'',preg_replace("/\[attach\]\d+\[\/attach\]/i",'',$message));

写入数据库

    if(submitcheck('tijiao')) {
            $setarr = array(
                    'tid' => $_GET['topicid'],
                    'name' => $_POST['name'],
                    'position' => $_GET['position'],
                    'dateline' => $_G['timestamp'],
            );
            DB::insert('abc', $setarr, 1);
            $query = DB::query("UPDATE ".DB::table('abc')." SET stickreply='1' WHERE tid='$tid'");
            $query = DB::query("DELETE FROM ".DB::table('abc')." WHERE pid='$pid'");
            showmessage('成功的提示信息', "跳转地址");
    }


表单提交：

    <form action="do.php" method="post" autocomplete="off">
            <input type="hidden" value="{FORMHASH}" name="formhash" />
            最低奖金：<input name="qi" type="text" value="" />　
            最高奖金：<input name="end" type="text" value="" />　　
            <button value="true" name="tijiao" type="submit">提交设置</button>
            <input type="hidden" name="tijiao" value="true" />
    </form>


以下两个时间格式是对等关系

    date("Ymd",time());  20150212
    FROM_UNIXTIME(dateline, '%Y%m%d')

前者用于PHP，后者用于数据库调用的字段的格式化

调用图片附件

    <!--{eval $biaoid = substr($value[tid], -1); $cover = DB::result(DB::query("SELECT attachment FROM ".DB::table('forum_attachment_'.$biaoid.'')." WHERE tid = '$value[tid]'"));}-->


数据库循环嵌套调用

    <!--{eval $slides = DB::fetch_all("SELECT * FROM ".DB::table('a')." WHERE `uid`= $_G[uid] ORDER BY `id` DESC");}-->
    <!--{loop $slides $slide}-->
    $slide[name]
    <!--{/loop}-->


ucenter无法登录：
打开uc_server/model/admin.php
找到第22行的

    $this->cookie_status = 0;

改成

    $this->cookie_status = isset($_COOKIE['sid']) ? 1 : 0;


无刷新切换li标签并且同时加载框架页面：

    <script type="text/javascript"> 
    var jq = jQuery.noConflict();
    jq(function(){ 
    jq("#changemenu>li").mouseover(function(){ 
    jq("#changemenu>li").each(function(i){ 
    jq(this).removeClass("current"); 
    }); 
    jq(this).addClass("current"); 
    document.getElementById("changenr").innerHTML='<iframe src="do.php?id='+jq(this).attr('dataid')+'" height="350" width="1070" frameborder="0" scrolling="no"></iframe>';
    }).mouseout(function(){ 
    jq(this).addClass("current"); 
    }); 
    });
    </script>
    <ul id=“changemenu”>
       <li class=“current” dataid=“1”></li>
       <li dataid=“2”></li>
    </ul>
    <div id=“changenr”></div>


快速发帖

    <a href="forum.php?mod=misc&action=nav">发布新话题</a>


DISCUZ JSON数据解析获取

    $str = 'a:2:{s:8:\"sitename\";s:8:\"ghostsf\";s:3:\"pic\";s:12:\"banbanso.jpg\";}';
    $newstr = str_replace("\\","",$str);
    $data = unserialize($newstr);
    echo $data[sitename];//输出结果为ghostsf


DISCUZ云平台站点同步提示DNS错误解决方法：打开source\plugin\manyou\Service\Client\Restful.php，找到代码：
$result = $this->_fsockopen($url, 0, $data, '', false, $ip, 5);

修改为：

    $result = $this->_fsockopen($url, 0, $data, '', false, $ip, 30);


常用词汇

    select 选择
    count 总数
    table 表
    where 条件
    result 结果
    perpage 每页
    curpage 当前页
    update 更新
    delete 删除
    insert 写入
    dateline 日期
    time 时间
    echo 输出   <?php   echo '123';   ?>
    multi 分页函数
    if 如果
    else 否则
    elseif 
    start 起始
    limit 限制  limit 10
    DESC 倒序
    ASC 正序


转载自[DZ棒棒团][1]


  [1]: http://www.banban.so/
