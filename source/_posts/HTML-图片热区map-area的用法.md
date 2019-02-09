title: HTML 图片热区map area的用法
categories: 旧文字
tags: [html,map,area]
date: 2015-07-29 06:33:30
---
<area>标记主要用于图像地图，通过该标记可以在图像地图中设定作用区域（又称为热点），这样当用户的鼠标移到指定的作用区域点击时，会自动链接到预先设定好的页面。其基本语法结构如下：

    1	<area
    2	    class=type
    3	    id＝Value 
    4	    href＝url 
    5	    alt＝text 
    6	    shape＝area-shape 
    7	    coods＝value>

shape和coords：是两个主要的参数，用于设定热点的形状和大小。其基本用法如下：

<area shape="rect" coords="x1, y1,x2,y2" href=url>表示设定热点的形状为矩形，左上角顶点坐标为（X1,y1），右下角顶点坐标为（X2,y2）。
<area shape="circle" coords="x1, y1,r" href=url>表示设定热点的形状为圆形，圆心坐标为（X1,y1），半径为r。
<area shape="poligon" coords="x1, y1,x2,y2 ......" href=url>表示设定热点的形状为多边形，各顶点坐标依次为（X1,y1）、（X2,y2）、（x3,y3） ......。
<area>标记是在图像地图中划分作用区域的，因此其划分的作用区域必须在图像地图的区域内，所以在用 <area> 标记划分区域前必须用HTML的另一个标记<map>来设定图像地图的作用区域，并为指定的图像地图设定名称，该标记的用法很简单，即<map name="图像地图名称"> ...... </map>。


<!--more-->


下面通过一个例子来说明这两个标记的用法：

这里是一幅新书架的图片，要做的效果是：当鼠标点"网址大全"这本书时，新开一窗口，显示关于这本书的简介及订单的网页（urlall.htm）；当 鼠标点"网站设计攻略"这本书时，新开一窗口，显示关于这本书的简介及订单的网页（siteall.htm）；当鼠标点"网页技巧大全"这本书时，新开一 窗口，显示关于这本书的简介及订单的网页（pagejqlall.htm）。制作方法：

插入图片，并设置好图像的有关参数，且在<img>标记中设置参数usemap="newbook" ismap，以表示对图像地图（newbook）的引用；
用<map>标记设定图像地图的作用区域，并取名为：newbook；
分别用<area>标记针对三本书的位置划分出三个矩形作用区域，并设定好其链接参数href。

    1	<img src="image/htmlp3.gif" width="207" height="148" alt="新书架" hspace="10" align="left" usemap="#newbook" border="0"> 
    2	<map name="newbook"> 
    3	<area shape="rect" coords="56,69,78,139" href="urlall.htm" target="_blank" alt="这里收集十万多个网址。" title="这里收集十万多个网址。"> 
    4	<area shape="rect" coords="82,70,103,136" href="siteall.htm" target="_blank" alt="网站设计师的启蒙读本。" title="网站设计师的启蒙读本。"> 
    5	<area shape="rect" coords="106,68,128,136" href="pageall.htm" target="_blank" alt="网页制作者不可不读的书。" title="网页制作者不可不读的书。"> 
    6	</map>

在制作本文介绍的效果时应注意的几点：

在<img>标记不要忘记设置usemap、ismap参数，且usemap的参数值必须与<map>标记中的name参数值相同，也就是说，"图像地图名称"要一致；
同一"图像地图"中的所有热点区域都要在图像地图的范围内，即所有<area>标记均要在<map>与</map>之间；
在<area>标记中的 cords 参数设定的坐标格式要与shape参数设定的作用区域形状配套，避免出现在shape参数设置的矩形作用区域，而在cords 中设置的却是多边形区域顶点坐标的现象出现。
coords 属性

<area> 标签的 coords 属性定义了客户端图像映射中对鼠标敏感的区域的坐标。坐标的数字及其含义取决于 shape 属性中决定的区域形状。可以将客户端图像映射中的超链接区域定义为矩形、圆形或多边形等。

下面列出了每种形状的适当值：

圆形：shape="circle"，coords="x,y,z"：这里的 x 和 y 定义了圆心的位置（"0,0" 是图像左上角的坐标），r 是以像素为单位的圆形半径。

多边形：shape="polygon"，coords="x1,y1,x2,y2,x3,y3,..."：每一对 "x,y" 坐标都定义了多边形的一个顶点（"0,0" 是图像左上角的坐标）。定义三角形至少需要三组坐标；高纬多边形则需要更多数量的顶点。多边形会自动封闭，因此在列表的结尾不需要重复第一个坐标来闭合整个区域。

矩形：shape="rectangle"，coords="x1,y1,x2,y2"：第一个坐标是矩形的一个角的顶点坐标，另一对坐标是对角的顶点坐标，"0,0" 是图像左上角的坐标。请注意，定义举行实际上是定义带有四个顶点的多边形的一种简化方法。

例如，下面的 XHTML 片段在一个 100x100 像素图像的右下方四分之一处，定义了一个对鼠标敏感的区域，并在图像的正中间定义了一个圆形区域。

    1	<map name="map"> 
    2	<area shape="rect" coords="75,75,99,99" nohref="nohref"> 
    3	<area shape="circ" coords="50,50,25" nohref="nohref"> 
    4	</map>

注释：如果某个 area 标签中的坐标和其他区域发生了重叠，会优先采用最先出现的 area 标签。浏览器会忽略超过图像边界范围之外的坐标。

转载自 [冬之鸟博客][1]


  [1]: http://www.cnblogs.com/ITRoad/archive/2011/12/14/2287520.html