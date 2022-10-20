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
include "tcpdf.php";
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
    $pdf->setLanguageArray(l);
}

// ------------$---------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$benefits = "WINDSCREEN 10<br> Personal Accident 1500<br> POLITICAL VIOLENCE AND TERRORISM 0<br> PASSENGER LEGAL LIABILITY 500";
$benefits = array("AMREF" => "5000-1", "WINDSCREEN" => "400-3", "400-3-checked" =>"", "BIMALIFE" => "600-1", "POLITICAL_VIOLENCE_AND_TERRORISM" => "500-2", "q"=>"", "RADIO_CASSETE" => "40-2");
// $benstring =  preg_replace("/[^a-zA-Z|'<br>']/", "", $benefits);
// $benvalues1 = preg_replace("/[^0-9.|'<>']/", "", $benefits);
// $benvalues = str_replace("<>","<br>",$benvalues1);
// $benarray = explode("<>", $benvalues1);
// $total_optional = array_sum($benarray);

$benstring = "";
$benvalues = "";

foreach ($benefits as $key => $val){
    echo !$key=="q";
    if ( strlen($val) >= 1 ) {
        $benstring.= $key."<br>";
        $valstring = explode("-",$val);
        $prem = $valstring[0];
        $rate = $valstring[1];
        $benvalues.= "Premium: ".$prem." " ."Rate: " .$rate."<br>";
    }
}
echo $benstring;
echo $benvalues;


// echo $outside_var;
// $html = <<<EOF
// <!DOCTYPE html>
// <html lang="en">
// <meta charset="utf-8">
// <head>
// <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
// <style>
//     h1 {
//         color: black;
//         font-family: times;
//         font-size: 8pt;
//         text-decoration: underline;
//     }
//     p.first {
//         color: black;
//         font-family: helvetica;
//         font-size: 8pt;
//     }
//     p.first span {
//         color: black;
//         font-style: italic;
//     }
//     p#second {
//         color: rgb(00,63,127);
//         font-family: times;
//         font-size: 8pt;
//         text-align: justify;
//     }
//     p#second > span {
//         background-color: black;
//     }
//     table.first {
//         color: black;
//         font-family: helvetica;
//         font-size: 8pt;
//     }
//     table.second {
//         color: black;
//         font-family: helvetica;
//         font-size: 8pt;
//     }

//     hr.third {
//         border: 10px solid green;
//         border-radius: 5px;
//     }

//     td {
//         /*border: 2px solid black;
//         background-color: #ffffee;*/
//     }
//     td.second {
//         margin:0px;
//         border-style: solid solid solid solid;
//         font-size: 8pt;
//     }
//     div.test {
//         color: #CC0000;
//         background-color: #FFFF66;
//         font-family: helvetica;
//         font-size: 8pt;
//         border-style: solid solid solid solid;
//         border-width: 2px 2px 2px 2px;
//         border-color: black black black black;
//         text-align: center;
//     }
//     .lowercase {
//         text-transform: lowercase;
//     }
//     .uppercase {
//         text-transform: uppercase;
//     }
//     .capitalize {
//         text-transform: capitalize;
//     }
// </style>
// </head>

// <div></div>
// <table class="first" cellpadding="4" cellspacing="18">
//     <tr>
//         <td width="90" align="center"><b><img src="https://bimaplus.co.ke/img/logo.png" alt="logo"style="width:1000px;height:800px;" ></b></td>
//         <td width="230" align="center"><b></b></td>
        
//         <td width="300" align="right"><b>sasasa<br>
//             sasasa<br>
//             Phone: sasasa<br>
//             Phone: sasasa2<br>
//             Email: email

//             </b></td>
//     </tr>
//     <hr style="height:1px;border-width:0;color:gray;background-color:gray"><br><hr>
//         <tr>
//         <td width="30" align="center"></td>
//         <td width="140" rowspan="6" class=""></td>
//         <td width="20"><br /></td>
//         <td width="600">RISK NOTE #risk_note_number &nbsp; business<br/></td>
//         <td width="80"></td>
//         <td align="center" width="45"><br /></td>
//     </tr>
//     <tr>
//         <td width="300" align="left" rowspan="3">
//             Policy No: <br>   
//             Class of Insurance: <br> 
//             Underwriting company: <br>   
//             Name of insured: <br> 
//             Scheme:  <br>   
//             PIN No: <br> 
//             ID No:  <br>   
//             Period of insurance: <br> 
//             Note:Terms and Conditions as per policy.
//         </td>
        
//         <td width="400" rowspan="3">
//             --- not issued --- <br>  
//             insurance_class <br>  
//             nderwriter <br>  
//             name <br>  
//             scheme <br>  
//             pin_no <br>  
//             id_no <br>  
//             From: period to to_date<br>  
//             <br>  
//         </td>
//         <hr style="height:1px;border-width:0;color:gray;background-color:gray"><br><hr>
//     </tr>
    
//     </table>

// <table class="third" cellpadding="4" cellspacing="">

// </table>
// <br>
// <table class="second" cellpadding="4" cellspacing="">
       
// <tr>
//     <td width="67" class="second" rowspan="">SI.No</td>
//     <td width="67" class="second" rowspan="">Reg.No </td>
//     <td width="67" class="second" rowspan="">Make/Model</td>
//     <td width="67" class="second" rowspan="">Color</td>
//     <td width="67" class="second" rowspan="">Engine No</td>
//     <td width="67" class="second" rowspan="">Chasis.No</td>
//     <td width="67" class="second" rowspan="">Seats</td>
//     <td width="67" class="second" rowspan="">CC</td>
//     <td width="67" class="second" rowspan="">Mfg.Yr</td>
//     <td width="67" class="second" rowspan="">Value</td>
// </tr>
// <tr>
//     <td width="67" class="second" rowspan="">1</td>
//     <td width="67" class="second" rowspan="">registration </td>
//     <td width="67" class="second" rowspan="">make</td>
//     <td width="67" class="second" rowspan="">color</td>
//     <td width="67" class="second" rowspan="">engine_number</td>
//     <td width="67" class="second" rowspan="">chasis </td>
//     <td width="67" class="second" rowspan="">passengers</td>
//     <td width="67" class="second" rowspan="">fuel</td>
//     <td width="67" class="second" rowspan="">man_year</td>
//     <td width="67" class="second" rowspan="">Value</td>
// </tr>

// </table>
// <table class="third" cellpadding="4" cellspacing="">
   
// <tr>
//     <td width="300" class="" rowspan="">Basic Premium (registration) basic_premium </td>
//     <td width="300" class="" rowspan="">Premium </td>
//     <td width="80" class="" rowspan="" align="right">basic_premium</td>
   
// </tr>
// <tr>
//     <td width="300" class="" rowspan=""></td>
//     <td width="300" class="" rowspan="">$benstring </td>
//     <td width="80" class="" rowspan="" align="right">$benvalues</td>
   
// </tr>
// <tr>
//     <td width="300" class="" rowspan=""></td>
//     <td width="300" class="" rowspan="">PCF (0.25)%: </td>
//     <td width="80" class="" rowspan="" align="right">PCF</td>
   
// </tr>
// <tr>
//     <td width="300" class="" rowspan=""></td>
//     <td width="300" class="" rowspan="">I.T.L (0.2)%:</td>
//     <td width="80" class="" rowspan="" align="right">ITL </td>
    
// </tr>

// <tr>
//     <td width="300" class="" rowspan=""></td>
//     <td width="300" class="" rowspan="">Stamp duty </td>
//     <td width="80" class="" rowspan="" align="right">stamp_duty</td>
   
// </tr>

// <tr style="border: 1px solid black;">
//     <td width="300" class="" rowspan=""></td>
//     <td width="300" class="" rowspan="">TOTAL</td>
//     <td width="80" class="" rowspan="" align="right">gross_premium</td>
   
// </tr>
// <hr>
// <table class="" cellpadding="4" cellspacing="18">
// <tr>
//     <td width="150" align="left" class="" rowspan="">Limits of Liability: </td>
//     <td width="220" align="left" class="" rowspan=""></td>
//     <td width="100" align="left" class="" rowspan=""></td>
// </tr>
// <tr>
//     <td width="150" align="left" class="" rowspan=""></td>
//     <td width="220" align="left" class="" rowspan=""></td>
//     <td width="100" align="left" class="" rowspan=""></td>
// </tr>
// <tr>
//     <td width="150" align="left" class="" rowspan=""></td>
//     <td width="220" align="left" class="" rowspan=""></td>
//     <td width="100" align="left" class="" rowspan=""></td>
// </tr>
// <tr>
//     <td width="150" align="left" class="" rowspan=""></td>
//     <td width="220" align="left" class="" rowspan=""></td>
//     <td width="100" align="left" class="" rowspan=""></td>
// </tr>

// <hr>
// <tr>
//     <td width="300" align="left" class="" rowspan="">Insurance is cash and carry</td>
//     <td width="220" align="left" class="" rowspan=""></td>
// </tr>
// <tr>
//     <td width="300" align="left" class="" rowspan="">Payment Option<br>PayBill 7290377<br>Iplus InsuranceAgency LTD</td>
//     <td width="220" align="left" class="" rowspan=""></td>
// </tr>
// <tr>
//     <td width="300" align="left" class="" rowspan="">Date: time </td>
//     <td width="220" align="left" class="" rowspan=""></td>
// </tr>
// <tr>
//     <td width="300" align="left" class="" rowspan="">
//     Prepared by Kenedy Nyaga:
//     </td>
//     <td width="100" align="right" class="" rowspan="">
//      Signature: 
//     </td>
//     <td width="67" align="center"><b><img src="https://bimaplus.co.ke/img/signature_image.gif" alt="logo" ></b></td>
// </tr>

// </table>
// EOF;

// // output the HTML content
// $pdf->writeHTML($html, true, false, true, false, '');

// // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// // add a page



// // output the HTML content


// // reset pointer to the last page

// // ---------------------------------------------------------
// $to = "ericksoi3709@gmail.com"; 
// $from = "ericksoi3709@gmail.com"; 
// $subject = "send email with pdf attachment"; 
// $message = "<p>Please see the attachment.</p>";
// $separator = md5(time());
// //Close and output PDF document
// $pdf->Output('example_061.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+