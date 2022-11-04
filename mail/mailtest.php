<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



$fromemail="underwriting@jendieplus.co.ke";
$frompassword="8^znOPgtC&41";
$toemail="ericksoi3709@gmail.com";
$email = "ericksoi3709@gmail.com";
$names = "ericksoi3709@gmail.com";
$company = "ericksoi3709@gmail.com";
$phone = "ericksoi3709@gmail.com";
$product = "ericksoi3709@gmail.com";
$comments = "ericksoi3709@gmail.com";
$CC = "ericksoi3709@gmail.com";
$Subject = "ISSUE COVER FOR VEHICLE REGISTRATION "; 

$message = "Greetings, <br><br> As the above matter refers, kindly issue one year cover for vehicle registration  as per attached risk note. Also attached is vehicle logbook and client KYC including KRA PIN and copy of ID .<br><br>See below MPESA payment confirmation advise :<br><br><br><br>Kindly send the insurance certificate and valuation letter to client email : knyaga@iplus.co.ke and Phone : 0722301062.";
$message .= "<br>----- <br>Best Regards,<br>
Kennedy Otieno<br>

Principal Officer | Iplus Insurance Agency Limited | Nairobi<br>

Phone No : +254733566464, +254722301062<br>
<a href=www.iplus.co.ke>www.iplus.co.ke</a>
<br>
<a href=www.bimaplus.co.ke>www.bimaplus.co.ke</a>
<br>";
// Username:	underwriting@iplus.co.ke
// Password:	8^znOPgtC&41
// Incoming Server:	host67.registrar-servers.com
// IMAP Port: 993 POP3 Port: 995
// Outgoing Server:	host67.registrar-servers.com
// SMTP Port: 465
// IMAP, POP3, and SMTP require authentication.
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = "mail.jendieplus.co.ke";//"smtp.gmail.com";                   // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = "underwriting@jendieplus.co.ke";              // SMTP username
    $mail->Password = "8^znOPgtC&41";                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;//587;  
                                      // TCP port to connect to

    //Recipients
    $mail->setFrom("underwriting@jendieplus.co.ke", 'jendieplus');          //This is the email your form sends From
    $mail->addAddress("underwriting@jendieplus.co.ke", 'jendieplus'); // Add a recipient address
    //$attachment= $pdf->Output('attachment.pdf', 'S');


    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body    = $message;
    $mail->AddCC($CC);
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
#header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
