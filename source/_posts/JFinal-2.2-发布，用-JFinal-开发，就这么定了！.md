title: JFinal 2.2 发布，用 JFinal 开发，就这么定了！
categories: 旧文字
tags: [jfinal]
date: 2016-01-19 02:35:06
---
> JFinal 2.2 主要针对于 2.1 版本中反馈集中的几个问题进行改进，另外也让jfinal 2.1非最终版用户升为统一的版本。

**1：改进paginate**

   在2.1 版中使用了正则对paginate方法匹配 select 与 group by 元素，为了性能采用粗放的正则时，则无法实现复杂sql的精确匹配，而为了精确匹配使用细致冗长的正则时，则性能急剧下降，简单sql相对于复杂sql甚至有上千倍的性能差距，权衡之下2.2 版弃用对select、group by的正则匹配，拆分sql为select及sqlExceptSelect，事实证明此法简单、粗爆、高效、可靠。此外，对 paginate 方法添加了 boolean isGroupBySql参数重载方法，用于强制指定sql语句是否为grup by sql。

**2：改进ModelRecordElResolver**

  添加setResolveBeanAsModel(boolean) ，设置为true时，用于指定在JSP/jstl中，对待合体后的Bean仍然采用老版本对待Model的方式输出数据，也即使用 Model.get(String attr)而非Bean的getter方法输出数据，有利于在关联查询时输出无 getter 方法的字段值。建议mysql数据表中的字段采用驼峰命名，表名采用下划线方式命名便于win与linux间移植。

注意：这里所指的 Bean 仅仅指用 BaseModelGenerator 生成的实现了 IBean接口后的Model类。

使用方法,在 YourJFinalConfig 中创建方法，并调用本方法：

    public void afterJFinalStart() {
      ModelRecordElResolver.setResolveBeanAsModel(true);
    }

当老版本项目升级到 jfinal 2.2 并且使用了生成器生成Bean，但又想保持原来的jsp输出方式，可将该变量设置为true。

**3：maven升级坐标，已推送至中心库，可立即升级**

    <dependency>
      <groupId>com.jfinal</groupId>
      <artifactId>jfinal</artifactId>
      <version>2.2</version>
    </dependency>

强烈建议 jfinal 2.1 升级至 2.2

**change log：**
1：改进paginate，sql参数为 select与sqlExceptSelect，简单、粗爆、高效、可靠。
2：添加boolean isGroupBy 的pagiante重载方法，用于强制指定sql语句是否为grup by sql
3：改进ModelRecordElResolver，添加setResolveBeanAsModel()，使用生成器生成的实现了IBean接口的 Class 将被当成 Model来处理
4：改进Controller中cookie操作，默认path值设置为"/"，避免某些浏览器不支持无默认path
5：Jackson、JFinalJson 中 private 可见性改为protected，便于扩展出个性化 json 转换实现
6：改进CaptchaRender,添加CaptchaRender.setCaptchaName()方法便于定义captchName，cookie的path设置为 "/"
7：改进Model、Db 的 paginate 方法
8：FileRender.encodeFileName() 改为 protected 便于扩展，字符集改为使用 getEncoding() 来获取

