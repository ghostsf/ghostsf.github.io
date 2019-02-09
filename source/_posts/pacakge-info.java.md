title: pacakge-info.java
categories: 旧文字
tags: [pacakge-info.java]
date: 2017-02-21 05:30:48
---
pacakge-info.java是一个Java文件，可以添加到任何的Java源码包中。pacakge-info.java的目标是提供一个包级的文档说明或者是包级的注释。

pacakge-info.java文件中，唯一要求包含的内容是包的声明语句，比如：

    package com.ghostsf.tools;

**包文档**
在Java 5之前，包级的文档是package.html，是通过JavaDoc生成的。而在Java 5以上版本，包的描述以及相关的文档都可以写入pacakge-info.java文件，它也用于JavaDoc的生成。比如：

    /**
     * Created by ghostsf on 2017/2/21.
     * www.ghostsf.com
     *
     * webservice包
     */
    package com.archermind.webservice;

上面的说明通过JavaDoc生成，会携带。

在添加package-info.java之后，部分IDE可以在代码中会提示该包的注释信息。

**包注释**
注释对于程序员来说非常重要，pacakge-info.java文件包含了包级的注释。我们还可以使用ElementType来自定义注释。

包注释当然是**ElementType.PACKAGE**了，除此之外，还有：

    ElementType.TYPE (class, interface, enum) 
    ElementType.FIELD (instance variable) 
    ElementType.METHOD ElementType.PARAMETER 
    ElementType.CONSTRUCTOR 
    ElementType.LOCAL_VARIABLE 
    ElementType.ANNOTATION_TYPE

比如，想让包中的所有类型过时（`Deprecate`），你可以注释每一个单独的类型（类、接口、枚举等），如下所示：

    @DEPRECATED
    PUBLIC CLASS CONTACT {
    }

或者是可以在`package-info.java`包声明文件中使用@Deprecated注释，它可以让包中的一切均过时。

    @Deprecated
    package com.ghostsf.tools;

把package-info.java添加到包中
可以手动在包目录下创建package-info.java文件，也可以通过IDE工具实现这一点。
比如IDEA就很方便了：
![1.png][1]


  [1]: http://www.ghostsf.com/usr/uploads/2017/02/1224577079.png