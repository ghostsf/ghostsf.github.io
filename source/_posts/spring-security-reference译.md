title: spring security reference译
categories: 旧文字
tags: [spring security,英语,翻译]
date: 2015-07-13 03:12:04
---
序言
Spring security 为基于j2EE的企业应用软件提供了一套全面的安全解决方案。正如你将会从这本指导指南中探索发现的那样，我们尽力为你提供一套有用的、高配置的安全系统。

安全性是一个不断变化的目标，重要的是追求一个全面的、系统化的方案。在安全领域，我们鼓励你采用“分层安全”，以至于每一层尽可能地确保自身的安全，并且为相继的层提供额外的安全保障。每一层的安全性越“紧密”你的程序就将会越精壮越安全。在底层你需要处理类似于传输安全和系统认证的问题来缓和“中间人攻击”（man-in-the -middle attacks）。接下来，你通常将会使用到防火墙，也许还会结合VPNs或IP安全性来确保只有获得授权的系统才可以尝试连接。在企业环境中，你可能会部署一个隔离区（DMZ=demilitarized zone）将面向公众的服务器与后端数据库和应用服务器分类开。在解决类似于无特权用户运行进程和系统文档安全最大化的问题上，你的操作系统也将扮演一个至关重要的部分。操作系统通常配置有自己的防火墙。希望在这个过程中的某处你将尽可能地阻止针对系统的拒绝服务和暴力攻击。入侵检测系统在针对监测和应对攻击时将是尤为有用的，有了这些系统就可以采取保护措施，例如实时屏蔽恶意TCP/IP地址。移动到更高层，你需要配置java虚拟机，授予不同java类型权限最小化，然后你的应用程序将要添加针对自身特殊问题域的安全配置。Spring security是的应用程序安全变得更容易。

当然，你需要妥善处理以上提到的所有安全层，结合每一层所包含的管理因素。这样的管理因素的一个非详尽列表里可能包括：安全监测公告、补丁、人工诊断、审计、改变控制、工程管理系统、数据备份、灾后恢复、性能基准、登陆监测、集中日志、应急反应程序等等。

随着spring security被重点用于企业应用安全层，你将会发现不同的业务问题领域存在着不同的需求。银行应用程序与电子商务应用程序有着不同的需求。电子商务又与企业销售自动化有着不同的需求。这些客户需求使得应用安全有趣、具有挑战性并且有价值。

请阅读Part 2,p2将向你介绍架构和以空间命名为基础的系统配置方式，这样你就可以很快的启动并且运行程序。为了更多地了解到spring security是如何工作的，你需要使用一些类，那么就请你继续阅读part3的“结构与实现”。
吧啦吧啦后面一堆没啥用，我就直接给你翻译part 2了！

Part 2 getting started
指南的后面部分提供对框架结构和实现类的深入讨论，如果你想要进行复杂制定，你就要对其进行了解。在这一部分，我们将会介绍spring security3.0，给出项目历史的简要概述，然后很粗略随意地看一下如何开始使用框架。特别地，我们将看到命名空间配置为你的应用程序安全提供了一种与传统的那种不得不连接实现所有的类的spring bean相比更简单的方法。

我们还会看一下简单的范例程序。在你阅读之后章节之前值得运行和实验。你可以在对框架有所了解之后回过头来再看那些范例。


<!--more-->


1. INTRODUCTION
1.1 Spring Security是个啥？
Spring security为基于j2EE的企业应用软件提供了全面的安全服务。这里特别着重于支持使用spring framework建立项目，为企业软件开发提供领先的J2 EE解决方案。如果你没有使用过spring开发企业软件，我们热烈地欢迎你来看一下噢~ ~一些我们很熟悉的spring --尤其是依赖注入原理--将会帮助你更容易地快速掌握spring security。

人们使用spring security有很多原因，但是大多数是被Java EE’s Servlet Specification 或EJB Specification 缺乏典型企业应用场景的特点所拖下水的。提到这些规范，特别要指出的是，他们在WAR或EAR级别上不便携。因此，如果你要转换服务环境，在新的目标环境下重新对你的应用系统进行安全配置会需要特别大的工作量。使用spring security克服了这些麻烦，并且给你带来了许多益处和可制定性的特点。

你也许会知道两种安全操作“认证”和“验证”。这是spring security面向的两个主要方向。“认证”是建立一个所声明身份的标准的一个过程。“验证”是指一个用户能否在你的应用中执行某个操作。在到达授权判断之前，身份的主体已经由身份验证过程建立了。 这些概念是通用的，不是Spring Security特有的。

在身份验证层面，Spring Security广泛支持各种身份验证模式。这些验证模型绝大多数都由第三方提供，或者正在被有关标准机构开发例如Internet Engineering Task Force。 除此之外，Spring Security也提供了自己的一套验证功能。 具体来说，Spring Security目前支持认证一体化和如下认证技术：
HTTP BASIC authentication headers (一个基于IEFT RFC的标准)
HTTP Digest authentication headers (一个基于IEFT RFC的标准)
HTTP X.509 client certificate exchange (一个基于IEFT RFC的标准)
LDAP (一个非常常见的跨平台认证需要做法，特别是在大环境)
Form-based authentication (提供简单用户接口的需求)
OpenID authentication
基于预先建立的请求头进行认证 （比如Computer Associates Siteminder）
JA-SIG Central Authentication Service (也被称为CAS，这是一个流行的开源单点登录系统)
Transparent authentication context propagation for Remote Method Invocation (RMI) and HttpInvoker
(一个Spring远程调用协议)
Automatic "remember-me" authentication (这样你可以设置一段时间，避免在一段时间内还需要重新验证)
Anonymous authentication (允许任何调用，自动假设一个特定的安全主体)
Run-as authentication (这在一个会话内使用不同安全身份的时候是非常有用的)
Java Authentication and Authorization Service (JAAS)
JEE Container autentication (这样，你可以继续使用容器管理认证，如果想的话)
Kerberos
Java Open Source Single Sign On (JOSSO) *
OpenNMS Network Management Platform *
AppFuse *
AndroMDA *
Mule ESB *
Direct Web Request (DWR) *
Grails *
Tapestry *
JTrac *
Jasypt *
Roller *
Elastic Plath *
Atlassian Crowd *
你自己的认证系统(向下看)
(* 是指由第三方提供，查看我们的整合网页，获得最新详情的链接。)

许多独立软件供应商采用Spring Security，是因为它拥有丰富灵活的验证模型。
这样，无论终端用户需要什么，他们都可以快速集成到系统中，不用花很多功夫，
也不用让用户改变运行环境。 如果上述的验证机制都没有满足你的需要，Spring
Security是一个开放的平台，编写自己的验证机制是十分简单的。 Spring Security的许多企业用户需要整合不遵循任何特定安全标准的“遗留”系统，Spring Security在这类系统上也表现的很好。

除了认证机制，Spring Security也提供了完备的授权功能。在授权方面主要有三个领域：授权web请求，授权被调用方法，授权访问单个对象的实例。
为了帮你了解它们之间的区别，对照考虑授在Servlet规范web模式安全，EJB容器管理安全，和文件系统安全方面的授权方式。 Spring Security在所有这些重要领域都提供了完备的能力，我们将在这份参考指南的后面进行探讨。

1.2. 历史

1.3. 发行版本号

1.4. 获得Spring Security

1.4.1.
主要讲使用Maven来构建你的项目，你需要把这些模块添加到你的pom.xml
中。



 