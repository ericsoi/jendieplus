<?php
include '../db/connect_db.php';
session_start();
// print_r($_SESSION);
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

  function query($query){
    include '../db/connect_db.php';
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
  if(isset($_POST)){
    // $agency = $_POST["agency"];
    // $address = $_POST["address"];
    // $location = $_POST["location"];
    $phone = $_SESSION['phonenumber'];
    $email=$_POST["username"];
    // print_r($_POST);
    // $email=$_POST[""];
    //"SELECT * FROM tbl_user where role ='sub-agent' and agency = '$agency' ORDER BY time_created DESC"


    if ($_POST["ira"]){
        $ira=trim($_POST["ira"]);$id=trim($_POST["id"]);$kra=trim($_POST["kra"]);
        $results=query("SELECT * FROM tbl_user where iralicense = '$ira'");
        if ($results){
            echo'<script type="text/javascript">alert("Registration Failed, Licsence Already Registered") </script>';
            header ("Location: ../build/pages/update.php?status=duplicate");
        }else{
            $code=explode("/", $ira)[2];
            $location=trim($_POST["physicaladdress"]);
            $companyname=trim($_POST["agency"]);
            $ira=trim($_POST["ira"]);
            $role='agency';
            $agency=$code;
            $address=trim($_POST["postaladdress"]);
            $insert = $pdo->prepare("UPDATE tbl_user set physicaladdress='$location', companyname='$companyname', krapin='$kra', idnumber='$id', role='$role',iralicense='$ira', agency='$agency', code='$code', postaladdress='$address', is_active=0, emailaddress='$email' where phonenumber='$phone'");

            if($insert->execute()){
                echo'<script type="text/javascript">alert("Registration successful") </script>';
                header ("Location: ../build/pages/pending/pendingagency.php?q=".$phone);

            }else{
                echo'<script type="text/javascript">alert("Registration Error", "Internal Error. Try again later")</script>';
            }
        }
    }elseif($_POST["code"]){
        $agency=trim($_POST["code"]);$id=trim($_POST["id"]);
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

                $exists=query("SELECT * FROM tbl_user where agency = '$agency'and phonenumber='$phone' ORDER BY time_created DESC limit 1");
                if($exists){
                    echo'<script type="text/javascript">alert("Registration Error, Account Exists") </script>';
                    header ("Location: ../build/pages/update.php?status=duplicate");

                }else{

                    $insert = $pdo->prepare("UPDATE tbl_user set physicaladdress='$location', companyname='$companyname', krapin='$kra', idnumber='$id', role='$role',iralicense='$ira', agency='$agency', subagent='$subagent', code='$code', postaladdress='$address', is_active=0, emailaddress='$email' where phonenumber='$phone'");

                    if($insert->execute()){
                        echo'<script type="text/javascript">alert("Registration successful") </script>';
                        header ("Location: ../build/pages/pending/pendingsubagent.php?q=".$phone);

                    }else{
                        echo'<script type="text/javascript">alert("Registration Error, Internal Error. Try again later") </script>';
                        header ("Location: ../build/pages/update.php?status=error");
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
                    $exists=query("SELECT * FROM tbl_user where agency = '$agency'and phonenumber='$phone' ORDER BY time_created DESC limit 1");
                    if($exists){
                        echo'<script type="text/javascript">alert("Registration Error, Account Exists") </script>';
                        header ("Location: ../build/pages/update.php?status=duplicate");
                    }else{
                        $insert = $pdo->prepare("UPDATE tbl_user set physicaladdress='$location', companyname='$companyname', krapin='$kra', idnumber='$id', role='$role',iralicense='$ira', agency='$agency', subagent='$subagent', code='$code', postaladdress='$address', is_active=0, emailaddress='$email' where phonenumber='$phone'");
                        if($insert->execute()){
                            echo'<script type="text/javascript">alert("Registration successful") </script>';
                            header ("Location: ../build/pages/pending/pendingsubagent.php?q=".$phone);


                        }else{
                            echo'<script type="text/javascript">alert("Registration Error, Internal Error. Try again later") </script>';
                            header ("Location: ../build/pages/update.php?status=error");

                        }
                    }
                } else {
                    $code = '';
                    $companyname='';
                    $address='';
                    $location='';
                    $ira='';
                    echo'<script type="text/javascript">alert("Registration Error, Agent code does not exist") </script>';
                    header ("Location: ../build/pages/update.php?status=nonexistent");

                }
           }
        }elseif(preg_match($subagent_regex, $agency)){
            $subagent=trim($_POST["code"]);$id=trim($_POST["id"]);
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
                $exists=query("SELECT * FROM tbl_user where agency = '$agency'and phonenumber='$phone' ORDER BY time_created DESC limit 1");
                if($exists){
                    echo'<script type="text/javascript">alert("Registration Error, Account Exists") </script>';
                    header ("Location: ../build/pages/update.php?status=duplicate");

                }else{
                    $insert = $pdo->prepare("UPDATE tbl_user set physicaladdress='$location', companyname='$companyname', krapin='$kra', idnumber='$id', role='$role',iralicense='$ira', agency='$agency', subagent='$subagent', code='$code', postaladdress='$address', is_active=0, emailaddress='$email' where phonenumber='$phone'");
                    if($insert->execute()){
                        echo'<script type="text/javascript">alert("Registration successful") </script>';
                        header ("Location: ../build/pages/pending/pendingoperator.php?q=".$phone);
                    }else{
                        echo'<script type="text/javascript">alert("Registration Error, Internal Error. Try again later") </script>';
                        header ("Location: ../build/pages/update.php?status=error");
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
                    $exists=query("SELECT * FROM tbl_user where agency = '$agency'and phonenumber='$phone' ORDER BY time_created DESC limit 1");
                    if($exists){
                        echo'<script type="text/javascript">alert("Registration Error, Account Exists") </script>';
                        header ("Location: ../build/pages/update.php?status=duplicate");
                    }else{
                        $insert = $pdo->prepare("UPDATE tbl_user set physicaladdress='$location', companyname='$companyname', krapin='$kra', idnumber='$id', role='$role',iralicense='$ira', agency='$agency', subagent='$subagent', code='$code', postaladdress='$address', is_active=0, emailaddress='$email' where phonenumber='$phone'");
                        if($insert->execute()){
                            echo'<script type="text/javascript">alert("Registration successful") </script>';
                            header ("Location: ../build/pages/pending/pendingoperator.php?q=".$phone);

                        }else{
                            echo'<script type="text/javascript">alert("Registration Error, Internal Error. Try again later") </script>';
                            header ("Location: ../build/pages/update.php?status=error");
                        }
                    }
                } else{
                    $code = '';
                    $companyname='';
                    $address='';
                    $location='';
                    $ira='';
                    echo'<script type="text/javascript">alert("Registration Error, Agent code does not exist") </script>';
                    header ("Location: ../build/pages/update.php?status=nonexistent");

                }
            }
        }else{
            $code = '';
            $companyname='';
            $address='';
            $location='';
            $ira='';
            echo'<script type="text/javascript">alert("Registration Error, Invalid Agent Code") </script>';
            header ("Location: ../build/pages/update.php?status=invalid");

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