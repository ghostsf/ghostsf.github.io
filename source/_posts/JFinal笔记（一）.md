title: JFinal笔记（一）
categories: 技术栈
tags: [jfinal]
date: 2016-03-09 01:42:00
---
**JFinal为啥默认使用FreeMarker**

> FreeMarker使用起来非常地方便，功能也很强大。Velocity也很不错，但Velocity的layout功能要在web.xml中配置Servlet，不够优雅，违备了JFinal遵循的COC原则。FreeMarker可以通过定义宏来实现layout功能，非常方便，另外有开发者测试得出当视图中的动态内容过多时FreeMarker性能优于Velocity。
> 
> 要使用别的视图类型也很简单，只需要在JFinalConfig继承类中的configConstant(Constants
> constans)方法中这样设置一下：constants.setViewType(ViewType.VELOCITY)或者constants.setViewType(ViewType.JSP)即可。另外，就算不设置的话，也可以办得到，可以在Controller
> 中调用renderVelocity(...)或renderJsp(...)即可，也就是说JFinal可以支持混合视图型。另外还可以通过继承Render抽象类来无限扩展视图类型，如
> XmlRender等等

**关于视图问题** 

> me.setViewType(ViewType) 这个是专门用于设置  Controller.render(String)
> 这个方法使用时的视图类型的，因为这个方法最简短，被建议为最常用的一个 render 方法，所以通常需要对此方法设置一个
> ViewType，默认是 freemarker 视图类型。
> 
> 另外 Controller 中还有很多其它的 renderXxxx(...) 方法，这些方法与
> me.setViewType(ViewType) 设置无关，所以可以在 jfinal 中同时使用 FreeMarker、JSP等等视图，如
> renderJsp(...)、renderFreeMarker(...)。
> 
> 最后，还可以通过 Controller.render(Render render) 这个方法使用无穷多个类型的视图类型，例如
> render(new MyRender(....))

