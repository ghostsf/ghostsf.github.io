title: Java任务调度框架Quartz实例
categories: 旧文字
tags: [quartz]
date: 2016-04-14 01:55:00
---
> 介绍  
Quartz is a full-featured, open source job scheduling service that
> can be integrated with, or used along side virtually any Java
> application - from the smallest stand-alone application to the largest
> e-commerce system. Quartz can be used to create simple or complex
> schedules for executing tens, hundreds, or even tens-of-thousands of
> jobs;  
> Quartz框架是一个全功能、开源的任务调度服务，可以集成几乎任何的java应用程序—从小的单片机系统到大型的电子商务系统。Quartz可以执行上千上万的任务调度。

 **核心概念**
 Quartz核心的概念：scheduler任务调度、Job任务、Trigger触发器、JobDetail任务细节
 
 Job任务：其实Job是接口，其中只有一个execute方法：

     package org.quartz;
    public abstract interface Job
    {
      public abstract void execute(JobExecutionContext paramJobExecutionContext)
        throws JobExecutionException;
    }

 我们开发者只要实现此接口，实现execute方法即可。把我们想做的事情，在execute中执行即可。
 JobDetail：任务细节，Quartz执行Job时，需要新建个Job实例，但是不能直接操作Job类，所以通过JobDetail来获取Job的名称、描述信息。
 Trigger触发器：执行任务的规则；比如每天，每小时等。
 一般情况使用SimpleTrigger，和CronTrigger，这个触发器实现了Trigger接口。
 对于复杂的时间表达式来说，比如每个月15日上午几点几分，使用CronTrigger
 对于简单的时间来说，比如每天执行几次，使用SimpleTrigger
 scheduler任务调度：是最核心的概念，需要把JobDetail和Trigger注册到scheduler中，才可以执行。

 **具体执行步骤：**
 下载相应的jar包：http://www.quartz-scheduler.org/
 注意：
 不同的版本的jar包，具体的操作不太相同，但是思路是相同的；比如1.8.6jar包中，JobDetail是个类，直接通过构造方法与Job类关联。SimpleTrigger和CornTrigger是类；在2.0.2jar包中，JobDetail是个接口，SimpleTrigger和CornTrigger是接口
 不同版本测试：


<!--more-->


 1.8.6jar包：  
[html] view plain copy print?

    package com.test;  
      
    import java.util.Date;  
      
    import org.quartz.Job;  
    import org.quartz.JobExecutionContext;  
    import org.quartz.JobExecutionException;  
    /**  
     * 需要执行的任务  
     * @author lhy  
     *  
     */  
    public class MyJob implements Job {  
      
        @Override  
        //把要执行的操作，写在execute方法中  
        public void execute(JobExecutionContext arg0) throws JobExecutionException {  
            System.out.println("测试Quartz"+new Date());  
        }  
    }  
     使用SimpleTrigger触发器
    [html] view plain copy print?
    package com.test;  
      
    import java.util.Date;  
      
    import org.quartz.JobDetail;  
    import org.quartz.Scheduler;  
    import org.quartz.SchedulerException;  
    import org.quartz.SchedulerFactory;  
    import org.quartz.SimpleTrigger;  
    import org.quartz.impl.StdSchedulerFactory;  
      
    /**  
     * 调用任务的类  
     * @author lhy  
     *  
     */  
    public class SchedulerTest {  
       public static void main(String[] args) {  
         
         //通过schedulerFactory获取一个调度器  
           SchedulerFactory schedulerfactory=new StdSchedulerFactory();  
           Scheduler scheduler=null;  
           try{  
    //      通过schedulerFactory获取一个调度器  
               scheduler=schedulerfactory.getScheduler();  
                 
    //       创建jobDetail实例，绑定Job实现类  
    //       指明job的名称，所在组的名称，以及绑定job类  
               JobDetail jobDetail=new JobDetail("job1", "jgroup1", MyJob.class);  
                 
    //       定义调度触发规则，比如每1秒运行一次，共运行8次  
               SimpleTrigger simpleTrigger=new SimpleTrigger("simpleTrigger","triggerGroup");  
    //       马上启动  
               simpleTrigger.setStartTime(new Date());  
    //       间隔时间  
               simpleTrigger.setRepeatInterval(1000);  
    //       运行次数  
               simpleTrigger.setRepeatCount(8);  
                 
    //       把作业和触发器注册到任务调度中  
               scheduler.scheduleJob(jobDetail, simpleTrigger);  
                 
    //       启动调度  
               scheduler.start();  
                 
                 
           }catch(SchedulerException e){  
               e.printStackTrace();  
           }  
             
    }  
    }  
     若使用CornTrigger触发器： 
    [html] view plain copy print?
    package com.test;  
      
    import java.util.Date;  
      
    import org.quartz.CronTrigger;  
    import org.quartz.JobDetail;  
    import org.quartz.Scheduler;  
    import org.quartz.SchedulerException;  
    import org.quartz.SchedulerFactory;  
    import org.quartz.SimpleTrigger;  
    import org.quartz.impl.StdSchedulerFactory;  
      
    /**  
     * 调用任务的类  
     * @author lhy  
     *  
     */  
    public class CronTriggerTest {  
       public static void main(String[] args) {  
         
         //通过schedulerFactory获取一个调度器  
           SchedulerFactory schedulerfactory=new StdSchedulerFactory();  
           Scheduler scheduler=null;  
           try{  
    //      通过schedulerFactory获取一个调度器  
               scheduler=schedulerfactory.getScheduler();  
                 
    //       创建jobDetail实例，绑定Job实现类  
    //       指明job的名称，所在组的名称，以及绑定job类  
               JobDetail jobDetail=new JobDetail("job1", "jgroup1", MyJob.class);  
                 
    //       定义调度触发规则，每天上午10：15执行  
               CronTrigger cornTrigger=new CronTrigger("cronTrigger","triggerGroup");  
    //       执行规则表达式  
               cornTrigger.setCronExpression("0 15 10 * * ? *");  
    //       把作业和触发器注册到任务调度中  
               scheduler.scheduleJob(jobDetail, cornTrigger);  
                 
    //       启动调度  
               scheduler.start();  
                 
                 
           }catch(Exception e){  
               e.printStackTrace();  
           }  
             
    }  
    }  

  对于2.0.2jar包如下：
  其中的job类不变，主要是调度类如下：
[html] view plain copy print?

    package com.test;  
      
    import java.util.Date;  
      
    import org.quartz.CronScheduleBuilder;  
    import org.quartz.JobBuilder;  
    import org.quartz.JobDetail;  
    import org.quartz.Scheduler;  
    import org.quartz.SchedulerException;  
    import org.quartz.SchedulerFactory;  
    import org.quartz.SimpleScheduleBuilder;  
    import org.quartz.Trigger;  
    import org.quartz.TriggerBuilder;  
    import org.quartz.impl.StdSchedulerFactory;  
      
    /**  
     * 调用任务的类  
     * @author lhy  
     *  
     */  
    public class SchedulerTest {  
       public static void main(String[] args) {  
         
         //通过schedulerFactory获取一个调度器  
           SchedulerFactory schedulerfactory=new StdSchedulerFactory();  
           Scheduler scheduler=null;  
           try{  
    //      通过schedulerFactory获取一个调度器  
               scheduler=schedulerfactory.getScheduler();  
                 
    //       创建jobDetail实例，绑定Job实现类  
    //       指明job的名称，所在组的名称，以及绑定job类  
               JobDetail job=JobBuilder.newJob(MyJob.class).withIdentity("job1", "jgroup1").build();  
               
                 
    //       定义调度触发规则  
                 
    //      使用simpleTrigger规则  
    //        Trigger trigger=TriggerBuilder.newTrigger().withIdentity("simpleTrigger", "triggerGroup")  
    //                        .withSchedule(SimpleScheduleBuilder.repeatSecondlyForever(1).withRepeatCount(8))  
    //                        .startNow().build();  
    //      使用cornTrigger规则  每天10点42分  
                  Trigger trigger=TriggerBuilder.newTrigger().withIdentity("simpleTrigger", "triggerGroup")  
                  .withSchedule(CronScheduleBuilder.cronSchedule("0 42 10 * * ? *"))  
                  .startNow().build();   
                 
    //       把作业和触发器注册到任务调度中  
               scheduler.scheduleJob(job, trigger);  
                 
    //       启动调度  
               scheduler.start();  
                 
                 
           }catch(Exception e){  
               e.printStackTrace();  
           }  
             
    }  
    }  


**对于CornExpress讲解如下：** 
**字段   允许值   允许的特殊字符**    
秒    0-59    , - * /    
分    0-59    , - * /    
小时    0-23    , - * /    
日期    1-31    , - * ? / L W C    
月份    1-12 或者 JAN-DEC    , - * /    
星期    1-7 或者 SUN-SAT    , - * ? / L C #    
年（可选）    留空, 1970-2099    , - * /    
  
**表达式   意义**    
"0 0 12 * * ?"    每天中午12点触发    
"0 15 10 ? * *"    每天上午10:15触发    
"0 15 10 * * ?"    每天上午10:15触发    
"0 15 10 * * ? *"    每天上午10:15触发    
"0 15 10 * * ? 2005"    2005年的每天上午10:15触发    
"0 * 14 * * ?"    在每天下午2点到下午2:59期间的每1分钟触发    
"0 0/5 14 * * ?"    在每天下午2点到下午2:55期间的每5分钟触发     
"0 0/5 14,18 * * ?"    在每天下午2点到2:55期间和下午6点到6:55期间的每5分钟触发     
"0 0-5 14 * * ?"    在每天下午2点到下午2:05期间的每1分钟触发    
"0 10,44 14 ? 3 WED"    每年三月的星期三的下午2:10和2:44触发    
"0 15 10 ? * MON-FRI"    周一至周五的上午10:15触发    
"0 15 10 15 * ?"    每月15日上午10:15触发    
"0 15 10 L * ?"    每月最后一日的上午10:15触发    
"0 15 10 ? * 6L"    每月的最后一个星期五上午10:15触发      
"0 15 10 ? * 6L 2002-2005"    2002年至2005年的每月的最后一个星期五上午10:15触发    
"0 15 10 ? * 6#3"    每月的第三个星期五上午10:15触发     
  
**特殊字符   意义**    
*****    表示所有值；    
**?**    表示未说明的值，即不关心它为何值；    
**-**    表示一个指定的范围；    
**,**    表示附加一个可能值；    
**/**    符号前表示开始时间，符号后表示每次递增的值；    
**L("last")**    ("last") "L" 用在day-of-month字段意思是 "这个月最后一天"；用在 day-of-week字段, 它简单意思是 "7" or "SAT"。 如果在day-of-week字段里和数字联合使用，它的意思就是 "这个月的最后一个星期几" – 例如： "6L" means "这个月的最后一个星期五". 当我们用“L”时，不指明一个列表值或者范围是很重要的，不然的话，我们会得到一些意想不到的结果。    
**W("weekday")**    只能用在day-of-month字段。用来描叙最接近指定天的工作日（周一到周五）。例如：在day-of-month字段用“15W”指“最接近这个月第15天的工作日”，即如果这个月第15天是周六，那么触发器将会在这个月第14天即周五触发；如果这个月第15天是周日，那么触发器将会在这个月第16天即周一触发；如果这个月第15天是周二，那么就在触发器这天触发。注意一点：这个用法只会在当前月计算值，不会越过当前月。“W”字符仅能在day-of-month指明一天，不能是一个范围或列表。也可以用“LW”来指定这个月的最后一个工作/日。     
**#**    只能用在day-of-week字段。用来指定这个月的第几个周几。例：在day-of-week字段用"6#3"指这个月第3个周五（6指周五，3指第3个）。如果指定的日期不存在，触发器就不会触发。     
**C**    指和calendar联系后计算过的值。例：在day-of-month 字段用“5C”指在这个月第5天或之后包括calendar的第一天；在day-of-week字段用“1C”指在这周日或之后包括calendar的第一天  


转载自[http://blog.csdn.net/yuebinghaoyuan/article/details/9045471][1]


  [1]: http://blog.csdn.net/yuebinghaoyuan/article/details/9045471