title: Discuz门户DIY模块模板如何自定义语法标签
categories: 技术栈
tags: [discuz]
date: 2015-11-30 05:51:25
---
最近有看DZ，发现这块的教程很少，几乎没有，所以自己动手咯~
DZ的DIY功能，相信了解点DZ的朋友都知道，所以不做解释了。
那么DIY的模块模板的语法标签是什么呢？

![1.jpg][1]

如图所示，这些就是用在DIY模块模板里的语法标签。
DZ门户目前没有自定义字段的功能，需要我们自己自定义字段。自定义字段的方法,就不再赘述了。
那么我们自定义出来的字段，怎么才能在DIY里调用呢？
有人说可以用分类信息里功能，然并不能。分类信息的自定义字段功能里虽然有关于DIY的调用标签，但是这个功能，只是针对论坛版块的。而且，必须在DIY的时候使用静态模块里的分类信息的，数据来源也只能是论坛里的。所以这不是我们想要的。
那么到底需要怎么做才能实现自定义的语法标签呢？
既然DZ的源码都在手了，那就直接看相关源码咯:
我们需要明确的是模块的相关源码都在这个位置：`/source/class/block`
那么对应的门户这块，就是`/source/class/block/portal`了
关于门户文章的，我们修改其下这个文件`block_article.php`即可
我们找到fields这个方法进行相关修改即可。比如我们现在要加入一个author原作者的一个语法标签。如图，新增这行代码即可。

![2.png][2]

具体代码如下：


<!--more-->


    function fields() {
    		return array(
    				'id' => array('name' => lang('blockclass', 'blockclass_field_id'), 'formtype' => 'text', 'datatype' => 'int'),
    				'uid' => array('name' => lang('blockclass', 'blockclass_article_field_uid'), 'formtype' => 'text', 'datatype' => 'int'),
    				'username' => array('name' => lang('blockclass', 'blockclass_article_field_username'), 'formtype' => 'text', 'datatype' => 'string'),
    				'author' => array('name' => lang('blockclass', 'blockclass_article_field_author'), 'formtype' => 'text', 'datatype' => 'string'),
    				'avatar' => array('name' => lang('blockclass', 'blockclass_article_field_avatar'), 'formtype' => 'text', 'datatype' => 'string'),
    				'avatar_middle' => array('name' => lang('blockclass', 'blockclass_article_field_avatar_middle'), 'formtype' => 'text', 'datatype' => 'string'),
    				'avatar_big' => array('name' => lang('blockclass', 'blockclass_article_field_avatar_big'), 'formtype' => 'text', 'datatype' => 'string'),
    				'url' => array('name' => lang('blockclass', 'blockclass_article_field_url'), 'formtype' => 'text', 'datatype' => 'string'),
    				'title' => array('name' => lang('blockclass', 'blockclass_article_field_title'), 'formtype' => 'title', 'datatype' => 'title'),
    				'pic' => array('name' => lang('blockclass', 'blockclass_article_field_pic'), 'formtype' => 'pic', 'datatype' => 'pic'),
    				'summary' => array('name' => lang('blockclass', 'blockclass_article_field_summary'), 'formtype' => 'summary', 'datatype' => 'summary'),
    				'dateline' => array('name' => lang('blockclass', 'blockclass_article_field_dateline'), 'formtype' => 'date', 'datatype' => 'date'),
    				'caturl' => array('name' => lang('blockclass', 'blockclass_article_field_caturl'), 'formtype' => 'text', 'datatype' => 'string'),
    				'catname' => array('name' => lang('blockclass', 'blockclass_article_field_catname'), 'formtype' => 'text', 'datatype' => 'string'),
    				'articles' => array('name' => lang('blockclass', 'blockclass_article_field_articles'), 'formtype' => 'text', 'datatype' => 'int'),
    				'viewnum' => array('name' => lang('blockclass', 'blockclass_article_field_viewnum'), 'formtype' => 'text', 'datatype' => 'int'),
    				'commentnum' => array('name' => lang('blockclass', 'blockclass_article_field_commentnum'), 'formtype' => 'text', 'datatype' => 'int'),
    			);
    	}

同时需要修改function getdata这个方法(201~335行)。给author语法标签赋予相应的值。也很简单，加入一个赋值语句即可

    $list[] = array(
    				'id' => $data['aid'],
    				'idtype' => 'aid',
    				'title' => cutstr($data['title'], $titlelength, ''),
    				'url' => fetch_article_url($data),
    				'pic' => $data['pic'],
    				'picflag' => $data['picflag'],
    				'summary' => cutstr(strip_tags($data['summary']), $summarylength, ''),
    				'fields' => array(
    					'uid'=>$data['uid'],
    					'username'=>$data['username'],
    					'author'=>$data['author'],
    					'avatar' => avatar($data['uid'], 'small', true, false, false, $_G['setting']['ucenterurl']),
    					'avatar_middle' => avatar($data['uid'], 'middle', true, false, false, $_G['setting']['ucenterurl']),
    					'avatar_big' => avatar($data['uid'], 'big', true, false, false, $_G['setting']['ucenterurl']),
    					'fulltitle' => $data['title'],
    					'dateline'=>$data['dateline'],
    					'caturl'=> $_G['cache']['portalcategory'][$data['catid']]['caturl'],
    					'catname' => $_G['cache']['portalcategory'][$data['catid']]['catname'],
    					'articles' => $_G['cache']['portalcategory'][$data['catid']]['articles'],
    					'viewnum' => intval($data['viewnum']),
    					'commentnum' => intval($data['commentnum'])
    				)
    			);
这样就给author该语法标签赋上值了，此时在DIY模板里就可以调用了。
当然细心会发现此时还有个语言的问题，也就是加字段的那块代码里的lang的问题。

    'author' => array('name' => lang('blockclass', 'blockclass_article_field_author'), 'formtype' => 'text', 'datatype' => 'string'),

我们可以看到在lang语言包里，我们还没有`blockclass_article_field_author`，所以在页面上，我们还看不到其对应的文字内容。
所以我们还需要找到相关的lang语言包，增加此`blockclass_article_field_author`对应的文字内容。这个也很简单。
DZ的语言包都在`/source/language`文件夹下，对应的模块模板的语言包文件在其下的`lang_blockclass.php`文件中。
我们只需要在该文件的`$lang = array(`lang数组中加入该值即可。
比如这样:`'blockclass_article_field_author' => '原作者名',`
至此，我们在门户文章DIY模块模板里新增的自定义的语法标签，就搞定了。当然这里没有做自定义字段，只是做了个门户文章模块模板的DIY语法标签里没有的author原作者的字段。自定义的字段等，方法与此相同啦。大家可以以一举三。
By the way，希望官方早点给门户搞一个自定义字段的功能，这个还是蛮需要的。

> 本博文内容由[ghostsf][3]原创，转载请注明来源，谢谢。


  [1]: http://www.ghostsf.com/usr/uploads/2015/11/1451540919.jpg
  [2]: http://www.ghostsf.com/usr/uploads/2015/11/2781613901.png
  [3]: http://www.ghostsf.com
