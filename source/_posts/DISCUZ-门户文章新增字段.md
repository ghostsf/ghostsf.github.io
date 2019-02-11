title: DISCUZ 门户文章新增字段
categories: 技术栈
tags: [php,discuz]
date: 2015-11-12 13:53:00
---
数据库操作

表：dz_portal_article_title

增加字段：例

    `stick` tinyint(1) DEFAULT ‘0’,
    `words` smallint(6) NOT NULL DEFAULT ‘0’,

编辑：/template/default/portal/portalcp_article.htm      208行后增加

    <dt>置顶 <input type=”checkbox” id=”stick” onclick=’this.value=(this.value===”false”)?”true”:”false”;’ name=”stick” class=”pc” {if ($article[‘stick’]==1)} checked=”checked” value=”true” {else} value=”false”{/if} /></dt>
    <dd>话数 <input type=”text” name=’words’ class=”px p_fre” size=”20″ value='{$article[‘words’]}’/></dd>

 

编辑：\source\include\portalcp\portalcp_article.php    86行 $setarr = array( 内增加

    ‘stick’ =>empty($_POST[‘stick’]) ? ‘0’ : ‘1’,
    ‘words’ => $_GET[‘words’],

 

嗯。接下来，就在需要的地方调用就好了！

例：\template\default\portal\list.htm  在  <!–{loop $list[‘list’] $value}–> 内调用  $value[words]
