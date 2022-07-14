<?php
  session_start();
  include_once'inc/header_all_register.php';
  if(isset($_GET["status"])){
    $message = $_GET["status"];
    if($message == "error"){
      echo'<script type="text/javascript">
        jQuery(function validation(){
        swal("Registration successful", "An error occured. Try again latter", "error", {
        button: "Continue",
          }).then(function() {
            window.location = "register.php";
          });
        });
      </script>';
    } elseif($message == "success"){
      echo'<script type="text/javascript">
      jQuery(function validation(){
      swal("Almost There", "Please complete details to continue", "success", {
      button: "Continue",
        });
      });
    </script>';
    }
  }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
       <!-- Category Form-->
      <div class="col-md-12">
            <div class="box box-success">

                 <div class="col-md-12">
                    <h3>Complete Your Registration</h3>
                    <p>
                        Enter the following details to complete you account.
                    </p>
                    <div>
                        <div id="message-contact"></div>
                        <form method="post" action="pending.php" id="contactform">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control styled" id="agency" name="agency" placeholder="Agency Name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Postal Address</label>
                                        <input type="text" class="form-control styled" id="address" name="address" placeholder="PO BOX">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input type="text" class="form-control styled" id="location" name="location" placeholder="Your Location">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">

                                  <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>IRA Licence Number</label>
                                        <input type="text" class="form-control styled" id="ira" name="ira" onchange="licence(this.id, this.value)" placeholder="Your IRA Licence Number">
                                    </div>
                                  </div>

                                  <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Agent Code</label>
                                        <input type="text" class="form-control styled" id="code" name="code" onchange="licence(this.id, this.value)" placeholder="Your Agent Code">
                                    </div>
                                  </div>

                                </div>

                            </div>

                            <!-- <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control styled" id="password" name="password" placeholder="Your Password">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Re-enter Your Password</label>
                                        <input type="text" class="form-control styled" id="password2" name="password2" placeholder="Re-type your password">
                                    </div>
                                </div>

                            </div> -->

                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label>Upload KRA PIN </label>
                                        <input type="file" class="form-control" name="krafile" id="krafile" placeholder="Upload KRA PIN Copy">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label>Upload ID/Registration Certificate</label>
                                        <input type="file" class="form-control" name="idfile" id="idfile" placeholder="Upload ID Copy">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label>Upload IRA Licence </label>
                                        <input type="file" class="form-control" name="irafile" id="irafile" placeholder="Upload Licence Copy">
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6">

                                    <p>
                                        <input type="submit" value="Submit" class="btn_1" id="submit-contact">
                                        <input type="reset" value="Reset">
                                    </p>
                                    <!-- <p>Have an account? <a href="login.html">Login</a></p> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      </div>
        <!-- Category Table -->
      


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- DataTables Function -->
  <script type="text/javascript">
  function myFunction() {
		var x = document.getElementById("mySelect1");
		var text=x.options[x.selectedIndex].text;
		console.log(text);
    if ((text == "POLITICAL_VIOLENCE_AND_TERRORISM") || (text == "EXCESS_PROTECTOR")){
      document.getElementById("entity").innerHTML = '<div class="form-group" id="value">\
        <input type="number" class="form-control styled text-center" id="premium" name="benefit_value" placeholder="Enter Premium" required>\
      </div>';
      document.getElementById("rater").innerHTML = '<div class="form-group" id="rate">\
        <input type="number" type="number" min="1" max="100" class="form-control styled text-center" id="rate" name="benefit_rate" placeholder="Enter Rate" required>\
      </div>';
    }else if(text == "AA_ROAD_RESQUE" || text == "INFAMA_ROAD_RESQUE" || text == "AMREF" || text == "BIMALIFE" || text == "PERSONAL_ACCIDENT"){
      document.getElementById("entity").innerHTML = '<div class="form-group" id="value">\
        <input type="number" class="form-control styled text-center" id="premium" name="benefit_value" placeholder="Enter Value" required>\
      </div>';
      document.getElementById("rater").innerHTML ="";
    }else{
      document.getElementById("entity").innerHTML = '<div class="form-group" id="value">\
        <input type="number" class="form-control styled text-center" id="premium" name="benefit_value" placeholder="Enter Free Limit" required>\
      </div>';
      document.getElementById("rater").innerHTML = '<div class="form-group" id="rate">\
        <input type="number"  type="number" min="1" max="100" class="form-control styled text-center" id="rate" name="benefit_rate" placeholder="Enter Free Limit Rate" required>\
      </div>';
    }
  }
  function licence(id,value){
    if(id === "ira"){
      if(value.length <= 0){
        document.getElementById("code").readOnly = false;
      } else{
        document.getElementById("code").readOnly = true;
        var ira=/^[A-Za-z]{3}[\/]{1}[0-9]{2}[\/]{1}[0-9]{5}[\/]{1}[0-9]{4}$/g;
        if(!value.match(ira)){
          console.log("Not valid");
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
<script type="text/javascript">
    function codeAddress() {
        alert('ok');
    }
    window.onload = codeAddress;
</script>
  <script>
    var html = $('html')
    alert(html);
  </script>
  <script>
  $(document).ready( function () {
      $('#myCategory').DataTable();
  } );
  </script>

<?php
  include_once'inc/footer_all.php';
?>