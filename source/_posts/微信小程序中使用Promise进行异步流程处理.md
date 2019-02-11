title: 微信小程序中使用Promise进行异步流程处理
categories: 技术栈
tags: [微信小程序]
date: 2016-11-10 05:05:58
---
我们知道，JavaScript是单进程执行的，同步操作会对程序的执行进行阻塞处理。比如在浏览器页面程序中，如果一段同步的代码需要执行很长时间（比如一个很大的循环操作），则页面会产生卡死的现象。

所以，在JavaScript中，提供了一些异步特性，为程序提供了性能和体验上的益处，比如可以将代码放到setTimeout()中执行；或者在网页中，我们使用Ajax的方式向服务器端做异步数据请求。这些异步的代码不会阻塞当前的界面主进程，界面还是可以灵活的进行操作，等到异步代码执行完成，再做相应的处理。

一段典型的异步代码类似这样：

    function asyncFunc(callback) {
      setTimeout(function () {
        //在这里写你的逻辑代码
        //...
    
        //逻辑代码结束，执行一个回调函数
        callback();
      }, 5000);
    }

或者：

    function getAccountInfo(callback, errorCallback) {
      wx.request({
        url: '/accounts/12345',
        success: function (res) {
          //...
          callback(data);
        },
        fail: function (res) {
          //...
          errorCallback(data);
        }
      });
    }

然后我们这样调用：

    asyncFunc(function () {
      console.log("asyncFunc() run complete");
    });
    
    getAccountInfo(function (data) {
      console.log("get account info successfully:", data);
    }, function () {
      console.error("get account info failed");
    });

这是一种使用了回调函数来控制代码执行流程的方式。这样看起来没问题，也挺容易理解。

但是，如果我们一段代码中，异步操作太多，又要保证这些异步操作是有顺序的执行，那我们的代码就看起来非常糟糕，就像这样：

    asyncFunc1(function(){
      //...
      asyncFunc2(function(){
        //...
        asyncFunc3(function(){
          //...
          asyncFunc4(function(){
            //...
            asyncFunc5(function(){
               //...
            });
          });
        });
      });
    });

这样的代码可读性和可维护性可想而知了。还有，回调函数真正的问题在于：

它剥夺了我们使用 return 和 throw 这些关键字的能力。
那有什么办法来改善这个问题呢？答案是肯定的，Promise这种概念的产生，很好地解决了这一切。关于什么是Promise，一搜一大把介绍，我这里就不复制粘贴了，我主要是讲一下我们怎么用它来解决我们的问题。

我们来看一下，上面的例子如果使用Promise，它会是什么样子?我们先将这些函数变成Promise的方式：

    function asyncFunc1(){
      return new Promise(function (resolve, reject) {
        //...
      })
    }

// asyncFunc2,3,4,5也实现成跟asyncFunc1一样的方式...
然后看一下他们是怎么样被调用的：

    asyncFunc1()
      .then(asyncFunc2)
      .then(asyncFunc3)
      .then(asyncFunc4)
      .then(asyncFunc5);

这样，这些异步函数就会按照顺序一个一个依次执行了。

ES6中原生支持了Promise，不过在原生不支持Promise的环境中，我们有很多第三方库来支持，比如Q.js和Bluebird。它们一般都除了提供标准Promise的API外，还提供了一些标准之外但非常有用的API，使得异步流程的控制更加优雅。

从微信小程序的API文档中我们可以看到，框架提供的JavaScript API中很多函数其实都是异步的，如wx.setStorage(), wx.getStorage(), wx.getLocation()等等，它们也是提供的回调的处理方式，在参数中传入success, fail，complete回调函数，就可以对运行成功或失败进行分别处理。

如：

    wx.getLocation({ 
      type: 'wgs84', 
      success: function(res) { 
        var latitude = res.latitude 
        var longitude = res.longitude 
        var speed = res.speed 
        var accuracy = res.accuracy 
      },
      fail: function() {
        console.error("get location failed")
      }
    })

我们能不能让微信小程序的异步API支持Promise呢？答案是肯定的，我们当然可以一个一个的用Promise去包装这些API，但是这个还是比较麻烦的。不过，由于小程序的API的参数格式都比较统一，只接受一个object参数，回调都是在这个参数中设置，所以，这为我们的统一处理提供了便利，我们可以写一个非侵入性的工具方法，来完成这样的工作：

假设我们将这个工具方法写到一个名为的util.js的文件中：

    var Promise = require('../libs/bluebird.min')  //我用了bluebird.js
    
    function wxPromisify(fn) {  
      return function (obj = {}) {    
        return new Promise((resolve, reject) => {      
          obj.success = function (res) {        
            resolve(res)      
          }      
    
          obj.fail = function (res) {        
            reject(res)      
          }      
    
          fn(obj)    
        })  
      }
    }
    
    module.exports = {  
      wxPromisify: wxPromisify
    }

之后，我们来看一下如何使用这个方法，将原来回调方式的API变成Promise的方式：

    var util = require('../utils/util')
    
    var getLocationPromisified = util.wxPromisify(wx.getLocation)
    
    getLocationPromisified({
      type: 'wgs84'
    }).then(function (res) {
      var latitude = res.latitude 
      var longitude = res.longitude 
      var speed = res.speed 
      var accuracy = res.accuracy 
    }).catch(function () {
      console.error("get location failed")
    })

以上：

> 文／一斤代码（简书作者） 原文链接：http://www.jianshu.com/p/e92c7495da76
> 著作权归作者所有，转载请联系作者获得授权，并标注“简书作者”。
