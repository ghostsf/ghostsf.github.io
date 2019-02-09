title: fsockopen函数被PHPDDOS利用攻击的解决办法【转】
categories: 旧文字
tags: [php,fsockopen]
date: 2015-11-02 16:21:40
---
通用解决方法：
 
找到程序里的fsockopen 函数，替换为：pfsockopen，即可解决所有问题，两个函数的区别在于pfsockopen 保持keep-alive，使得黑客无法进行 连接数攻击。
已知使用fsockopen 函数的程序文件路径（在fsockopen 前加p, 即fsockopen 修改为pfsockopen  即可 ）[其他程序可通过错误提示的文件路径查看更改]：
Discuz X2  安装提示不支持fsockopen：
将/include/install_var.php  文件里的
$func_items = array(‘mysql_connect’, ‘fsockopen‘, ‘gethostbyname’, ‘file_get_contents’, ‘xml_parser_create’);
替换为：
$func_items = array(‘mysql_connect’, ‘pfsockopen‘, ‘gethostbyname’, ‘file_get_contents’, ‘xml_parser_create’);
即可正常安装。
X2全部包含fsockopen的文件（如果用邮件只修改邮件即可，其他文件都是自动判断pfsockopen）：
 


<!--more-->


\api\manyou\Manyou.php
\api\trade\api_alipay.php
\install\include\install_function.php
\install\include\install_lang.php
\install\include\install_var.php
\source\admincp\admincp_addons.php
\source\admincp\admincp_checktools.php
\source\admincp\admincp_cloud.php
\source\admincp\admincp_misc.php
\source\admincp\cloud\cloud_doctor.php
\source\class\class_image.php
\source\class\class_sphinx.php
\source\class\block\xml\block_xml.php
\source\function\function_connect.php
\source\function\function_core.php
\source\function\function_filesock.php
\source\function\function_importdata.php
\source\function\function_mail.php      邮件相关
\source\function\function_plugin.php
\source\include\portalcp\portalcp_upload.php
\source\language\lang_admincp_cloud.php
\source\module\forum\forum_ajax.php
\source\module\misc\misc_manyou.php
\uc_client\client.php
\uc_client\lib\sendmail.inc.php         邮件相关
\uc_client\model\misc.php
\uc_server\install\func.inc.php
\uc_server\install\lang.inc.php
\uc_server\lib\sendmail.inc.php         邮件相关
\uc_server\model\misc.php
 Discuz 品牌空间不能安装，提示UC地址不正确：
修改/install/func.inc.php 里的fsockopen函数为pfsockopen
Discuz 7.2：(非首次安装，可以只改绿色部分。)
问题：使用uc 不能登录 ，fsockopen函数位于：
include\global.func.php(240): $fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);include\sendmail.inc.php(54): if(!$fp = fsockopen($mail['server'], $mail['port'], $errno, $errstr, 30)) {install\func.inc.php(803): $fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);install\var.inc.php(70): $func_items = array('mysql_connect', 'fsockopen', 'gethostbyname', 'file_get_contents', 'xml_parser_create');uc_client\client.php(211): $fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);uc_client\lib\sendmail.inc.php(40): if(!$fp = fsockopen($mail_setting['mailserver'], $mail_setting['mailport'], $errno, $errstr, 30)) {uc_client\model\misc.php(97): $fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);uc_server\lib\sendmail.inc.php(40): if(!$fp = fsockopen($mail_setting['mailserver'], $mail_setting['mailport'], $errno, $errstr, 30)) {uc_server\model\misc.php(94): $fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
 
DEDECMS 问答积分功能出现service.dedecms.com：
修改   /ask/data/scores.inc.php 里的fsockopen 为pfsockopen
附带dedecms 全部含fsockopen 的文件列表：
./include/dedehttpdown.class.php: $this->m_fp = @fsockopen($this->m_host, $this->m_port, $errno, $errstr,10);./include/sphinxclient.class.php: $fp = @fsockopen ( $host , $port, $errno, $errstr );./include/sphinxclient.class.php: $fp = @fsockopen ( $host , $port, $errno, $errstr, $this->_timeout );./include/dedecollection.func.php: $m_fp = fsockopen($ghost, 80, $errno, $err str,10);./include/dedecollection.func.php: $m_fp = fsockopen($ghost, 80, $errno, $err str,10) or die($ghost.'<br />');./include/mail.class.php: //is used in fsockopen()./include/mail.class.php: $this->sock = @fsockopen($this->relay_host, $th is->smtp_port, $errno, $errstr, $this->time_out);./include/mail.class.php: $this->sock = @fsockopen($host, $this->smtp _port, $errno, $errstr, $this->time_out);./ask/data/scores.inc.php: $fp = fsockopen($host,80,$errno,$errstr,30);./dede/module_main.php: $fp = fsockopen('www.dedecms.com',80,$errno,$errs tr,30);./dede/api_ucenter.php: $fp = @fsockopen(($host ? $host : $ip), $port, $errno, $ errstr, $timeout);./dede/plus_bshare.php: if (!$fp=@fsockopen($parse['host'],$parse['port'],$er rnum,$errstr,$timeout)) {./plus/bshare.php: if (!$fp=@fsockopen($parse['host'],$parse['port'],$errnum, $errstr,$timeout)) {
 UC通信不正常，DEDE整合UC连接不上的解决办法：
修改：
uc_client/client.php
uc_client/model/misc.php
替换里面的fsockopen  为pfsockopen
SHOPEX:
./install/svinfo.php:                    $fp = @fsockopen(“unix://”.DB_HOST);
./install/svinfo.php:                    $fp = @fsockopen(“tcp://”.$host, $port, $errno, $errstr,2);
./install/svinfo.php:        $rst = is_callable(‘fsockopen’);
./install/svinfo.php:        $items['fsockopen支持'] = array(
./install/svinfo.php:            $fp = fsockopen(isset($_SERVER['SERVER_ADDR'])?$_SERVER['SERVER_ADDR']:$_SERVER['HTTP_HOST'], $_SERVER['SERVER_PORT'], $errno, $errstr, 2);
./plugins/payment/pay.paypal_cn.php:        $fp = fsockopen (‘www.paypal.com’, 80, $errno, $errstr, 30);
./plugins/payment/pay.paypal_cn.php:        $fp = fsockopen (‘ssl://www.paypal.com’, 443, $errno, $errstr, 30);
./plugins/payment/pay.nochek.php:        $fp = fsockopen (‘www.nochex.com’, 80, $errno, $errstr, 10);
./plugins/payment/pay.paypal.server.php:        $fp = fsockopen (‘www.paypal.com’, 80, $errno, $errstr, 30);
./plugins/payment/pay.paypal.php:        $fp = fsockopen (‘www.paypal.com’, 80, $errno, $errstr, 30);
./plugins/passport/passport.ucenter.php:            $fp=@fsockopen(($ip ? $ip : $host),$port,$errorno,$errorstr,$timeout);
./core/lib/nusoap.php:        $this->debug(‘calling fsockopen with host ‘ . $host . ‘ connection_timeout ‘ . $connection_timeout);
./core/lib/nusoap.php:            $this->fp = @fsockopen( $host, $this->port, $this->errno, $this->error_str, $connection_timeout);
./core/lib/nusoap.php:            $this->fp = @fsockopen( $host, $this->port, $this->errno, $this->error_str);
./core/lib/uc_client/client.php:    $fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
./core/func_ext.php:    $fp = pfsockopen($url['host'], isset($url['port'])?$url['port']:80, $errno, $errstr, 2);
./core/func_ext.php:    $fp = pfsockopen( $host, $port, $errno, $errstr, $timeout );
./core/api/include/api_utility.php:        $process = fsockopen($this->host, $this->port, $errno, $errstr, 10);
./core/api/include/api_utility.php:        $process = fsockopen($host, 80, $errno, $errstr, 10);
./core/api/tools/1.0/api_b2b_1_0_tools.php:    $fp = fsockopen( $host, $port, $errno, $errstr, $timeout );