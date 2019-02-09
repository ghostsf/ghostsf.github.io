title: 入手DigitalOcean云主机
categories: 旧文字
tags: [digitalocean vps]
date: 2015-09-17 14:20:31
---
> digitalocean是一家成立于2012年的总部设置在纽约的云主机商家，采用KVM虚拟，配置高性能的SSD做储存，加上服务器配备的是1000M端口，以512M内存为起点，月付最低低至5美元！

**digitalocean封杀账号**

有许多中国站长和开发者反映说，digitalocean随意无故封杀用户的账号，非常地野蛮。这类帖子经常可在V2EX论坛看到，导致大家对digitalocean有了一些负面印象。

准确地说，是大家抱怨digitalocean野蛮删除中国用户的账号。现象是，突然有一天，这些发帖的人发现自己的vps被digitalocean暂停了，跟客服沟通，DO的客服不会做过多解释，只会说你违反了TOS（用户服务协议），但不会明确说哪个行为违反了协议。然后矛盾激化，digitalocean屏蔽了你的IP，竟然限制你登录后台！
事实是，这些人很有可能确实是违反了条款，自己不知道或装糊涂。一些常见的违反条款的行为是：

一个人注册多个账户，以此获得推广收入。判断同一个人注册多个账户，对digitalocean来说太简单了。用户有传播BT盗版的行为，中国用户常会挂着VPS做BT种子站，这种行为严重违反美国版权保护法，版权方会写投诉信给digitalocean，要求用户处理。VPS遭受DDos攻击，或对外发起DDos攻击。这个比较委屈，你只能尽可能做好自身防护工作。

如果中国站长能避免上述行为，一般账号是不会无故被封掉的。

**digitalocean速度稳定性**

机房稳定性远胜于linode，这跟DO作为一个年轻的服务商有关，毕竟要积累运维经验。经过不断的线路优化，digitalocean美国西海岸机房速度非常优秀。同时，由于中国用户大量涌入，Linode机房的速度和稳定性不如从前了，日本机房更是经常丢包抽风。2014年1月16日，digitalocean完成了SanFrancisco机房的硬件升级，值得大陆站长购买，但是不要买新加坡机房，速度不如SanFrancisco机房VPS快。
digitalocean与linode的差距越来越小。

**digitalocean固态硬盘**

2013年12月，digitalocean的API默认不安全删除用户数据，被国外开发者在Github揭短。digitalocean勇于承认错误，修补了漏洞。虽然SSD固态硬盘读写速度惊人，但毕竟跟传统机械硬盘相比，数据处理有待完美。你不仅要看SSD固态硬盘读写快的优点，还要知道固态硬盘比传统机械硬盘更难彻底删除数据的缺点。但我觉得，一般站长丝毫不用担心，删除VPS时候，点击安全擦除就OK了。SSD速度仍然值得我们考虑，数据隐私的重要性不是所有用户的第一选择。SSD是VPS配置主流趋势，越来越多VPS厂商开始淘汰传统硬盘，提供SSD存储。

口碑是靠时间积累的，Linode是老牌王者，但价格贵。digitalocean是明星选手，值得购买。日本Vultr VPS价格便宜，也值得推荐。为了保护那些非常重要的敏感数据，一定要经常给你的vps做备份。

转载自 [Mr.王掌柜][1]


  [1]: http://since1989.org/digitalocean/ssh-vps-price-linode-speed.html