<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE); 

  session_start();
  include_once'inc/header_all_register.php';
  include 'db/connect_db.php';
  if(isset($_GET["status"])){
    $message = $_GET["status"];
    if($message == "duplicate"){
      echo'<script type="text/javascript">
        jQuery(function validation(){
        swal("Registration Error", "The Agency Is registered Check your IRA number", "error", {
        button: "Continue",
          }).then(function() {
            window.location = "update.php";
          });
        });
      </script>';
    } elseif($message == "success"){
      echo'<script type="text/javascript">
      jQuery(function validation(){
      swal("Success", "Wait for account verification", "success", {
      button: "Continue",
        });
      });
    </script>';
    }
  }
  function query($query){
    include 'db/connect_db.php';
    $select=$pdo->prepare($query);
    $select->execute();
    $total_records = $select->rowCount();

    if($total_records > 0){
        $row=$select->fetch(PDO::FETCH_OBJ); 
        return $row;
    }else{
        return false;
    }
}

function nextuser($str, $position){
    $code=explode("/", $str)[0];
    $no=explode("/", $str)[$position] + 1;
    if($position == 1){
        $result= $code . "/" . $no;
    }elseif($position == 2){
        $nd= explode("/", $str)[1];
        $result= $code . "/" .$nd."/". $no;
    }elseif($position == 0){
      $result= $code . "/" . "0";
    }
    return $result;
  }

  if(isset($_POST)){
    // $agency = $_POST["agency"];
    // $address = $_POST["address"];
    // $location = $_POST["location"];
    $firstname = $_SESSION['register']['firstname'];
    $lastname = $_SESSION['register']['lastname'];
    $email = $_SESSION['register']['email'];
    $phone = $_SESSION['register']['phone'];
    //"SELECT * FROM tbl_user where role ='sub-agent' and agency = '$agency' ORDER BY time_created DESC"


    if ($_POST["ira"]){
        $ira=trim($_POST["ira"]);
        $results=query("SELECT * FROM tbl_user where iralicense = '$ira'");
        if ($results){
            $code = '';
            $companyname='';
            $address='';
            $location='';
            $ira='';
            echo'<script type="text/javascript">
                            jQuery(function validation(){
                                swal("Registration Failed", "Licsence Already Registered", "error", {
                                    button: "Continue",
                                    }).then(function() {
                                        window.location = "update.php";
                                    });
                                });
                    </script>';
        }else{
            $code=explode("/", $ira)[2];
            $companyname =$_POST["agency"];
            $location=trim($_POST["location"]);
            $companyname=trim($_POST["agency"]);
            $ira=trim($_POST["ira"]);
            $role='agency';
            $agency=$code;
            $address=trim($_POST["address"]);
            $insert = $pdo->prepare("UPDATE tbl_user set physicaladdress='$location', companyname='$companyname', krapin='$ira', idnumber='$ira', role='$role',iralicense='$ira', agency='$agency', code='$code', postaladdress='$address', is_active=0 where emailaddress = '$email' and phonenumber='$phone'");

            if($insert->execute()){
                echo'<script type="text/javascript">
                        jQuery(function validation(){
                            swal("Registration successful", "success", "success", {
                                button: "Continue",
                        });
                    });
                </script>';
            }else{
                echo'<script type="text/javascript">
                        jQuery(function validation(){
                            swal("Registration Error", "Internal Error. Try again later", "error", {
                                button: "Continue",
                                }).then(function() {
                                    window.location = "update.php";
                                });
                            });
                    </script>';
            }
        }
    }elseif($_POST["code"]){
        $agency=trim($_POST["code"]);
        // $ira_pattern = "([A-Z]{3}[/][0-9]{2}[/][0-9]{5}[/][0-9]{4}$)";
        $agency_regex = "(^[0-9]{5}$)";
        $subagent_regex = "(^[0-9]{5}[/][0-9]+$)";
        // $operator = "(^[0-9]{5}[/][0-9]+[/][0-9]+$)";
        if (preg_match($agency_regex, $agency)){
            $results=query("SELECT * FROM tbl_user where role ='sub-agent' and agency = '$agency' ORDER BY time_created DESC limit 1");
            if ($results){
                $code = nextuser($results->code, 1);
                $companyname=$results->companyname;
                $address=$results->postaladdress;
                $location=$results->physicaladdress;
                $ira=$results->iralicense;
                $subagent=$code;
                $agency=$results->agency;
                $role=$results->role;

                $exists=query("SELECT * FROM tbl_user where agency = '$agency' and emailaddress = '$email' and phonenumber='$phone' ORDER BY time_created DESC limit 1");
                if($exists){
                    echo'<script type="text/javascript">
                        jQuery(function validation(){
                            swal("Registration Error", "Account Exists", "error", {
                                button: "Continue",
                            }).then(function() {
                                window.location = "update.php";
                            });
                        });
                        </script>';
                }else{

                    $insert = $pdo->prepare("UPDATE tbl_user set physicaladdress='$location', companyname='$companyname', krapin='$ira', idnumber='$ira', role='$role',iralicense='$ira', agency='$agency', subagent='$subagent', code='$code', postaladdress='$address', is_active=0 where emailaddress = '$email' and phonenumber='$phone'");

                    if($insert->execute()){
                        echo'<script type="text/javascript">
                                jQuery(function validation(){
                                    swal("Registration successful", "success", "success", {
                                        button: "Continue",
                                });
                            });
                        </script>';
                    }else{
                        echo'<script type="text/javascript">
                                jQuery(function validation(){
                                    swal("Registration Error", "Internal Error. Try again later", "error", {
                                        button: "Continue",
                                        }).then(function() {
                                            window.location = "update.php";
                                        });
                                    });
                            </script>';
                    }
                }
            }else{
                $results=query("SELECT * FROM tbl_user where agency = '$agency' ORDER BY time_created DESC limit 1");
                if($results){
                    $code = nextuser($results->agency, 0);
                    $companyname=$results->companyname;
                    $address=$results->postaladdress;
                    $location=$results->physicaladdress;
                    $ira=$results->iralicense;
                    $subagent=$code;
                    $agency=$results->agency;
                    $role='sub-agent';
                    $exists=query("SELECT * FROM tbl_user where agency = '$agency' and emailaddress = '$email' and phonenumber='$phone' ORDER BY time_created DESC limit 1");
                    if($exists){
                        echo'<script type="text/javascript">
                            jQuery(function validation(){
                                swal("Registration Error", "Account Exists", "error", {
                                    button: "Continue",
                                }).then(function() {
                                    window.location = "update.php";
                                });
                            });
                            </script>';
                    }else{
                        $insert = $pdo->prepare("UPDATE tbl_user set physicaladdress='$location', companyname='$companyname', krapin='$ira', idnumber='$ira', role='$role',iralicense='$ira', agency='$agency', subagent='$subagent', code='$code', postaladdress='$address', is_active=0 where emailaddress = '$email' and phonenumber='$phone'");
                        if($insert->execute()){
                            echo'<script type="text/javascript">
                                jQuery(function validation(){
                                    swal("Registration successful", "success", "success", {
                                        button: "Continue",
                                    });
                                });
                                </script>';
                        }else{
                            echo'<script type="text/javascript">
                                jQuery(function validation(){
                                    swal("Registration Error", "Internal Error. Try again later", "error", {
                                        button: "Continue",
                                    }).then(function() {
                                        window.location = "update.php";
                                    });
                                });
                                </script>';
                        }
                    }
                } else {
                    $code = '';
                    $companyname='';
                    $address='';
                    $location='';
                    $ira='';
                    echo'<script type="text/javascript">
                        jQuery(function validation(){
                            swal("Registration Error", "Agent code does not exist", "error", {
                                button: "Continue",
                            }).then(function() {
                                window.location = "update.php";
                            });
                        });
                    </script>';
                }
           }
        }elseif(preg_match($subagent_regex, $agency)){
            $subagent=trim($_POST["code"]);
            $results=query("SELECT * FROM tbl_user where role ='operator' and subagent = '$subagent' ORDER BY time_created DESC LIMIT 1");
            if ($results){
                $code = nextuser($results->code, 2);
                $companyname=$results->companyname;
                $agency=$results->agency;
                $address=$results->postaladdress;
                $location=$results->physicaladdress;
                $ira=$results->iralicense;
                $subagent=$results->subagent;
                $role='operator';
                $exists=query("SELECT * FROM tbl_user where agency = '$agency' and emailaddress = '$email' and phonenumber='$phone' ORDER BY time_created DESC limit 1");
                if($exists){
                    echo'<script type="text/javascript">
                        jQuery(function validation(){
                            swal("Registration Error", "Account Exists", "error", {
                                button: "Continue",
                            }).then(function() {
                                window.location = "update.php";
                            });
                        });
                        </script>';
                }else{
                    $insert = $pdo->prepare("UPDATE tbl_user set physicaladdress='$location', companyname='$companyname', krapin='$ira', idnumber='$ira', role='$role',iralicense='$ira', agency='$agency', subagent='$subagent', code='$code', postaladdress='$address', is_active=0 where emailaddress = '$email' and phonenumber='$phone'");
                    if($insert->execute()){
                        echo'<script type="text/javascript">
                            jQuery(function validation(){
                                swal("Registration successful", "success", "success", {
                                    button: "Continue",
                                });
                            });
                        </script>';
                    }else{
                        echo'<script type="text/javascript">
                            jQuery(function validation(){
                                swal("Registration Error", "Internal Error. Try again later", "error", {
                                    button: "Continue",
                                }).then(function() {
                                    window.location = "update.php";
                                });
                            });
                    </script>';
                    }
                }
            } else {
                $results=query("SELECT * FROM tbl_user where role ='sub-agent' and subagent = '$subagent' ORDER BY time_created DESC LIMIT 1");
                if ($results){
                    $code = nextuser($results->code, 2);
                    $companyname=$results->companyname;
                    $agency=$results->agency;
                    $address=$results->postaladdress;
                    $location=$results->physicaladdress;
                    $ira=$results->iralicense;
                    $subagent=$results->subagent;
                    $role='operator';
                    $exists=query("SELECT * FROM tbl_user where agency = '$agency' and emailaddress = '$email' and phonenumber='$phone' ORDER BY time_created DESC limit 1");
                    if($exists){
                        echo'<script type="text/javascript">
                            jQuery(function validation(){
                                swal("Registration Error", "Account Exists", "error", {
                                    button: "Continue",
                                }).then(function() {
                                    window.location = "update.php";
                                });
                            });
                            </script>';
                    }else{
                        $insert = $pdo->prepare("UPDATE tbl_user set physicaladdress='$location', companyname='$companyname', krapin='$ira', idnumber='$ira', role='$role',iralicense='$ira', agency='$agency', subagent='$subagent', code='$code', postaladdress='$address', is_active=0 where emailaddress = '$email' and phonenumber='$phone'");
                        if($insert->execute()){
                            echo'<script type="text/javascript">
                                jQuery(function validation(){
                                    swal("Registration successful", "success", "success", {
                                        button: "Continue",
                                    });
                                });
                            </script>';
                        }else{
                            echo'<script type="text/javascript">
                                jQuery(function validation(){
                                    swal("Registration Error", "Internal Error. Try again later", "error", {
                                        button: "Continue",
                                    }).then(function() {
                                        window.location = "update.php";
                                    });
                                });
                        </script>';
                        }
                    }
                } else{
                    $code = '';
                    $companyname='';
                    $address='';
                    $location='';
                    $ira='';
                    echo'<script type="text/javascript">
                        jQuery(function validation(){
                            swal("Registration Error", "Agent code does not exist", "error", {
                                button: "Continue",
                            }).then(function() {
                                window.location = "update.php";
                            });
                        });
                </script>';
                }
            }
        }else{
            $code = '';
            $companyname='';
            $address='';
            $location='';
            $ira='';
            echo'<script type="text/javascript">
                jQuery(function validation(){
                    swal("Registration Error", "Invalid Agent Code", "error", {
                        button: "Continue",
                    }).then(function() {
                        window.location = "update.php";
                    });
                });
        </script>';
        }
        
    }
}  if(isset($_GET["user"])){
    $code = $_GET["user"];
    $results=query("SELECT * FROM tbl_user where code ='$code' ORDER BY time_created DESC limit 1");
    if ($results){
        $companyname=$results->companyname;
        $agency=$results->agency;
        $address=$results->postaladdress;
        $location=$results->physicaladdress;
        $ira=$results->iralicense;
        $subagent=$results->subagent;
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
                    <h3>Account Pending  Verification</h3>
                    <p class="alert alert-warning">
                        Please Wait Patiently as we verify your account. Our operator will revert ASAP. For more information, email support@jendieplus.co.ke or call 0722301062.

                    </p>
                    <div>
                        <div id="message-contact"></div>
                        <form method="post" action="#" id="contactform">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control styled" id="agency" name="agency" value="<?php echo $companyname?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Postal Address</label>
                                        <input type="text" class="form-control styled" id="address" name="address" value="<?php echo $address?>" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input type="text" class="form-control styled" id="location" name="location" value="<?php echo $location?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">

                                  <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>IRA Licence Number</label>
                                        <input type="text" class="form-control styled" id="ira" name="ira"  value="<?php echo $ira?>" disabled>
                                    </div>
                                  </div>

                                  <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Agent Code</label>
                                        <input type="text" class="form-control styled" id="code" name="code"  value="<?php echo $code?>" disabled>
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
  <script>
  $(document).ready( function () {
      $('#myCategory').DataTable();
  } );
  </script>

<?php
  include_once'inc/footer_all.php';
?>