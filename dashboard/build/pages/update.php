<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(!(isset($_SESSION["firstname"]))){
        header ("Location: sign-up.php");
    }
}
?>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">

    <title>
        JendiePlus
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- CSS Files -->



    <link id="pagestyle" href="./assets/css/soft-design-system.css?v=1.0.8" rel="stylesheet" />



</head>

<body class="index-page">


    <!-- Navbar -->
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid px-0">
                        <a class="navbar-brand font-weight-bolder ms-sm-3" href="#" rel="tooltip" data-placement="bottom">JendiePlus</a>


                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <header class="header-2">
        <div class="page-header min-vh-75 relative" style="background-image: url('./assets/img/curved-images/curved.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 text-center mx-auto">
                        <h3 class="text-white pt-3 mt-n5">Greetings <?php echo $_SESSION["firstname"];?> </h3><br>
                        
                    </div>
                    <div class="col-lg-7 text-center mx-auto">
                        <h5 class="text-white pt-3 mt-n5">Complete registration to start your transaction today.</h5>

                    </div>
                </div>
            </div>

            <div class="position-absolute w-100 z-index-1 bottom-0">
                <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
          <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="moving-waves">
          <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40" />
          <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
          <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
          <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
          <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
          <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95" />
        </g>
      </svg>
            </div>
        </div>
    </header>

    <section class="pt-3 pb-4" id="count-stats">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 z-index-2 border-radius-xl mt-n10 mx-auto py-3 blur shadow-blur">
                    <form role="form" id="contact-form" method="post" action="../../processor/handle_update.php">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Company Name</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Agency Name" id="agency" name="agency" <?php if(isset($_SESSION["register"]["agency"])) echo 'value='.'"'.$_SESSION["register"]["agency"].'"'?> aria-label="First Name..."  type="text" required>
                                    </div>
                                </div>
                                <div class="col-md-3 ps-2">
                                    <label>Postal Address</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="P.O. BOX"  id="postaladdress" name="postaladdress" <?php if(isset($_SESSION["register"]["postaladdress"])) echo 'value='.'"'.$_SESSION["register"]["postaladdress"].'"'?> aria-label="Last Name..." required>
                                    </div>
                                </div>
                                <div class="col-md-3 ps-2">
                                    <label>Physical Address</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Office Location" id="physicaladdress" name="physicaladdress" <?php if(isset($_SESSION["register"]["physicaladdress"])) echo 'value='.'"'.$_SESSION["register"]["physicaladdress"].'"'?>  aria-label="Last Name..." required>
                                    </div>
                                </div>
                                <div class="col-md-3 ps-2">
                                    <label>IRA Licence Number</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Agency IRA Licence" id="ira" name="ira" <?php if(isset($_SESSION["register"]["ira"])) echo 'value='.'"'.$_SESSION["register"]["ira"].'"'?> onchange="licence(id,value)" aria-label="Last Name..." required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label>Agent Code</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Agent Code" id="code" name="code" <?php if(isset($_SESSION["register"]["code"])) echo 'value='.'"'.$_SESSION["register"]["code"].'"'?> onchange="licence(id,value)" aria-label="First Name..." type="text" required>
                                    </div>
                                </div>
                                <div class="col-md-3 ps-2">
                                    <label>KRA PIN Number</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="KRA PIN" id="kra" name="kra" <?php if(isset($_SESSION["register"]["kra"])) echo 'value='.'"'.$_SESSION["register"]["kra"].'"'?> aria-label="Last Name..." required>
                                    </div>
                                </div>
                                <div class="col-md-3 ps-2">
                                    <label>Enter ID/Registration Number</label>
                                    <div class="input-group">
                                    <input type="text" class="form-control" placeholder="ID or Business Registration" id="id" name="id" <?php if(isset($_SESSION["register"]["id"])) echo 'value='.'"'.$_SESSION["register"]["id"].'"'?> aria-label="Last Name..." required>
                                    </div>
                                </div>
                                <div class="col-md-3 ps-2">
                                    <label id="usernamelable" name="usernamelable">Enter Email</label>
                                    <div class="input-group">
                                    <input type="email" class="form-control" placeholder="email address" id="username" name="username" <?php if(isset($_SESSION["register"]["username"])) echo 'value='.'"'.$_SESSION["register"]["username"].'"'?> onchange="checkusername(id, value)" aria-label="Last Name..." required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Upload KRA PIN Certificate</label>
                                    <div class="input-group mb-4">
                                        <input type="file" class="form-control" placeholder="" aria-label="Last Name..." required>
                                    </div>
                                </div>
                                <div class="col-md-3 ps-2">
                                    <label>Upload ID/Business Registration Certificate </label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" placeholder="" aria-label="Last Name..." required>
                                    </div>
                                </div>
                                <div class="col-md-3 ps-2">
                                    <label>Upload IRA Licence Certificate </label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="irafile" id="irafile" placeholder="" aria-label="Last Name..." required>
                                    </div>
                                </div>
                                <div class="col-md-3 ps-2">
                                    <label><div class>Submit</div> </label>
                                    <div class="input-group">
                                        <button type="submit" class="btn bg-gradient-dark w-100">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    
    
<?php
if(isset($_GET["status"])){
    if($_GET["status"] == "duplicate"){
        echo "<script> alert('User Exists')</script>";
    }
}
?>
    <!-- -------- END Content Presentation Docs ------- -->



    <!--   Core JS Files   -->
    <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>




    <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
    <script src="./assets/js/plugins/countup.min.js"></script>





    <script src="./assets/js/plugins/choices.min.js"></script>





    <script src="./assets/js/plugins/prism.min.js"></script>
    <script src="./assets/js/plugins/highlight.min.js"></script>





    <!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
    <script src="./assets/js/plugins/rellax.min.js"></script>
    <!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
    <script src="./assets/js/plugins/tilt.min.js"></script>
    <!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
    <script src="./assets/js/plugins/choices.min.js"></script>


    <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
    <script src="./assets/js/plugins/parallax.min.js"></script>








    <!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
    <!--  Google Maps Plugin    -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
    <script src="./assets/js/soft-design-system.min.js?v=1.0.8" type="text/javascript"></script>


    <script type="text/javascript">
        if (document.getElementById('state1')) {
            const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
            if (!countUp.error) {
                countUp.start();
            } else {
                console.error(countUp.error);
            }
        }
        if (document.getElementById('state2')) {
            const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
            if (!countUp1.error) {
                countUp1.start();
            } else {
                console.error(countUp1.error);
            }
        }
        if (document.getElementById('state3')) {
            const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
            if (!countUp2.error) {
                countUp2.start();
            } else {
                console.error(countUp2.error);
            };
        }
    </script>

    <script>
    function licence(id,value){
    if(id === "ira"){
      if(value.length <= 0){
        document.getElementById("code").readOnly = false;
      } else{
        document.getElementById("code").readOnly = true;
        var ira=/^[A-Za-z]{3}[\/]{1}[0-9]{2}[\/]{1}[0-9]{5}[\/]{1}[0-9]{4}$/g;
        if(!value.match(ira)){
          console.log("Not valid");
          document.getElementById(id).value = '';
          document.getElementById("code").readOnly = false;
          alert("Licence not valid")
        }else{
          console.log("Valid");
        }
      }
    }else if( id === "code"){
      if(value.length <= 0){
        document.getElementById("ira").readOnly = false;
        document.getElementById("irafile").disabled = false;
      } else{
        document.getElementById("ira").readOnly = true;
        document.getElementById("irafile").disabled = true;
        

      }
    }
  }
  </script>
    <!-- <script>
        var message = <?php echo $_GET["message"]; ?>;
        alert(message);
        console.log(message);

    </script> -->

<script type="text/javascript">
    function codeAddress() {
        message = "<?php echo $message; ?>";
        if (message){
            if (message == "email"){
                document.getElementById("usernamelable").innerHTML = "Phone Number";
                document.getElementById("username").placeholder = "Enter Phone Number";

                }

            }else{
                document.getElementById("usernamelable").innerHTML = "Email";
                document.getElementById("username").placeholder = "Email Address";
                
            }

    }
    function checkusername(id, value){
        var phoneregex=/^[0-9]{10}$/g;
        var emailregex= /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        if (message=="email"){
            console.log(message);
            if (!value.match(phoneregex)){
                document.getElementById("username").value = "";
                document.getElementById("username").placeholder = "Enter Phone Number";
            }
        }
        
        if(message=="phone"){
            console.log(message);
            if(!value.match(emailregex)){
                console.log("Not Email");
                document.getElementById("username").value = "";
                document.getElementById("username").placeholder = "Enter Valid Email";
            }
        }
    }
    window.onload = codeAddress;
</script>
</body>

</html>