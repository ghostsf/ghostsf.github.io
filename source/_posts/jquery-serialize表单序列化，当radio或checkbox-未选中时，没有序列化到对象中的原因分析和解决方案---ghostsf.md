title: jquery serialize表单序列化，当radio或checkbox 未选中时，没有序列化到对象中的原因分析和解决方案 - ghostsf
categories: 技术栈
tags: [ghostsf_serialize]
date: 2016-10-24 06:34:00
---


相信很多人都用过jq的表单序列化serialize()方法，因为这能很方便地帮你把表单里所有的非禁用输入控件序列化为 key/value 对象，不需要你再去一个个地拼接参数了。

这是一个很好用的函数，用过的你肯定知道。但是ghostsf最近发现一个小bug（也许不应该叫bug，姑且称之）。就是当radio或checkbox 未选中时，没有序列化到对象中。

什么原因呢?下面分析之:
瞄一眼源码：From jQuery JavaScript Library v2.1.4

    jQuery.fn.extend({
    	serialize: function() {
    		return jQuery.param( this.serializeArray() );
    	},
    	serializeArray: function() {
    		return this.map(function() {
    			// Can add propHook for "elements" to filter or add form elements
    			var elements = jQuery.prop( this, "elements" );
    			return elements ? jQuery.makeArray( elements ) : this;
    		})
    		.filter(function() {
    			var type = this.type;
    
    			// Use .is( ":disabled" ) so that fieldset[disabled] works
    			return this.name && !jQuery( this ).is( ":disabled" ) &&
    				rsubmittable.test( this.nodeName ) && !rsubmitterTypes.test( type ) &&
    				( this.checked || !rcheckableType.test( type ) );
    		})
    		.map(function( i, elem ) {
    			var val = jQuery( this ).val();
    
    			return val == null ?
    				null :
    				jQuery.isArray( val ) ?
    					jQuery.map( val, function( val ) {
    						return { name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
    					}) :
    					{ name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
    		}).get();
    	}
    });


不得不说代码写得很凝练。我们可以看到我们调用的serialize()，其实是走的param()方法，这个方法查阅jq手册即可得知，其作用是将数组或对象序列化为一个 key/value 对象。

显然这个方法不是我们要看的，重点就是serializeArray()了。
简单看下代码（只是简单看了下并未严格测试校验，可能有缺漏）。可以看到map里对于val的处理，判断到是数组的时候`jQuery.isArray( val ) ?`直接使用map进行了遍历，这个时候如果这个数组的length是0呢？那么自然当radio或checkbox 未选中时，这边的数组长度是为0的，所以这里就把radio或checkbox给漏掉了。

那么怎么解决呢？直接改源码？这也太粗暴了吧。

ghostsf心血来潮写了一个jq拓展，代码如下：（并不要脸地命名为ghostsf_serialize）：

    //为jquery.serializeArray()解决radio,checkbox未选中时没有序列化的问题
        $.fn.ghostsf_serialize = function () {
            var a = this.serializeArray();
            var $radio = $('input[type=radio],input[type=checkbox]', this);
            var temp = {};
            $.each($radio, function () {
                if (!temp.hasOwnProperty(this.name)) {
                    if ($("input[name='" + this.name + "']:checked").length == 0) {
                        temp[this.name] = "";
                        a.push({name: this.name, value: ""});
                    }
                }
            });
            //console.log(a);
            return jQuery.param(a);
        };

怎么使用呢？
引入即可，然后就是你常用的`$(form).ghostsf_serialize()`了。

这样就很轻松地解决此问题了。自己动手丰衣足食。


后续：

代码更新优化：


`$.fn.my_serialize_array = function () {
    var my_serialize_array = this.serializeArray();//官方函数只包含勾选的checkbox，并且值默认为on
    var not_checked_object=$('input[type=checkbox]:not(:checked)', this);//this指调用这个函数的form
    $.each(not_checked_object, function () {
        if (!my_serialize_array.hasOwnProperty(this.name)){//this指没选中的一个object
            my_serialize_array.push({name: this.name, value: "off"});
        }
    });
    console.log(my_serialize_array);
    return my_serialize_array;
};`
