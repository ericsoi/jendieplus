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
date_default_timezone_set('Africa/Nairobi');
$logbook_file = $_SESSION["logbook_file"];
$id_file = $_SESSION["id_file"];
$kra_file = $_SESSION["kra_file"];
$optional_benefits = $_SESSION["additionalbenefts"];
$benstring =  preg_replace("/[^a-zA-Z|'<br>']/", "", $optional_benefits);
$benvalues1 = preg_replace("/[^0-9.|'<>']/", "", $optional_benefits);
$benvalues = str_replace("<>","<br>",$benvalues1);
$benarray = explode("<>", $benvalues1);
$total_optional = array_sum($benarray);
$policy_benefits = $_SESSION["POLICYBENEFITS"];


$server = "https://bimaplus.co.ke/bimaplus/";


$TransactionID = $_SESSION["stk_callback"]["TransactionID"];
$stk_underwriter = $_SESSION["stk_callback"]["underwriter"];
$stk_from_party = $_SESSION["stk_callback"]["from_party"];
$skt_date = date("m/d/Y");
// = $_SESSION["stk_callback"]["date"];
$coverage = trim($_SESSION["coverage"]);
$vehicle_type = $_SESSION["VEHICLE_TYPE"];
$underwriter = $_SESSION['underwriter'];
$vehicle_class = $_SESSION['vehicle_class'];
$cover = explode(".",$_SESSION['risk'])[1];
$insurance_class = $vehicle_type . " " . $cover . " " . $coverage;
$scheme = "Bima Plus";
$name = $_SESSION["name_contact"];
$pin_no = $_SESSION['kra_number'];
$id_no = $_SESSION['id_number'];
//$occupation = $_SESSION['OCCUPATION'];
$period = $_SESSION['policy_date'];
//$period_of_cover = $_SESSION['period'];
$property = $_SESSION["registration"];
//$location = $_SESSION["location"];
$shortcode = "7290377";
$signatory = "Kenedy Otieno";
$time = date("F j, Y, g:i a");
$registration = $_SESSION["registration"];
$make = $_SESSION["make"];
$color = $_SESSION["color"];
$engine_number = $_SESSION["engine_number"];
$chasis = $_SESSION["chasis"];
$passengers = $_SESSION["passengers"];
$fuel = $_SESSION["fuel"];
$man_year = $_SESSION["man_year"];
$basic_premium = $_SESSION["ANNUAL_RATES"];
$PCF =$_SESSION["PCF"];
$ITL =$_SESSION["ITL"];
$stamp_duty = $_SESSION["stamp_duty"];
$gross_premium =$_SESSION["gross_premium"];
$risk_note_number = rand();
$business = "NEW BUSINESS";
$period1 = strtotime($period);
$period =  date('d-m-Y', $period1);
if (isset($_SESSION["coverperiod"])){
    $cover_period = $_SESSION["coverperiod"];
    if ($cover_period == "1 year"){
        $new_date = strtotime('+ 364 days', $period1);
    }else{
        $new_date = strtotime('+ 29 days', $period1);
    }
}
if ($coverage == "Third Party Only"){
    echo "777777";
    $value = "";
}else{
    $value = $_SESSION["sum_insured"];
}
#$new_date = strtotime('+ 364 days', $period1);
$to_date =  date('d-m-Y', $new_date);
echo $cover_period."<br>";
echo $coverage."<br>";
echo $new_date."<br>";

//$totalpremium = $total_optional + $gross_premium;
$totalpremium = $gross_premium;

$stk_string = "$TransactionID confirmed sent Kshs.$gross_premium to  $stk_underwriter  from $stk_from_party at $skt_date";

if (isset($_SESSION["agent"])){
    print_r($_SESSION["agent"]);
    echo getcwd()."<br>";
    $id = "../" . explode("../../../bimaplus/", $id_file)[1];
    $kra = "../". explode("../../../bimaplus/", $kra_file)[1];
    $log = "../" . explode("../../../bimaplus/", $logbook_file)[1];
    print_r(explode("../../../bimaplus/", $logbook_file));
    echo $log ."<br>";
    echo $logbook_file ."<br>";
    if ($_SESSION["user_role"] === "Agent-Admin"){
        $company_name = $_SESSION["agent_info"]["companyname"];
        $box = $_SESSION["agent_info"]["physicaladdress"];
        $phone1 = $_SESSION["agent_info"]["phonenumber"];
        $phone2 = $_SESSION["agent_info"]["phonenumber"];
        $email = $_SESSION["agent_info"]["emailaddress"];
    }else{
        $company_name = "Iplus Insurance Agency Limited(Head Office)";
        $box = "PO BOX 29144 00100 GPO Equity Bank Building Third floor<br>suite 202, Ring Road Roundabout, Ngara Rd, Nairobi.";
        $phone2 = "+254 733 566 464";
        $phone1 = "+254 722 301 062";
        $email = "info@iplus.co.ke";
    }
} else{
    $company_name = "Iplus Insurance Agency Limited(Head Office)";
    $box = "PO BOX 29144 00100 GPO Equity Bank Building Third floor<br>suite 202, Ring Road Roundabout, Ngara Rd, Nairobi.";
    $phone2 = "+254 733 566 464";
    $phone1 = "+254 722 301 062";
    $email = "info@iplus.co.ke";


    $id  = "../" . $logbook_file;
    $kra = "../" . $id_file;
    $log = "../" . $kra_file;
}
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
        <td width="90" align="center"><b><img src="https://bimaplus.co.ke/img/logo.png" alt="logo"style="width:1000px;height:800px;" ></b></td>
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
    <td width="300" class="" rowspan="">Basic Premium ($registration) $basic_premium </td>
    <td width="300" class="" rowspan="">Premium </td>
    <td width="80" class="" rowspan="" align="right">$basic_premium</td>
   
</tr>

<tr>
    <td width="300" class="" rowspan=""></td>
    <td width="300" class="" rowspan="">Optional Benefits $benstring </td>
    <td width="80" class="" rowspan="" align="right"> <!---$benvalues---></td>
   
</tr>

<tr>
    <td width="300" class="" rowspan=""></td>
    <td width="300" class="" rowspan="">PCF (0.25)%: </td>
    <td width="80" class="" rowspan="" align="right">$PCF</td>
   
</tr>
<tr>
    <td width="300" class="" rowspan=""></td>
    <td width="300" class="" rowspan="">I.T.L (0.2)%:</td>
    <td width="80" class="" rowspan="" align="right">$ITL </td>
    
</tr>

<tr>
    <td width="300" class="" rowspan=""></td>
    <td width="300" class="" rowspan="">Stamp duty </td>
    <td width="80" class="" rowspan="" align="right">$stamp_duty</td>
   
</tr>

<tr style="border: 1px solid black;">
    <td width="300" class="" rowspan=""></td>
    <td width="300" class="" rowspan="">TOTAL</td>
    <td width="80" class="" rowspan="" align="right">$totalpremium</td>
   
</tr>
<hr>
<table class="" cellpadding="4" cellspacing="18">
<tr>
    <td width="150" align="left" class="" rowspan="">Limits of Liability: </td>
    <td width="220" align="left" class="" rowspan="">$policy_benefits</td>
    <td width="100" align="left" class="" rowspan=""></td>
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
    Prepared by Kenedy Nyaga:
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


$fromemail="underwriting@iplus.co.ke";
$frompassword="iplus@2020";
$toemail=$_SESSION["underweiter_email"];

$CC = "ericksoi3709@gmail.com";//"knyaga@iplus.co.ke";
$Subject = "ISSUE COVER FOR VEHICLE REGISTRATION $property"; 

if ($coverage == "Comprehensive"){
    $message = "Greetings, <br><br> As the above matter refers, kindly issue one year cover for vehicle registration $property as per attached risk note. Also attached is vehicle logbook and client KYC including KRA PIN and copy of ID .<br><br>See below MPESA payment confirmation advise :<br>$stk_string<br><br><br>Kindly send Valuation Letter";
}else{
    $message = "Greetings, <br><br> As the above matter refers, kindly issue one year cover for vehicle registration $property as per attached risk note. Also attached is vehicle logbook and client KYC including KRA PIN and copy of ID .<br><br>See below MPESA payment confirmation advise :<br>$stk_string";
}
$message .= "<br>----- <br>Best Regards,<br>
Kennedy Otieno<br>

Principal Officer | Iplus Insurance Agency Limited | Nairobi<br>

Phone No : +254733566464, +254722301062<br>
<a href=www.iplus.co.ke>www.iplus.co.ke</a>
<br>
<a href=www.bimaplus.co.ke>www.bimaplus.co.ke</a>
<br>";

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
    $mail->setFrom($fromemail, 'BIMAPLUS');          //This is the email your form sends From
    $mail->addAddress($toemail, 'BIMAPLUS'); // Add a recipient address
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
