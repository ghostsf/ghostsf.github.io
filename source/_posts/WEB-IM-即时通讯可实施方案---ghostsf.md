title: WEB IM 即时通讯可实施方案 - ghostsf
categories: 旧文字
tags: [IM]
date: 2017-02-28 10:15:00
---
这里ghostsf推荐采用”[百川云旺·即时通讯](http://baichuan.taobao.com/product/im.htm?spm=a3c0d.8121653.1998907816.4.AsevqT)“，因为FREE, And:

**特点：**
-  基于阿里巴巴旺旺团队
-  12年技术积累 日均5亿次消息量
-  免费0成本接入，轻松拥有沟通能力
-  稳定经历多次双十一考验，消息到达率100%，全年可用性99.99%
-  安全登录异常提醒、钓鱼网站监测、反垃圾/欺诈检测，支持定制化安全方案
-  全面支持Windows、Android、iOS、H5，快捷集成所有平台

**功能**
-  支持点对点单聊，支持群聊，群成员数量上限可达万级
-  支持文字、语音、表情图片等多种消息类型，并具有高度的可扩展力
-  支持PC、移动多端聊天消息漫游，设备随意转换。支持离线消息推送，重要信息不错过。
-  支持自定义背景、表情、气泡、菜单，UI可与APP整体风格协调一致

**WEB接入方案：**
**接入流程：**
**1.用户体系导入**
- API方式：
[openimAPI](https://open.taobao.com/docs/api_list.htm?spm=a219a.7629065.0.0.sH5HpD&cid=20654)
- SDK方式（建议使用）：
[服务端SDK获取](http://baichuan.taobao.com/doc2/detail.htm?articleId=102556&docType=1&treeId=28)


**2.WEB端接入与实现**
**2.1接入**
 [WKIT](http://im.taobao.com/wkit_doc/?spm=a3c0d.7629140.0.0.wDvLTB)
 [WSDK](http://im.taobao.com/wsdk_doc/index.html)

**2.2实现DEMO**
 **单聊DEMO：**
 ghostsf账号登录：
 http://www.ghostsf.com/chat/index.html?uid=ghostsf&pwd=ghostsf_password&to=n001
 n001账号登录：
 http://www.ghostsf.com/chat/index.html?uid=n001&pwd=n001&to=ghostsf
 这里就实现了ghostsf和n001之间的单聊

**3.服务端管理维护：**
- IM账号管理
开发者需要将自己的账号体系做一定的处理，再导入IM服务端。这些账号在IM这里用来做唯一标识符。因此可以不传真实的账号。
- 服务端向IM用户发消息
在服务端，支持给IM用户发送消息。
- 聊天记录导出
可以导出在IM里面所有的聊天记录数据。
- 群的管理
可以在服务端，进行群相关的操作。包括群的增/减、群成员管理、群信息管理。 

**其他：**
API测试工具：
[apitools](http://open.taobao.com/apitools/apiTools.htm)
