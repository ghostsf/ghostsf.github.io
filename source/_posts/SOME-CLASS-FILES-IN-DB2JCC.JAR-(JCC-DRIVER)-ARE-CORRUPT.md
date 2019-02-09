title: SOME CLASS FILES IN DB2JCC.JAR (JCC DRIVER) ARE CORRUPT
categories: 
tags: []
date: 2016-05-11 03:12:07
---
**SOME CLASS FILES IN DB2JCC.JAR (JCC DRIVER) ARE CORRUPT**

APAR status

    Closed as program error.

Error description

    USERS AFFECTED: Users of the JCC driver with DB2 LUW 9 and DB2
    LUW 9.5

    PROBLEM DESCRIPTION:
    Some class files in db2jcc.jar are corrupt.

    The class files which are corrupt are:
     COM/ibm/db2os390/sqlj/custom/DB2SQLJCustomizer.class
     COM/ibm/db2os390/sqlj/custom/DB2SQLJEntryInfo.class
     COM/ibm/db2os390/sqlj/custom/DB2SQLJProfile.class

    These class files are used for the sqljupgrade utility for DB2
    on z/OS.


    These corrupt classes have caused the following problems:

    - When db2jcc.jar was included as a library in a Java project in
      Eclipse 3.3, then a search was started, it raised an exception
     org.eclipse.jdt.internal.compiler.classfmt.ClassFormatException

    - When db2jcc.jar was deployed in the JBoss J2EE Application
      Server, a message like this appeared in the JBoss log:
       Could not initialise deployment:
       file:[...]db2jcc.jar
       org.jboss.deployment.DeploymentException: exception in init
       of
       file:[...]db2jcc.jar; - nested throwable:
       (java.lang.RuntimeException:
       java.io.IOException: bad magic number: cba78dd8)
       [...]


    You can check for this defect by seeing whether any of the class
    files in db2jcc.jar do not begin with the "magic number"
    0xcafebabe.
    (The "magic number" 0xcafebabe should be at the start of all
    Java class files.)

    Here is one way to do that:
    - Copy db2jcc.jar to a new directory.
    - Change to the new directory.
    - Extract the class files by running
       jar xvf db2jcc.jar
    - Run the following ksh script:

    #!/bin/ksh
    for f in `find . -name "*.class" -print`
    do
      od -x $f | head -1 | read offset cafe babe dummy
      if [[ $cafe != "cafe" || $babe != "babe" ]]
      then
        echo $f
        od -x $f | head -1
      fi
    done

    The above script outputs the names of
    all the class files which do not begin with the correct
    "magic number".
    If this defect is found, it outputs the following:

    ./COM/ibm/db2os390/sqlj/custom/DB2SQLJCustomizer.class
    0000000  cba7 8dd8 0003 0005 0007 1a00 1a00 1f1a
    ./COM/ibm/db2os390/sqlj/custom/DB2SQLJEntryInfo.class
    0000000  cba7 8dd8 0003 0005 021a 1a00 6c1a 006f
    ./COM/ibm/db2os390/sqlj/custom/DB2SQLJProfile.class
    0000000  cba7 8dd8 0003 0005 00d7 1a00 0800 8b1a

Local fix

    You may avoid problems by removing the corrupt classes from
    db2jcc.jar

Problem summary

    ****************************************************************
    * USERS AFFECTED:                                              *
    * Users of IBM Data Server Driver for JDBC                     *
    ****************************************************************
    * PROBLEM DESCRIPTION:                                         *
    * See error description.                                       *
    ****************************************************************
    * RECOMMENDATION:                                              *
    * Upgrade to DB2 LUW 9.1 fixpak 5 or above                     *
    ****************************************************************


From [IBM][1]


  [1]: http://www.ibm.com