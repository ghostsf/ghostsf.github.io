title: KVM、XEN、OpenVZ VPS优缺点对比
categories: 技术栈
tags: []
date: 2017-06-14 13:36:00
---
KVM和xen是真正的虚拟化，每个客户独立于主机。OpenVZ是依赖于主机节点内核的容器虚拟化,接下来我们分别看一下这三种架构的优缺点。

**KVM VPS**
全 称 Kernel-based Virtual Machine
**优 点**   灵活性好、全虚拟技术、可配置任何操作系统
**缺 点**  会消耗较多的计算器资源

KVM主机推荐：
DigitalOcean VPS：https://digitalocean.com/
Vutlr VPS：http://www.vultr.com/

> KVM是全虚拟技术，您可以运行几乎任何操作系统作为客户BSD /
> Windows/**[Linux](/vps/)**。有趣的是，由于kvm可以容纳任何类型的操作系统，很多人甚至在RAM
> 128m内存的服务器配备win2003，这样非常损耗主机性能，所以在可以的情况下您可能的分配大内存的RAM。

**XEN VPS**
XEN采 用ICA协议
**优 点**  内存独占、基本上不存在超售
**缺 点**  性价比没有OpenVZ高

主机推荐：DigitalOcean：https://digitalocean.com/

> Xen是一种半虚拟化技术，它不是一个真正的VPS虚拟机，而是相当于自己运行一个内核实例，可以自由加载内核模块，虚拟内存和IO，稳定可预测。Xen具有两种方法，可以同时运行在同一物理主机上，Xen
> PV（半虚拟化）和HVM（全硬件虚拟化）。
> 
> Xen技术已经非常成熟了，大多数人选择Xen以表现出色，性能非常稳定。
> Xen主机会将Ram和CPU内核预先分配给xen虚拟机管理程序，因此它有自己的专用资源，专用内存，安全性好，同一服务器上的其它虚拟机出现问题也不会受到影响。

**OpenVZ VPS**
VPS架构OpenVZ(基于Linux平台)
提 供SWsoft公司
**优 点**  性价比高，性能强，商家选择多！
**缺 点**  如果碰到超售的商家，由于是共享资源、自己的VPS主机资源常常会被其他用户占用！
 
主机推荐
BandwagonHost/搬瓦工VPS：https://bandwagonhost.com/
gigsgigscloud VPS：https://clientarea.gigsgigscloud.com/
 

> OpenVZ仅支持Linux（除非使用支持Windows的商业平行）
> 
> OpenVZ是操作系统级虚拟化技术。通常意味着更好的性能，由于其快速部署和非常高的密度，在主机行业受到广泛的欢迎，它的主机内核、ram内存、cpu和硬盘都是一起与客户共享的，所以常常会出现黑心商家超售的情况，在不超售的情况下与KVM和Xen相比，OpenVZ绝对算得上优秀。


**总结**
如果对主机要求不是很高OpenVZ绝对是个很好的选择。
追求稳定性和较高的安全隐私性，选择xen和KVM！


