title: Java进阶资源汇总 - ghostsf
categories: 
tags: []
date: 2017-03-06 04:53:33
---
Java经过将近20年的发展壮大，框架体系已经丰满俱全；从前端到后台到数据库，从智能终端到大数据都能看到Java的身影，个人感觉做后台进要求越来越高，越来越难。

为什么现在Java程序员越来越难做，一是Java框架体系众多，学习成本提高，每一个细分问题又有很多可选方案；二是经过移动互联网的洗礼，以前单机单线程那一套行不通了，现在面临的是高并发低延迟，你可能要掌握缓存、分布式、集群、微服务等；物联网时代渐渐到来，将IT行业技能要求推向一个新高度，你的产品要提供7x24小时不间断服务，就像家里的自来水管，打开阀门水不间断流出来。面对成千上万的智能终端上传的海量数据，从数据压缩上传、优化存储、管理、备份防灾、分析利用等方面，要掌握的技能还很多。

所以我把这些年收集的资源共享给大家。大致分为Java基础框架，网络通讯相关框架，论文算法类、工具类型框架四个模块。

**一、Java基础框架**
spring Framework 对于java读者来说spring再熟悉不过了，它就像一个拥有无限插孔的插线板，大部分框架都可以集成到spring容器当中即插即用，当然魔力不仅于此。
spring所有开源项目：https://github.com/spring-projects
spring官方文档：http://spring.io/docs/reference
springboot官方Demo：https://github.com/spring-projects/spring-boot/tree/master/spring-boot-samples
springboot推荐Demo：https://github.com/dyc87112/SpringBoot-Learning
入门教程：http://www.tutorialspoint.com/spring/spring_hello_world_example.htm
相关书籍：《spring技术内幕》
ORM Framework Hibernate vs mybatis Hibernate和mybatis都是目前最流行的ORM框架，各有优缺，仁者见仁。
Hibnate官方文档：http://hibernate.org/orm/documentation/5.2/
Hibernate开源地址：https://github.com/hibernate/hibernate-orm
马士兵Hibernate入门教程：http://blog.csdn.net/tanyit/article/details/6987279#_Toc251597143
Hibernate映射：http://blog.csdn.net/bigtree_3721/article/details/42343639
HQL：http://www.cnblogs.com/bobomail/archive/2005/09/20/240352.html
mybatis官方文档：http://www.mybatis.org/mybatis-3/
mybatis开源地址：https://github.com/mybatis/mybatis-3
mybatis教程：http://blog.csdn.net/techbirds_bao/article/details/9233599/
JPA规范：http://blog.csdn.net/jia20003/article/details/7907884

**二、网络通讯相关框架**
dubbo分布式服务框架
dubbo官方文档：http://dubbo.io/Developer+Guide-zh.htm
dubbo开源地址：https://github.com/alibaba/dubbo
dubbo入门：http://blog.csdn.net/top_code/article/details/51010614
dubbo集成到springboot：https://github.com/teaey/spring-boot-starter-dubbo
dubbo架构设计详解：http://shiyanjun.cn/archives/325.html
zookeeper分布式应用程序协调服务
官方文档：http://zookeeper.apache.org
开源地址：https://github.com/apache/zookeeper
安装部署：http://coolxing.iteye.com/blog/1871009
架构原理：http://blog.csdn.net/xhh198781/article/details/10949697
netty网络应用通讯框架
官方文档：http://netty.io/wiki/index.html
开源地址：https://github.com/netty/netty
开源案例：https://github.com/blynkkk/blynk-server
原理实现讲解：http://www.infoq.com/cn/articles/netty-high-performance
相关书籍：《Netty权威指南(第2版)》
MQ消息队列 知名的消息队列框架有ActiveMQ、RabbitMQ、Kafka，RocketMQ这些，根据需求场景选择不同的消息队列框架。
什么是消息队列：http://blog.csdn.net/shaobingj126/article/details/50585035
各种消息队列框架对比：http://blog.csdn.net/sunxinhere/article/details/7968886
RocketMQ原理与实践：http://www.jianshu.com/p/453c6e7ff81c
RocketMQ入门：http://www.jianshu.com/p/ba2934571c77
序列化框架protobuf protobuf是google 的一种数据交换的格式，类似json和xml，它独立于语言，独立于平台。作为一种效率和兼容性都很优秀的二进制数据传输格式，可以用于诸如网络传输、配置文件、数据存储等诸多领域。
开源地址： https://github.com/google/protobuf
开发指南：http://blog.csdn.net/menuconfig/article/details/12837173
安装教程：http://www.cnblogs.com/TerryBlog/archive/2011/04/20/2022502.html
netty中使用protobuf：https://github.com/longdafeng/netty-protobuff
框架部分暂时介绍这么多，各个框架间可灵活组合使用；之所以整理出来分享给大家，有以下几个原因： 
它们都是开源的，并且得到广泛使用和验证
它们是解决某个问题的最佳选择
足够好的灵活性、扩展性让你轻松应对需求迭代
它们都是基础框架，基础意味着重要，就好比房子的稳固程度取决于地基是否稳固
还有吗？当然有。

**三、算法类**
发布/订阅模式：http://blog.csdn.net/xuchuangfeng/article/details/50767410
一致性Hash算法：https://www.codeproject.com/articles/56138/consistent-hashing
Paxos分布式选举算法：
《Paxos Made Simple》：https://www.microsoft.com/en-us/research/wp-content/uploads/2016/12/paxos-simple-Copy.pdf
《The-Part-Time-Parliament》：https://www.microsoft.com/en-us/research/wp-content/uploads/2016/12/The-Part-Time-Parliament.pdf
HDFS架构设计：http://hadoop.apache.org/docs/r1.0.4/cn/hdfs_design.html
Google MapReduce论文中文版：http://www.open-open.com/lib/view/open1328763069203.html
Google BigTable论文中文版：http://dblab.xmu.edu.cn/post/google-bigtable/

**四、工具类**

工具类不详细罗列网址了，可以自己去搜索一下。
mvn仓库：http://mvnrepository.com/
Json库：fastjson / Gson
Collections库：Guava
Html内容匹配：Jsoup
Http Client：Apache HttpClient
JDBC Pools： Commons DBCP / Druid
模拟测试：Mockito
代码简化：lombok
图片处理：Thumbnails
Mail：JavaMail API (compat)
定时器：Quartz
权限控制：Shiro / spring Security
长连接：spring-websocket
即时通讯：Openfire
NoSQL：Jedis / spring-data-redis / spring-data-mongoDB

以上所有Java进阶资料汇总整理均由[JeremyLu][1]整理编辑。
后续ghostsf也会进一步在这里更新，同时，欢迎大家留言补充！


  [1]: http://www.cnblogs.com/nosqlcoco