title: java.lang.reflect.InvocationTargetException - ghostsf博客
categories: 技术栈
tags: []
date: 2016-07-20 05:06:00
---
> What could cause java.lang.reflect.InvocationTargetException and how to solve it?

You've added an extra level of abstraction by calling the method with reflection. The reflection layer wraps any exception in an InvocationTargetException, which lets you tell the difference between an exception actually caused by a failure in the reflection call (maybe your argument list wasn't valid, for example) and a failure within the method called.

Just unwrap the cause within the InvocationTargetException and you'll get to the original one.
