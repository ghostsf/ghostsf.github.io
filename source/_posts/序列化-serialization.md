title: 序列化 serialization
categories: 旧文字
tags: [序列化]
date: 2015-10-25 02:38:58
---
> Serialization is a mechanism by which you can save the state of an
> object by converting it to a byte stream.

JAVA中实现serialization主要靠两个类:

 - ObjectOuputStream
 - ObjectInputStream

他们是JAVA IO系统里的OutputStream和InputStream的子类.


----------
**如何序列化一个对象到一个文件?**
要被序列化的实例所对应的类必须实现 Serializable 接口. 然后你可以把实例传递给 ObjectOutputStream, 同时 ObjectOutputStream 也必须连接至 fileoutputstream. 这样就会把一个对象储存到一个文件里.

**必须实现 Serializable 接口的哪个方法?**
Serializable 接口是一个空接口.所以我们不实现它的任何方法.没有任何方法和域，仅用于标识序列化的语意.

**如何控制 serialization 的过程?**
Yes it is possible to have control over serialization process. The class should implement Externalizable interface. This interface contains two methods namely readExternal and writeExternal. You should implement these methods and write the logic for customizing the serialization process.

**什么情况下要使用序列化?**
Whenever an object is to be sent over the network, objects need to be serialized. Moreover if the state of an object is to be saved, objects need to be serilazed.

**序列化时要注意什么?**
One should make sure that all the included objects are also serializable. If any of the objects is not serializable then it throws a NotSerializableException.

**序列化时 static 域的处理?**
......

**Externalizable 接口?**
.....