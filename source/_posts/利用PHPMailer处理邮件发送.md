title: 利用PHPMailer处理邮件发送
categories: 
tags: []
date: 2015-12-23 03:25:31
---
    /**
     * Simple example script using PHPMailer with exceptions enabled
     * @package phpmailer
     * @version $Id$
     */
    function send_Email($to, $name, $subject = '', $body = '', $attachment = null)
    {
        try {
            $config = C('THINK_EMAIL');
    
            vendor('PHPMailer.class#phpmailer');
    
            $mail = new PHPMailer(true); //PHPMailer对象
    
            //$body             = preg_replace('/\\\\/','', $body); //对邮件内容进行必要的过滤
    
            $mail->CharSet = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    
            $mail->IsSMTP();  // 设定使用SMTP服务
    
            $mail->SMTPDebug = 1;                     // 关闭SMTP调试功能
            // 1 = errors and message
            // 2 = messages only
    
            $mail->SMTPAuth = true;                  // 启用 SMTP 验证功能
    
            $mail->SMTPSecure = 'ssl';                 // 使用安全协议
    
            $mail->Mailer = "SMTP";
    
            $mail->Host = $config['SMTP_HOST'];  // SMTP 服务器
    
            $mail->Port = $config['SMTP_PORT'];  // SMTP服务器的端口号
    
            $mail->Username = $config['SMTP_USER'];  // SMTP服务器用户名
    
            $mail->Password = $config['SMTP_PASS'];  // SMTP服务器密码
    
            $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
    
            $replyEmail = $config['REPLY_EMAIL'] ? $config['REPLY_EMAIL'] : $config['FROM_EMAIL'];
    
            $replyName = $config['REPLY_NAME'] ? $config['REPLY_NAME'] : $config['FROM_NAME'];
    
            $mail->AddReplyTo($replyEmail, $replyName);
    
            //$mail->Body="这是邮件测试类";
    
            $mail->AddAddress($to, $name);
    
            $mail->Subject = $subject;
    
            $mail->WordWrap = 80; // set word wrap
    
            //$mail->MsgHTML($body);
    
            $mail->IsHTML(true); // send as HTML
    
            $mail->MsgHTML($body);
    
            /*     if(is_array($attachment)){ // 添加附件
    
                    foreach ($attachment as $file){
    
                        is_file($file) && $mail->AddAttachment($file);
    
                    }
    
                }
             */
            return $mail->Send() ? true : $mail->ErrorInfo;
    
        } catch (phpmailerException $e) {
            echo $e->errorMessage();
        }
    
    }