<?php
//============================================================+
// File name   : example_061.php
// Begin       : 2010-05-24
// Last Update : 2014-01-25
//
// Description : Example 061 for TCPDF class
//               XHTML + CSS
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: XHTML + CSS
 * @author Nicola Asuni
 * @since 2010-05-25
 */

// Include the main TCPDF library (search for installation path).
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include "tcpdf.php";
if(!isset($_SESSION)){ 
    session_start(); 
}
// print_r($_SESSION);
date_default_timezone_set('Africa/Nairobi');
$id_file = $_SESSION["client_files"]["u_id"];
$kra_file = $_SESSION["client_files"]["u_kra"];
$logbook_file = $_SESSION["client_files"]["u_logbook"];
#$optional_benefits = $_SESSION["additionalbenefts"];
// $benstring =  preg_replace("/[^a-zA-Z|'<br>']/", "", $optional_benefits);
// $benvalues1 = preg_replace("/[^0-9.|'<>']/", "", $optional_benefits);
// $benvalues = str_replace("<>","<br>",$benvalues1);
// $benarray = explode("<>", $benvalues1);
// $total_optional = array_sum($benarray);

$policy_benefits = $_SESSION["product"]["policylimits"];
if(isset($_SESSION["optionalbenefits"])){
    $optional_benefit = $_SESSION["optionalbenefits"];
}else{
    $optional_benefit = array("None"=>"None-None");
}
// $policy_benefits = "The jaguar (Panthera onca) is a large cat and the only Panthera species native to the Americas. With a body length of 1.12 to 1.85 m (3 ft 8 in to 6 ft 1 in) and a weight of 56 to 96 kg (123 to 212 lb), it is the third-largest cat species in the world. Its coat is covered by spots that transition to rosettes on the sides. The jaguar's range extends from the southern U.S. through Mexico and across much of Central America to Paraguay and northern Argentina. It inhabits forested and open terrain, but prefers dense jungle. It is adept at swimming and is largely a solitary, opportunistic, stalk-and-ambush apex predator. The wild jaguar population is thought to have declined since the late 1990s, and is threatened by habitat loss and fragmentation, poaching and human–wildlife conflict. Since 2002, it has been listed as a near-threatened species on the IUCN Red List. The jaguar has featured prominently in indigenous cultures of the Americas, including the Maya and Aztec civilizations";
$policy_benefits = $_SESSION["product"]["policylimits"];
$benstring = "";
$benvalues = "";
$benrate ="";

foreach ($optional_benefit as $key => $val){
    if (strlen($val) >= 1 && !strpos($key, "checked")) {
        $benstring.= ucwords(str_replace("_", " ", $key))."<br>";
        $valstring = explode("-",$val);
        $prem = $valstring[0];
        $rate = $valstring[1];
        $benvalues.= $prem."<br>";
        $benrate.=$rate."<br>";
    }
}
$server = "https://jendieplus.co.ke";
// print_r($_SESSION);
$TransactionID = $_SESSION["stk_callback"]->MpesaReceiptNumber;
$stk_from_party = $_SESSION["stk_callback"]->PhoneNumber;
$skt_date = date("m/d/Y");
// = $_SESSION["stk_callback"]["date"];
$coverage = trim($_SESSION["product"]["coverage"]);
$vehicle_type = $_SESSION["logbook"]["type"];
$underwriter = $_SESSION['underwriter']['Name'];
$vehicle_class = $_SESSION["product"]['vehicleclass'];
$cover = $_SESSION["product"]['coverage'];
$insurance_class =$_SESSION["class"];
$scheme = "JendiePlus";
$name = $_SESSION["confirmed_items"]["firstname"]." ".$_SESSION["confirmed_items"]["lastname"];
$pin_no = $_SESSION["confirmed_items"]["kra"];
$id_no = $_SESSION["confirmed_items"]["idnumber"];
//$occupation = $_SESSION['OCCUPATION'];
$period = $_SESSION["logbook"]['date'];
//$period_of_cover = $_SESSION['period'];
$property = $_SESSION["confirmed_items"]["registrationnumber"];
//$location = $_SESSION["location"];
$shortcode = "7290377";
$signatory = "Kenedy Otieno";
$time = date("F j, Y, g:i a");
$registration = $property;
$make = $_SESSION["logbook"]["make"];
$color = $_SESSION["logbook"]["color"];
$engine_number = $_SESSION["logbook"]["engine_number"];
$chasis = $_SESSION["confirmed_items"]["chasis"];
$passengers = $_SESSION["logbook"]["passengers"];
$fuel = $_SESSION["logbook"]["fuel"];
$man_year = $_SESSION["logbook"]["man_year"];
$basic_premium = $_SESSION["basicpremium"];
// $PCF =$_SESSION["PCF"];
// $ITL =$_SESSION["ITL"];
// $stamp_duty = $_SESSION["stamp_duty"];
$PCF = 60;
$ITL = 10;
$stamp_duty = 40;
$gross_premium =$_SESSION["grosspremium"];
$risk_note_number = rand();
$business = "NEW BUSINESS";
$period1 = strtotime($period);
$period =  date('d-m-Y', $period1);
if (isset($_SESSION["client_details"]["coverperiod"])){
    $cover_period = $_SESSION["client_details"]["coverperiod"];
    if ($cover_period == "1 year"){
        $new_date = strtotime('+ 364 days', $period1);
    }else{
        $new_date = strtotime('+ 29 days', $period1);
    }
}
if ($coverage == "Third Party Only"){
    $value = "";
}else{
    $value = $_SESSION["client_details"]["sum_insured"];
}
#$new_date = strtotime('+ 364 days', $period1);
$to_date =  date('d-m-Y', $new_date);

//$totalpremium = $total_optional + $gross_premium;
$totalpremium = $gross_premium;

$stk_string = "$TransactionID confirmed sent Kshs.$gross_premium to  $underwriter  from $stk_from_party at $skt_date";

$id =  $id_file;
$kra = $kra_file;
$log = $logbook_file;

if (isset($_SESSION["user_role"])){
    //echo getcwd()."<br>";
    //print_r(explode("../../../bimaplus/", $logbook_file));
    // $log ."<br>";
    // $logbook_file ."<br>";
    if ($_SESSION["user_role"] === "Agent-Admin"){
        $company_name = $_SESSION["agent_info"]["companyname"];
        $box = $_SESSION["agent_info"]["physicaladdress"];
        $phone1 = $_SESSION["agent_info"]["phonenumber"];
        $phone2 = $_SESSION["agent_info"]["phonenumber"];
        $email = $_SESSION["agent_info"]["emailaddress"];
    }else{
        $company_name = "JendiePlus Technologies(Head Office)";
        $box = "PO BOX 29144 00100 GPO Equity Bank Building Third floor<br>suite 202, Ring Road Roundabout, Ngara Rd, Nairobi.";
        $phone2 = "+254 733 566 464";
        $phone1 = "+254 722 301 062";
        $email = "info@iplus.co.ke";
    }
} else{
    $company_name = "JendiePlus Technologies(Head Office)";
    $box = "PO BOX 29144 00100 GPO Equity Bank Building Third floor<br>suite 202, Ring Road Roundabout, Ngara Rd, Nairobi.";
    $phone2 = "+254 733 566 464";
    $phone1 = "+254 722 301 062";
    $email = "info@iplus.co.ke";
}
$company_name = $_SESSION["agency_owner"]["companyname"];
$box = $_SESSION["agency_owner"]["postaladdress"];
$phone1 = $_SESSION["agency_owner"]["phonenumber"];
$phone2 = $_SESSION["agency_owner"]["phonenumber"];
$email = $_SESSION["agency_owner"]["emailaddress"];
$agency_owner = $_SESSION["agency_owner"]["firstname"] . " " . $_SESSION["agency_owner"]["lastname"];

//require_once('examples/tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information

// set default header data

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font

// set margins

// set auto page breaks

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style

$html = <<<EOF
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<style>
    h1 {
        color: black;
        font-family: times;
        font-size: 8pt;
        text-decoration: underline;
    }
    p.first {
        color: black;
        font-family: helvetica;
        font-size: 8pt;
    }
    p.first span {
        color: black;
        font-style: italic;
    }
    p#second {
        color: rgb(00,63,127);
        font-family: times;
        font-size: 8pt;
        text-align: justify;
    }
    p#second > span {
        background-color: black;
    }
    table.first {
        color: black;
        font-family: helvetica;
        font-size: 8pt;
    }
    table.second {
        color: black;
        font-family: helvetica;
        font-size: 8pt;
    }

    hr.third {
        border: 10px solid green;
        border-radius: 5px;
    }

    td {
        /*border: 2px solid black;
        background-color: #ffffee;*/
    }
    td.second {
        margin:0px;
        border-style: solid solid solid solid;
        font-size: 8pt;
    }
    div.test {
        color: #CC0000;
        background-color: #FFFF66;
        font-family: helvetica;
        font-size: 8pt;
        border-style: solid solid solid solid;
        border-width: 2px 2px 2px 2px;
        border-color: black black black black;
        text-align: center;
    }
    .lowercase {
        text-transform: lowercase;
    }
    .uppercase {
        text-transform: uppercase;
    }
    .capitalize {
        text-transform: capitalize;
    }
</style>
</head>

<div></div>
<table class="first" cellpadding="4" cellspacing="18">
    <tr>
        <td width="85" align="center"><b><img src="https://jendieplus.co.ke/img/logo.png" alt="logo" ></b></td>
        <td width="230" align="center"><b></b></td>
        
        <td width="300" align="right"><b>$company_name<br>
            $box<br>
            Phone: $phone1<br>
            Phone: $phone2<br>
            Email: $email

            </b></td>
    </tr>
    <hr style="height:1px;border-width:0;color:gray;background-color:gray"><br><hr>
        <tr>
        <td width="30" align="center"></td>
        <td width="140" rowspan="6" class=""></td>
        <td width="20"><br /></td>
        <td width="600">RISK NOTE #$risk_note_number &nbsp; $business<br/></td>
        <td width="80"></td>
        <td align="center" width="45"><br /></td>
    </tr>
    <tr>
        <td width="300" align="left" rowspan="3">
            Policy No: <br>   
            Class of Insurance: <br> 
            Underwriting company: <br>   
            Name of insured: <br> 
            Scheme:  <br>   
            PIN No: <br> 
            ID No:  <br>   
            Period of insurance: <br> 
            Note:Terms and Conditions as per policy.
        </td>
        
        <td width="400" rowspan="3">
            --- not issued --- <br>  
            $insurance_class <br>  
            $underwriter <br>  
            $name <br>  
            $scheme <br>  
            $pin_no <br>  
            $id_no <br>  
            From: $period to $to_date<br>  
            <br>  
        </td>
        <hr style="height:1px;border-width:0;color:gray;background-color:gray"><br><hr>
    </tr>
    
    </table>

<table class="third" cellpadding="4" cellspacing="">

</table>
<br>
<table class="second" cellpadding="4" cellspacing="">
       
<tr>
    <td width="67" class="second" rowspan="">SI.No</td>
    <td width="67" class="second" rowspan="">Reg.No </td>
    <td width="67" class="second" rowspan="">Make/Model</td>
    <td width="67" class="second" rowspan="">Color</td>
    <td width="67" class="second" rowspan="">Engine No</td>
    <td width="67" class="second" rowspan="">Chasis.No</td>
    <td width="67" class="second" rowspan="">Seats</td>
    <td width="67" class="second" rowspan="">CC</td>
    <td width="67" class="second" rowspan="">Mfg.Yr</td>
    <td width="67" class="second" rowspan="">Value</td>
</tr>
<tr>
    <td width="67" class="second" rowspan="">1</td>
    <td width="67" class="second" rowspan="">$registration </td>
    <td width="67" class="second" rowspan="">$make</td>
    <td width="67" class="second" rowspan="">$color</td>
    <td width="67" class="second" rowspan="">$engine_number</td>
    <td width="67" class="second" rowspan="">$chasis </td>
    <td width="67" class="second" rowspan="">$passengers</td>
    <td width="67" class="second" rowspan="">$fuel</td>
    <td width="67" class="second" rowspan="">$man_year</td>
    <td width="67" class="second" rowspan="">$value</td>
</tr>

</table>
<table class="third" cellpadding="4" cellspacing="">
   
<tr>
    <td width="240" class="" rowspan="">Basic Premium ($registration) $basic_premium </td>
    <td width="270" class="" rowspan="">Premium </td>
    <td width="170" class="" rowspan="" align="right">$basic_premium</td>
   
</tr>

<tr>
    <td width="136" class="" rowspan=""></td>
    <td width="136" class="" rowspan=""></td>
    <td width="136" class="" rowspan=""></td>
    <td width="136" class="" rowspan="">Optional Benefits</td>
    <td width="136" class="" rowspan=""></td>
   
</tr>

<tr>
    <td width="240" class="" rowspan=""></td>
    <td width="350" class="" rowspan="" align="right"></td>
    <td width="50" class="" rowspan="" align="left">Rate</td>
    <td width="50" class="" rowspan="" align="left">Value</td>

   
</tr>

<tr>
    <td width="240" class="" rowspan=""></td>
    <td width="350" class="" rowspan="">$benstring</td>
    <td width="50" class="" rowspan="" align="left">$benrate</td>
    <td width="50" class="" rowspan="" align="left">$benvalues</td>
   
</tr>
<tr>
    <td width="136" class="" rowspan=""></td>
    <td width="136" class="" rowspan=""></td>
    <td width="136" class="" rowspan=""></td>
    <td width="136" class="" rowspan="">Levies</td>
    <td width="136" class="" rowspan=""></td>
   
</tr>

<tr>
    <td width="240" class="" rowspan=""></td>
    <td width="270" class="" rowspan="">PCF (0.25)%: </td>
    <td width="170" class="" rowspan="" align="right">$PCF</td>
   
</tr>
<tr>
    <td width="240" class="" rowspan=""></td>
    <td width="270" class="" rowspan="">I.T.L (0.2)%:</td>
    <td width="170" class="" rowspan="" align="right">$ITL </td>
    
</tr>

<tr>
    <td width="240" class="" rowspan=""></td>
    <td width="270" class="" rowspan="">Stamp duty </td>
    <td width="170" class="" rowspan="" align="right">$stamp_duty</td>
   
</tr>

<tr style="border: 1px solid black;">
    <td width="240" class="" rowspan=""></td>
    <td width="270" class="" rowspan="">TOTAL</td>
    <td width="170" class="" rowspan="" align="right">$totalpremium</td>
   
</tr>
<hr>
<table class="" cellpadding="4" cellspacing="18">
<tr>
    <td align="center" class="" rowspan="">Limits of Liability: </td>
</tr>
<tr>
    <td class="" rowspan="">$policy_benefits</td>
</tr>

<hr>
<tr>
    <td width="300" align="left" class="" rowspan="">Insurance is cash and carry</td>
    <td width="220" align="left" class="" rowspan=""></td>
</tr>
<tr>
    <td width="300" align="left" class="" rowspan="">Payment Option<br>PayBill 7290377<br>Iplus InsuranceAgency LTD</td>
    <td width="220" align="left" class="" rowspan=""></td>
</tr>
<tr>
    <td width="300" align="left" class="" rowspan="">Date: $time </td>
    <td width="220" align="left" class="" rowspan=""></td>
</tr>
<tr>
    <td width="300" align="left" class="" rowspan="">
    <b> Prepared by $agency_owner</b>:
    </td>
    <td width="100" align="right" class="" rowspan="">
     Signature: 
    </td>
    <td width="67" align="center"><b><img src="https://bimaplus.co.ke/img/signature_image.gif" alt="logo" ></b></td>
</tr>

</table>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page



// output the HTML content


// reset pointer to the last page

// ---------------------------------------------------------

//Close and output PDF document
//$pdf->Output('example_061.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
    // Username:	underwriting@jendieplus.co.ke
    // Password:	8^znOPgtC&41
    // Incoming Server:	mail.jendieplus.co.ke
    // IMAP Port: 993 POP3 Port: 995
    // Outgoing Server:	mail.jendieplus.co.ke
    // SMTP Port: 465
    // Username:	underwriting@iplus.co.ke
    // Password:	8^znOPgtC&41
    // Incoming Server:	host67.registrar-servers.com
    // IMAP Port: 993 POP3 Port: 995
    // Outgoing Server:	host67.registrar-servers.com
    // SMTP Port: 465
    // IMAP, POP3, and SMTP require authentication.


    // Anyway,  see below:
    // Emails:
    // support@jendieplus.co.ke -> AeNf=2#laU0a
    // info@jendieplus.co.ke -> ~EQ0MVbt7MJu
    // knyaga@jendieplus.co.ke -> Ny4g4-1234!!
    // fodhiambo -> f0dhiambo123
    // it@jendieplus.co.ke -> hwiq)s2hiz]T
    // underwriting@jendieplus.co.ke -> 8^znOPgtC&41
    
    
    // Username: underwriting@jendieplus.co.ke
    // Password: 8^znOPgtC&41
    // Incoming Server: mail.jendieplus.co.ke
    // IMAP Port: 993 POP3 Port: 995
    // Outgoing Server: mail.jendieplus.co.ke
    // SMTP Port: 465

$fromemail="underwriting@iplus.co.ke";
$frompassword="8^znOPgtC&41";
$toemail=$_SESSION["underweiter_email"];
$CC=$_SESSION["email_cc"];
// $toemail = "knyaga@iplus.co.ke";
// $CC = "ericksoi3709@gmail.com";//"knyaga@iplus.co.ke";
$Subject = "ISSUE COVER FOR VEHICLE REGISTRATION $property"; 

if ($coverage == "Comprehensive"){
    $message = "Greetings, <br><br> As the above matter refers, kindly issue one year cover for vehicle registration $property as per attached risk note. Also attached is vehicle logbook and client KYC including KRA PIN and copy of ID .<br><br>See below MPESA payment confirmation advise :<br>$stk_string<br><br><br>Kindly send Valuation Letter";
}else{
    $message = "Greetings, <br><br> As the above matter refers, kindly issue one year cover for vehicle registration $property as per attached risk note. Also attached is vehicle logbook and client KYC including KRA PIN and copy of ID .<br><br>See below MPESA payment confirmation advise :<br>$stk_string";
}
$message .= "<br>----- <br><br>

Do not reply, this email has been system generated.<br>

JendiePlus Technologies | Nairobi<br>

Phone No : +254723775289, +254722301062<br>
<a href=www.jendieplus.co.ke>www.jendieplus.co.ke</a>
<br>";
    // Username:	underwriting@jendieplus.co.ke
    // Password:	8^znOPgtC&41
    // Incoming Server:	mail.jendieplus.co.ke
    // IMAP Port: 993 POP3 Port: 995
    // Outgoing Server:	mail.jendieplus.co.ke
    // SMTP Port: 465
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = "host67.registrar-servers.com";//"smtp.gmail.com";                   // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $fromemail;              // SMTP username
    $mail->Password = $frompassword;                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;//587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($fromemail, 'JendiePlus');          //This is the email your form sends From
    $mail->addAddress($toemail, 'JendiePlus'); // Add a recipient address
    //$attachment= $pdf->Output('attachment.pdf', 'S');
    //echo $logbook_file;
    ////print_r(scandir("../",1));
    //print_r(explode("../", $logbook_file));
    
    //echo $log;
    ///print_r(scandir("../client_files",1));
    $attachment = $pdf->Output('risknote.pdf', 'S');
    $mail->AddStringAttachment($attachment, 'risknote.pdf');
    $mail->AddAttachment($kra);
    $mail->AddAttachment($log);
    $mail->AddAttachment($id);
   



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
