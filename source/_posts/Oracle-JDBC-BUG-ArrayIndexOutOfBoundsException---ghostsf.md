title: Oracle JDBC BUG ArrayIndexOutOfBoundsException - ghostsf
categories: 技术栈
tags: [oracle]
date: 2017-01-25 04:29:00
---
RT 
Caused by: java.lang.ArrayIndexOutOfBoundsException: 21
at oracle.jdbc.driver.OracleSql.computeBasicInfo(OracleSql.java:950)

oracle ojdbc6的驱动包是存在bug的。

具体看Raimonds Simanovskis的分析：

    In Oracle Metalink (Oracle's support site - Note ID 736273.1) I found that this is a bug in JDBC adapter (version 10.2.0.0.0 to 11.1.0.7.0) that when you call preparedStatement with more than 7 positional parameters then JDBC will throw this error.
    
    If you have access to Oracle Metalink then one option is to go there and download mentioned patch.
    
    The other solution is workaround - use named parameters instead of positional parameters:
    
    INSERT INTO rule_definitions(RULE_DEFINITION_SYS,rule_definition_type,
    rule_name,rule_text,rule_comment,rule_message,rule_condition,rule_active,
    rule_type,current_value,last_modified_by,last_modified_dttm,
    rule_category_sys,recheck_unit,recheck_period,trackable)
    VALUES(RULE_DEFINITIONS_SEQ.NEXTVAL,:rule_definition_type,
    :rule_name,:rule_text,:rule_comment,:rule_message,:rule_condition,:rule_active,
    :rule_type,:current_value,:last_modified_by,:last_modified_dttm,
    :rule_category_sys,:recheck_unit,:recheck_period,:trackable)
    
    and then use
    
    preparedStatement.setStringAtName("rule_definition_type", ...)
    
    etc. to set named bind variables for this query.

PreparedStatement 预设参数超过7位就会报错。替换新的jdbc驱动包即可解决问题。
目前发现ojdbc6.jar有此问题。
可去oracle官网下载最新的oracle驱动包
[http://www.oracle.com/technetwork/apps-tech/jdbc-10201-088211.html][1]


  [1]: http://www.oracle.com/technetwork/apps-tech/jdbc-10201-088211.html
