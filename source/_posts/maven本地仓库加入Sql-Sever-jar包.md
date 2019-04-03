title: maven本地仓库加入Sql Sever jar包
categories: 技术栈
tags: [maven]
date: 2016-03-03 07:34:00
---
When I add sqlserver04.jar into my maven project, it's a little bit different others. For other jars, I directly add dependency into pom.xml. For sqlserver.jar, the dependency works on others' projects, but not mine. It always give me an error about missing artifact. Here is my solution:
1) download latest jar [Microsoft download center][1]. I download *.exe file.
2) Run the exe file and unzip it.
3) Open a command prompt and switch into the directory whre the jar file is located
4) Execute the comand

    mvn install:install-file -Dfile=sqljdbc4.jar -Dpackaging=jar -DgroupId=com.microsoft.sqlserver -DartifactId=sqljdbc4 -Dversion=4.0  

5) When you see Build Success, You can find the jar in your maven repository. Mine is located here:
C:\Users\****\.m2\repository\com\microsoft\sqlserver\sqljdbc4\4.0
6) Now you're ready to add the dependency to pom.xml

    < dependency>  
                < groupId>com.microsoft.sqlserver</groupId>  
                < artifactId>sqljdbc4</artifactId>  
                < version>4.0</version>  
    </ dependency> 

  [1]: http://www.microsoft.com/en-us/download/details.aspx?displaylang=en&id=11774
