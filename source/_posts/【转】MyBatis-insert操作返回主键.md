title: 【转】MyBatis insert操作返回主键
categories: 技术栈
tags: [mybatis]
date: 2016-01-17 07:49:33
---
> 在使用MyBatis做持久层时，insert语句默认是不返回记录的主键值，而是返回插入的记录条数；如果业务层需要得到记录的主键时，可以通过配置的方式来完成这个功能


针对Sequence主键而言，在执行insert sql前必须指定一个主键值给要插入的记录，如Oracle、DB2，可以采用如下配置方式：

    <insert id="add" parameterType="vo.Category">
    <selectKey resultType="java.lang.Short" order="BEFORE" keyProperty="id">
    SELECT SEQ_TEST.NEXTVAL FROM DUAL
    </selectKey>
    insert into category (name_zh, parent_id,
    
    show_order, delete_status, description
    )
    values (#{nameZh,jdbcType=VARCHAR},
    #{parentId,jdbcType=SMALLINT},
    #{showOrder,jdbcType=SMALLINT},
    #{deleteStatus,jdbcType=BIT},
    #{description,jdbcType=VARCHAR}
    )
    </insert>


针对自增主键的表，在插入时不需要主键，而是在插入过程自动获取一个自增的主键，比如MySQL，可以采用如下两种配置方式：

    <insert id="add" parameterType="vo.Category" useGeneratedKeys="true" keyProperty="id">
    
    insert into category (name_zh, parent_id,
    
    show_order, delete_status, description
    
    )
    
    values (#{nameZh,jdbcType=VARCHAR},
    
    #{parentId,jdbcType=SMALLINT},
    
    #{showOrder,jdbcType=SMALLINT},
    
    #{deleteStatus,jdbcType=BIT},
    
    #{description,jdbcType=VARCHAR}
    
    )
    </insert>

或

    <insert id="add" parameterType="vo.Category">
    <selectKey resultType="java.lang.Short" order="AFTER" keyProperty="id">
    SELECT LAST_INSERT_ID() AS id
    </selectKey>
    insert into category (name_zh, parent_id,
    show_order, delete_status, description
    )
    values (#{nameZh,jdbcType=VARCHAR},
    #{parentId,jdbcType=SMALLINT},
    #{showOrder,jdbcType=SMALLINT},
    #{deleteStatus,jdbcType=BIT},
    #{description,jdbcType=VARCHAR}
    )
    </insert>


<!--more-->


在插入操作完成之后，参数category的id属性就已经被赋值了

如果数据库表的主键不是自增的类型，那么就需要应用层生成主键的方式··········这个就不多说了，需要的朋友，可以留言交流··

-----------------------------------------

下面是针对Oracle的写法,Oracle没有autoincrement，而是用触发器实现的 CURRVAL是在触发器中定义的.

    <insert id="insert" parameterClass="ProFeeKindObject">
          <![CDATA[
             INSERT INTO t_pro_feeKind (KINDID,kindName,kindType,enable)
             VALUES (seq_t_pro_feekind_id.nextval,#kindName#,#kindType#,#enable#)
            ]]>
            <selectKey resultClass="java.lang.Integer" keyProperty="kindId" >
            SELECT seq_t_pro_feekind_id.CURRVAL AS kindId FROM DUAL
            </selectKey>    
    </insert>

    <!-- 下面是针对MySQL的写法 -->
    <!--
       <selectKey resultClass="int" keyProperty="id" >
       SELECT @@IDENTITY AS id
       </selectKey>
    -->

其他参考代码：
持久化某个实体对象（如保存一个对象）时，如果我们不用selectKey，那么我们不会立刻得到实体对象的Id属性的，也就是数据表主键
Java代码

    Permission permission = new Permission(); 
    permission.set... 
    
    permmisonDao.createPermission(permission); 
    assertNull(permission); 
    Permission permission = new Permission();
    permission.set...
    
    permmisonDao.createPermission(permission);
    assertNull(permission);
    
    selectKey元素与其在父元素中的位置有关
    
    <insert id="addPermission" parameterClass="Permission">    
         <selectKey resultClass="int" keyProperty="permissionId">    
             SELECT SEQ_P_PERMISSION.NEXTVAL FROM DUAL     
         </selectKey>    
         INSERT INTO P_PERMISSION ( 
             PERMISSIONID, PERMISSIONINFO, PERMISSIONNAME, PERMISSIONENNAME, URL 
         ) VALUES ( 
             #permissionId#, #permissionInfo#, #permissionName#, #permissionEnName#, #url# 
         )     
    </insert>
    
    <insert id="addPermission" parameterClass="Permission"> 
    <selectKey resultClass="int" keyProperty="permissionId"> 
    SELECT SEQ_P_PERMISSION.NEXTVAL FROM DUAL   
    </selectKey> 
    INSERT INTO P_PERMISSION (
    PERMISSIONID, PERMISSIONINFO, PERMISSIONNAME, PERMISSIONENNAME, URL
    ) VALUES (
    #permissionId#, #permissionInfo#, #permissionName#, #permissionEnName#, #url#
    )   
    </insert>

Mysql、SQLServer在后
Xml代码

    <insert id="addPermission" parameterClass="Permission">      
    INSERT INTO P_PERMISSION ( 
         PERMISSIONID, PERMISSIONINFO, PERMISSIONNAME, PERMISSIONENNAME, URL 
    ) VALUES ( 
         #permissionId#, #permissionInfo#, #permissionName#, #permiss
    ionEnName#, #url# 
    ) 
    <selectKey resultClass="int" keyProperty="permissionId">    
         SELECT LAST_INSERT_ID()     
    </selectKey> 
    </insert>
    
    <insert id="addPermission" parameterClass="Permission">    
    INSERT INTO P_PERMISSION (
    PERMISSIONID, PERMISSIONINFO, PERMISSIONNAME, PERMISSIONENNAME, URL
    ) VALUES (
    #permissionId#, #permissionInfo#, #permissionName#, #permissionEnName#, #url#
    )
    <selectKey resultClass="int" keyProperty="permissionId"> 
    SELECT LAST_INSERT_ID()   
    </selectKey>
    </insert>

像上面这样书写，与selectKey的位置联系得太紧密了，iBatis的sqlMap配置文件的selectKey元素有个type属性，可以指定pre或者post表示前生成还是后生成。
对于Oracle，表示为
Xml代码

    <insert id="addPermission" parameterClass="Permission">    
        <selectKey resultClass="int" keyProperty="permissionId" type="pre">    
            SELECT SEQ_P_PERMISSION.NEXTVAL FROM DUAL     
        </selectKey>    
        INSERT INTO P_PERMISSION ( 
            PERMISSIONID, PERMISSIONINFO, PERMISSIONNAME, PERMISSIONENNAME, URL 
        ) VALUES ( 
            #permissionId#, #permissionInfo#, #permissionName#, #permissionEnName#, #url# 
        )     
    </insert>   
    
    
    <insert id="addPermission" parameterClass="Permission"> 
    <selectKey resultClass="int" keyProperty="permissionId" type="pre"> 
    SELECT SEQ_P_PERMISSION.NEXTVAL FROM DUAL   
    </selectKey> 
    INSERT INTO P_PERMISSION (
    PERMISSIONID, PERMISSIONINFO, PERMISSIONNAME, PERMISSIONENNAME, URL
    ) VALUES (
    #permissionId#, #permissionInfo#, #permissionName#, #permissionEnName#, #url#
    )   
    </insert>

Mysql、SQLServer等表示为：
Xml代码

    <insert id="addPermission" parameterClass="Permission">    
         <selectKey resultClass="int" keyProperty="permissionId" type="post">    
             SELECT LAST_INSERT_ID() 
         </selectKey>    
         INSERT INTO P_PERMISSION ( 
             PERMISSIONID, PERMISSIONINFO, PERMISSIONNAME, PERMISSIONENNAME, URL 
         ) VALUES ( 
             #permissionId#, #permissionInfo#, #permissionName#, #permissionEnName#, #url# 
         )     
    </insert>

转载自 [http://blog.csdn.net/jbgtwang/article/details/7307687][1]

[Ghostsf博客][2]


  [1]: http://blog.csdn.net/jbgtwang/article/details/7307687
  [2]: http://www.ghostsf.com
