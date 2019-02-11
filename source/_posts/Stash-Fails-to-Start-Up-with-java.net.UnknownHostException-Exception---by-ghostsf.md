title: Stash Fails to Start Up with java.net.UnknownHostException Exception - by ghostsf
categories: 技术栈
tags: []
date: 2016-07-27 01:26:16
---
    java.net.UnknownHostException: xwx.archermind.com: xwx.archermind.com: Name or service not known
    ......
    Caused by: java.net.UnknownHostException: xwx.archermind.com: Name or service not known

**Cause**

    Stash is unable to identify the host name being used to access the application.

**Resolution**
1. Add the host name to your hosts file. Usually adding the <hostname> exposed on the log above to the /etc/hosts of Stash server, associating it to 127.0.0.1 followed by a Stash restart will solve the problem. The entry in /etc/hosts should resemble the following:

    1
    127.0.0.1    hostname

2. If using a DNS server ensure that the service resolves the queries for the hostname into the correct IP address.

3. Maybe the name of your System is wrong.
