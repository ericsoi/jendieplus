<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPDebug  = 1;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 465;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "ericksoi3709@gmail.com";
    $mail->Password   = "rujfcoostmbssnmc";

    $mail->IsHTML(true);
    $mail->AddAddress("ericksoi3709@gmail.com", "recipient name");
    $mail->SetFrom("ericksoi3709@gmail.com", "from-name");
    $mail->AddReplyTo("ericksoi3709@gmail.com", "reply-to-name");
    $mail->AddCC("ericksoi3709@gmail.com", "Erick");
    $mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
    $content = "This is a Test Email sent via Gmail SMTP Server using PHP mailer class.";

    $mail->MsgHTML($content); 
    if(!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
    } else {
    echo "Email sent successfully";
    }
    // 'Username:	ericksoi3709@gmail.com
    // Password:	8^znOPgtC&41
    // Incoming Server:	host67.registrar-servers.com
    // IMAP Port: 993 POP3 Port: 995
    // Outgoing Server:	host67.registrar-servers.com
    // SMTP Port: 465
    // IMAP, POP3, and SMTP require authentication.'

    // "rujfcoostmbssnmc"
?>

