title: GPS定位地图API都做了加密处理
categories: 
tags: []
date: 2016-02-02 16:17:00
---
> 坐标体系是否遵循国家对地理信息保密要求？
> 腾讯地图API对外接口的坐标系，都是经过国家测绘局加密处理，符合国家测绘局对地理信息保密要求。

原来是有这么个情况。
搜索整理得知，坐标系有这么几种情况：

 - WGS84坐标系：即地球坐标系，国际上通用的坐标系。
 - GCJ02坐标系：即火星坐标系，WGS84坐标系经加密后的坐标系。
 - BD09坐标系：即百度坐标系，GCJ02坐标系经加密后的坐标系。
 - 搜狗坐标系、图吧坐标系等，估计也是在GCJ02基础上加密而成的。

腾讯地图API使用的是火星坐标。那么其他的呢？
这里整理下：
百度地图API -> 百度坐标
腾讯搜搜地图API -> 火星坐标
搜狐搜狗地图API -> 搜狗坐标
阿里云地图API -> 火星坐标
图吧MapBar地图API -> 图吧坐标
高德MapABC地图API -> 火星坐标
灵图51ditu地图API -> 火星坐标

所以，做地图开发的朋友需要注意下咯。至于用哪个就不做评价了。只想简单做个提醒。

当然坐标系之间的加解密算法也是有的，这里简单贴一下：
**地球坐标系 (WGS-84) 到火星坐标系 (GCJ-02) 的转换算法**
WGS-84 到 GCJ-02 的转换（即 GPS 加偏）算法

    using System;  
      
    namespace Navi  
    {  
        class EvilTransform  
        {  
            const double pi = 3.14159265358979324;  
      
            //   
            // Krasovsky 1940   
            //   
            // a = 6378245.0, 1/f = 298.3   
            // b = a * (1 - f)   
            // ee = (a^2 - b^2) / a^2;   
            const double a = 6378245.0;  
            const double ee = 0.00669342162296594323;  
      
            //   
            // World Geodetic System ==> Mars Geodetic System   
            public static void transform(double wgLat, double wgLon, out double mgLat, out double mgLon)  
            {  
                if (outOfChina(wgLat, wgLon))  
                {  
                    mgLat = wgLat;  
                    mgLon = wgLon;  
                    return;  
                }  
                double dLat = transformLat(wgLon - 105.0, wgLat - 35.0);  
                double dLon = transformLon(wgLon - 105.0, wgLat - 35.0);  
                double radLat = wgLat / 180.0 * pi;  
                double magic = Math.Sin(radLat);  
                magic = 1 - ee * magic * magic;  
                double sqrtMagic = Math.Sqrt(magic);  
                dLat = (dLat * 180.0) / ((a * (1 - ee)) / (magic * sqrtMagic) * pi);  
                dLon = (dLon * 180.0) / (a / sqrtMagic * Math.Cos(radLat) * pi);  
                mgLat = wgLat + dLat;  
                mgLon = wgLon + dLon;  
            }  
      
            static bool outOfChina(double lat, double lon)  
            {  
                if (lon < 72.004 || lon > 137.8347)  
                    return true;  
                if (lat < 0.8293 || lat > 55.8271)  
                    return true;  
                return false;  
            }  
      
            static double transformLat(double x, double y)  
            {  
                double ret = -100.0 + 2.0 * x + 3.0 * y + 0.2 * y * y + 0.1 * x * y + 0.2 * Math.Sqrt(Math.Abs(x));  
                ret += (20.0 * Math.Sin(6.0 * x * pi) + 20.0 * Math.Sin(2.0 * x * pi)) * 2.0 / 3.0;  
                ret += (20.0 * Math.Sin(y * pi) + 40.0 * Math.Sin(y / 3.0 * pi)) * 2.0 / 3.0;  
                ret += (160.0 * Math.Sin(y / 12.0 * pi) + 320 * Math.Sin(y * pi / 30.0)) * 2.0 / 3.0;  
                return ret;  
            }  
      
            static double transformLon(double x, double y)  
            {  
                double ret = 300.0 + x + 2.0 * y + 0.1 * x * x + 0.1 * x * y + 0.1 * Math.Sqrt(Math.Abs(x));  
                ret += (20.0 * Math.Sin(6.0 * x * pi) + 20.0 * Math.Sin(2.0 * x * pi)) * 2.0 / 3.0;  
                ret += (20.0 * Math.Sin(x * pi) + 40.0 * Math.Sin(x / 3.0 * pi)) * 2.0 / 3.0;  
                ret += (150.0 * Math.Sin(x / 12.0 * pi) + 300.0 * Math.Sin(x / 30.0 * pi)) * 2.0 / 3.0;  
                return ret;  
            }  
        }  
    }  

当然目前的一些地图API里已经提供了响应转化加密好的接口了，但是还是有必要注意下这个问题吧，仅作提醒或者涨个常识吧。
