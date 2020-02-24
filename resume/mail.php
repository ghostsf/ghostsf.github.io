<?php
header("Content-type: text/html; charset=utf-8");  
if (!isset($_POST['submit'])) {
	exit('非法访问!');
}
require_once "email.class.php";
//******************** 配置信息 ********************************
$smtpserver = "smtp.163.com";
//SMTP服务器
$smtpserverport = 25;
//SMTP服务器端口
$smtpusermail = "ghost_sf@163.com";
//SMTP服务器的用户邮箱
$smtpemailto = "ghost_sf@163.com";
//发送给谁
$smtpuser = "ghost_sf@163.com";
//SMTP服务器的用户帐号
$smtppass = "justdoit!";
//SMTP服务器的用户密码
$mailtitle = "来自" . $_POST['name'] . "的留言 "."From ".$_POST['email'];
//邮件主题
$mailcontent = $_POST['content']."<hr><p>Ta的邮箱为：".$_POST['email']."</p><p>From i.ghostsf.com</p>";
//邮件内容
$mailtype = "HTML";
//邮件格式（HTML/TXT）,TXT为文本邮件
//************************ 配置信息 ****************************
$smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp -> debug = false;
//是否显示发送的调试信息
$state = $smtp -> sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

$referer = $_SERVER['HTTP_REFERER'];
if ($state == "") {
	echo "<script>alert('对不起，留言失败！');document.location.href='$referer'</script>";
	exit();
}
echo "<script>alert('留言成功！并已发送至ghostsf邮箱.');document.location.href='$referer'</script>";
?>