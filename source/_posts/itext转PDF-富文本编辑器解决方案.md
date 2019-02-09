title: itext转PDF 富文本编辑器解决方案
categories: 旧文字
tags: [itext,富文本]
date: 2015-09-30 13:26:00
---
> 富文本对于itext转PDF来说，就是一场灾难。

**itext转PDF需要注意的地方：**
1. 所有标签必须闭合，如`<input /> <img /> <br />` （有时候html内容非常非常多，其实很难找到哪里没闭合，这时候要头疼死，没关系，有解决办法的，firefox下载一个叫html validator的插件，配置一下，只看没有闭合的错误，其它的一些如该标签没有什么什么属性这些错误，不用管）
2. 页面中不能出现&nbsp;  这是下载不成功的，把所有的 &nbsp; 改成 &#160;
3. 如果你页面中，有table代码，你的table记得在style中加一个属性：table-layout:fixed; word-break:break-strict;
4. 上面博客中，说是<html>标签上面要加一个dtd，我个人试了下，加跟没加，没区别，反正我没加
5. 你的页面中，可以引入css文件，可以写style标签，但一定要记得，<style></style>这个必须是放在head里，不然不能渲染你的样式。
6. 你的标签属性，属性值必须以引号包含，如width="50"，如不包含，会报错。
7. 标签名称，如<td>，不能写成<TD>，大写的，在IE下载时，不兼容，会报错。

**关于富文本**


<!--more-->


上面说的几条，基本上富文本都不会遵守，也就是说，即使你自己写的html没有问题，但富文本编辑器插入的html，还是会这样。
1. 富文本不会帮你闭合你的标签，它只管显示正常，如<img /> <br/>，它会是<img >  <br>更有甚者，比如说tinymce，<br中间还会有很多一些它定义的东西。
2. 富文本对于空格或者一些空白，会帮你转成&nbsp; 这是灾难的开始
3. 用富文本拉出来的table，会帮你加各种样式，加各种宽度高度，即使能下载成功，也不能完全展示（当然，这个问题，一般的编辑器都支持你引入自己的css，我没试过，但应该可以控制）
4. 这个问题就很严重了，说的是IE浏览器，它并非所有的属性值都不用引号包含，但有很多属性值都会直接width=50这样，很残忍(fuck ie)（我用的是IE8测的）
5. 再说这个问题，也非常扯淡，富文本的内容，在IE上，输入完成，保存，保存时居然被转成大写了。
好吧，扯了这么多，现在说下富文本的解决方案吧。

有一个很蠢的解决方案，就是一个个地转，以下是我将html代码转成适合下载的html用到的，完全是发现一个问题，解决一个，也许还不全 ，后面应该还需要做些完善。

    /** 
         * 基本过滤，主要过滤特殊字符与下载时不规则字符，过滤table样式 
         * @param result 
         * @return 
         */  
        public static String reEscapeHtml(String result) {  
            String temp = result;  
          //匹配script整个标签的正则  
            final String scriptRegx = "(?i)(<SCRIPT)[\\s\\S]*?((</SCRIPT>)|(/>))";  
            //匹配换行的正则    
            final String brRegx = "(?i)(</*br.*?>)";  
            //空格  
            final String nbspRegx = "(&|&amp;)nbsp;";  
            //table  
            final String tableRegx = "(?i)(<table (?!ignore=\"true\").*?>)";  
            //img  
            final String imgRegx = "(?i)(<img\\s.*?>)";  
            temp = temp.replaceAll(scriptRegx, "")  
                    .replaceAll("\r|\n|\\r|\\n|\r\n|\\r\\n|\t|\\t", "")  
                    .replaceAll(imgRegx, "")  
                    .replaceAll(brRegx, "<br />")  
                    .replaceAll(nbspRegx, " ")  
                    .replaceAll(" ", " ")  
                    .replaceAll(tableRegx, "<table class=\"cm_tb\" style=\"width:100%;table-layout:fixed; word-break:break-strict;\">")  
                    ;  
              
            return temp;  
        }  
        
          
        /**  
         * 标签转小写，转完小写，顺便补全引号  
         * @param temp  
         * @return  
         */  
        public static String tagToLowerCaseAndComplete(String temp) {  
            //标签开始的匹配  
            final String tagRegx = "<[A-Za-z].*?>";  
            Pattern p = null;  
            Matcher matcher = null;  
            p = Pattern.compile(tagRegx);  
            matcher = p.matcher(temp);  
            while (matcher.find()) {  
                String value = matcher.group(0);  
                if (null == value || "".equals(value))  
                    continue;  
                String tmpValue = value.toLowerCase();  
              //自动补全引号，加这里而不加外面  
                tmpValue = reCompletionQuoat(tmpValue);  
                //tmpValue = removeWidthAndHeightInTag(tmpValue);  
                temp = replaceStr(temp, value, tmpValue);  
                  
            }  
            //结束标签的匹配  
            final String tagEndRegx = "</[A-Za-z]+>";  
            p = Pattern.compile(tagEndRegx);  
            matcher = p.matcher(temp);  
            while (matcher.find()) {  
                String value = matcher.group(0);  
                if (null == value || "".equals(value))  
                    continue;  
                temp = replaceStr(temp, value, value.toLowerCase());  
            }  
            return temp;  
        }  
          
        /** 
         * 自动补全引号（接上一步的标签转小写） 
         * @param str 
         * @return 
         */  
        public static String reCompletionQuoat(String tag) {  
            final String tagRegx = "([A-Za-z]+)=([^\"|\']*?)(>|\\s)";  
            Pattern p = Pattern.compile(tagRegx);  
            Matcher m = p.matcher(tag);  
            while (m.find()) {  
                String tmp = m.group(0);  
                String key = m.group(1);  
                if (null == key || "".equals(key.trim()))  
                    continue;  
                String value = "\"" + m.group(2) + "\"";  
                String end = m.group(3);  
                tag = replaceStr(tag, tmp, (key + "=" + value + end));  
            }  
            return tag;  
        }  
          
          
        /** 
         * width="1024px"|width='1024px'|width:1024px|width:1024px; 
         * 对于width，上面的example都可以过滤，height与width同样规则 
         * 对于width="50%"这样的，是不过滤的 
         * @param tag 
         * @return 
         */  
        public static String removeTableWidthAndHeight(String result) {  
            String widthAndHeightRegx = "(width|height)(=|:|\\s*?:\\s*?)(\"|\')*\\d+px(\"|\'|;)*";  
            //String tableRegx = "(?i)(<table (?!ignore=\"true\").*?>.*?</table>)";  
            return result.replaceAll(widthAndHeightRegx, "");  
        }  
          
        public static String replaceStr(String sourceStr, String targetStr, String insertStr) {  
            int index = sourceStr.indexOf(targetStr);  
            if (index == -1)  
                return sourceStr;  
            String preStr = sourceStr.substring(0, index);  
            String afterStr = sourceStr.substring(index + targetStr.length());  
              
            return preStr + insertStr + afterStr;  
        }  



**其他解决方案*
htmlcleaner这个html分析的jar，相信很多人都用过。我曾经用过一段时间，挺不错的。

htmlcleaner我记得有一个操作，你将一段html转成TagNode的时候，再去把html代码拿出来，这里面大多数标签，都会闭合，都会是一个很完整的标签，是一段比较完美的html代码。因为项目中考虑到第三方jar包的安全问题，我只提了出来，但没有去试过，我隐约记得以前做爬虫，htmlcleaner确实有这方面的操作的，感兴趣的朋友，可以去试一下。

而且，用htmlcleaner处理html元素，我相信，会比用正则处理字符串更好，不容易引发别的问题。有兴趣的朋友，可以试一下。

转载摘录自[itext转PDF，富文本编辑器解决方案][1]


  [1]: http://blog.csdn.net/javaloverkehui/article/details/38423665