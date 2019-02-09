title: Spring MVC的URL Mapping和Method Mapping配置
categories: 旧文字
tags: [spring mvc]
date: 2015-09-19 03:46:42
---
    <!-这里是配置类名注解，必须！->
    <!-- URL Mapping -->
    <bean class="org.springframework.web.servlet.mvc.support.ControllerClassNameHandlerMapping">
    <property name="caseSensitive" value="true" />
    </bean>
    
    <!-这里是配置方法名注解，必须！->
    <!-- Method Mapping -->
    <bean id="methodNameResolver" class="org.springframework.web.servlet.mvc.multiaction.InternalPathMethodNameResolver" />