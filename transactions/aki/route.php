<?php
    @session_start();
    // print_r($_SESSION);
    $MemberCompanyID = $_SESSION["underwriter"]["Membercompanyid"];
    $Typeofcover = $_SESSION["cover"];//Comprehensive, Thirdparty
    $VehicleType = $_SESSION["class"];  
    $Policyholder = $_SESSION["client_details"]["name_contact"];
    $policynumber = 1234;
    $Commencingdate = $_SESSION["logbook"]["date"];
    $CoverPeriod = $_SESSION["client_details"]["coverperiod"];
    $EndDate = new DateTime($Commencingdate);
  
    $coverextenddate = "+".$_SESSION["client_details"]["coverperiod"];
    $EndDate->modify($coverextenddate);
    $Expiringdate = $EndDate->format('d/m/Y');
    $Registrationnumber = $_SESSION["client_details"]["vehicle_reg"];
    $Chassisnumber = $_SESSION["logbook"]["chasis"];
    $Phonenumber = $_SESSION["client_details"]["phone_number"];
    $Bodytype = $_SESSION["logbook"]["body"];
    $TonnageCarryingCapacity = $_SESSION["logbook"]["load_capacity"];
    $Vehiclemake = $_SESSION["logbook"]["make"];
    $Vehiclemodel = $_SESSION["logbook"]["model"];
    $Enginenumber = $_SESSION["logbook"]["engine_number"];
    $Email = $_SESSION["agency_owner"]["emailaddress"];
    // $SumInsured = $_SESSION["sum_insured"];
    $InsuredPIN = $_SESSION["logbook"]["kra_number"];
    $Yearofmanufacture = $_SESSION["logbook"]["man_year"];
    $HudumaNumber = $_SESSION["logbook"]["id_number"];

    include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/cert_class_a.php';
    
?>