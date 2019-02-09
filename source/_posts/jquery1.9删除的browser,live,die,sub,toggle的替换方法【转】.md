title: jquery1.9删除的browser,live,die,sub,toggle的替换方法【转】
categories: 旧文字
tags: [jquery,前端开发]
date: 2015-10-31 11:10:10
---
jQuery 1.9变化有几点，最重要的是标题所提到的browser,live,die,sub,toggle这几个，如果你在使用过程中遇到高级版本不行，而低版本却可以的时候，那你就要了解一下是不是版本升级带来的影响了。之前也转载过一篇“jQuery1.9升级和删除的API指南”的文章，文里面介绍了很多方面，其实很多我都没用过，这上面的几个，我也是熟悉过browser，live，toggle而已。

jQuery.browser()

官方推荐修改方式是通过条件判断来区分不同的浏览器

    <!--[if lt IE 9]><script src="http://m.cnblogs.com/109793/jquery-1.9.0.js" rel="nofollow"/><![endif]-->
    <!--[if gte IE 9]>
    <script src="http://m.cnblogs.com/109793/jquery-2.0.0.js" rel="nofollow"/>
    <![endif]-->

如果必须要继续使用jQuery.browser()可以添加“jquery-browser”插件，但我没有测试该插件。

对于你自己的项目功能检测的需求， 我们强烈建议使用外部库，比如Modernizr的，而不是依赖于jQuery.support上的属性。（因为 jQuery 内部需要使用support这些方法来进行检测，所以它们会在每次加载页面时被执行，但是当 jQuery 的内部代码不再需要某些属性时，它们就会被移除。）

.live()

.live()方法在1.9中移除，@ZPS在邮件中已经告知过大家。对于.live()方法的移除，升级比较简单，仅仅是将“.live()”替换为“.on()”。

.die()

相对于“.live()”方法的移除，“.die()”方法也从1.9中移除，取而代之的是“.off()”方法。正如在1.9之前，很多人只关注 过“.live()”方法，却不知道还有个“.die()”方法，或许还会有Coder不知道如何去掉.on()添加的事件，其实就是用“.off()” 进行删除添加的事件。

jQuery.sub()

.sub()方法可以创建一个新的jQuery副本而不影响原有的jQuery对象，我对该方法的理解是：其实.sub()方法就是增加或重写jQuery的方法或创建新plugin，有待讨论。

从上面升级指南上来看，.sub()方法并没有被removed，而是被moved到其他plugin，所以应该是还可以用的，只要引用相应的plugin。

官方给出的使用.sub()的两个特定情况：一是在不改变原有方法的前提下提供一种简单的重写jQuery方法的途径，二是帮助用户解决jQuery plugin封装和基本命名空间。

.toggle(function, function, … )

下面这个jQuery插件能够还原1.8的toggle的功能，如果你需要，可以直接把下面这段代码拷贝到你的jQuery里面，然后跟平时一样使用toggle的功能即可。


<!--more-->


    //toggle plugin from caibaojian.com
    $.fn.toggler = function( fn, fn2 ) {
        var args = arguments,guid = fn.guid || $.guid++,i=0,
        toggler = function( event ) {
          var lastToggle = ( $._data( this, "lastToggle" + fn.guid ) || 0 ) % i;
          $._data( this, "lastToggle" + fn.guid, lastToggle + 1 );
          event.preventDefault();
          return args[ lastToggle ].apply( this, arguments ) || false;
        };
        toggler.guid = guid;
        while ( i < args.length ) {
          args[ i++ ].guid = guid;
        }
        return this.click( toggler );
      };

其实toggle这个去掉主要是考虑到会混淆，而且jquery里面已经可以实现了，这个是多余出来的。

我们可以这样子修改

    $('#example').click(function(){$("#exampleBox").toggle();})
    改为
    $('#example').click(function(){
        if($("#exampleBox").is(":visible")){
            $("#exampleBox").hide();
            do stuff
        }else{
            $("#exampleBox").show();
            do stuff
        }
    })
    $("#example").hover(function(){$("#exampleBox").toggle(); })
    改为
    $("#example").hover(function(){
    $("#exampleBox").show();
    },function(){
    $("#exampleBox").hide();
    });
    岂不是更加清晰明了

或者你也可以使用toggleClass来通过添加类来显示与隐藏。

转载自 [jquery1.9删除的browser,live,die,sub,toggle的替换方法][1]


  [1]: http://caibaojian.com/jquery1-9-tutorial.html