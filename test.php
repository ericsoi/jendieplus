<form action="#" method="post" enctype="multipart/form-data">
  <input type="file" name="upcsv" accept=".csv" required/>
  <input type="submit" value="Upload"/>
</form>


<?php
    include "dashboard/db/connect_db.php";

  echo date("02/01/2022");
  // php function to convert csv to json format
$fname = $_FILES["upcsv"]["tmp_name"];
    // open csv file
  if (!($fp = fopen($fname, 'r',))) {
      die("Can't open file...");
  }
  
  //read csv headers
  $key = fgetcsv($fp,10000,",");
  $key = preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$key);
  $json = array();
  while ($row = fgetcsv($fp,10000,",")) {
    $obj= ((object)  (array_combine($key, $row)));
    $first_name=$obj->first_name; $middle_name=$obj->middle_name; $last_name=$obj->last_name; $id_number=$obj->id_number; $pin_number=$obj->pin_number; $phone_number=$obj->phone_number; $client_email=$obj->client_email; $gender=$obj->gender; $poastall_address=$obj->poastall_address; $policy_number=$obj->policy_number; $cover_from=date($obj->cover_from); $cover_to=date($obj->cover_to); $cert_from=date($obj->cert_from); $cert_to=date($obj->cert_to); $vehicle_reg=$obj->vehicle_reg; $chassis_number=$obj->chassis_number; $insurance_class=$obj->insurance_class; $cover_type=$obj->cover_type; $sum_insured=$obj->sum_insured; $gross_premium=$obj->gross_premium; $proof_of_payment=$obj->proof_of_payment; $method_of_payment=$obj->method_of_payment; $amount=$obj->amount; $certificate_number=$obj->certificate_number; $underwriter=$obj->underwriter; $seating_capacity=$obj->seating_capacity; $tonnage=$obj->tonnage; $optional_benefits=$obj->optional_benefits; 
    echo $first_name;
    echo "<br>";
    include "dashboard/db/connect_db.php";
    $insert = $pdo->prepare("INSERT INTO tbl_policy(first_name, middle_name, last_name, id_number, pin_number, phone_number, client_email, gender, poastall_address, policy_number, cover_from, cover_to, cert_from, cert_to, vehicle_reg, chassis_number, insurance_class, cover_type, sum_insured, gross_premium, proof_of_payment, method_of_payment, amount, certificate_number, underwriter, seating_capacity, tonnage, optional_benefits)
      values(:first_name,:middle_name,:last_name,:id_number,:pin_number,:phone_number,:client_email,:gender,:poastall_address,:policy_number,:cover_from,:cover_to,:cert_from,:cert_to,:vehicle_reg,:chassis_number,:insurance_class,:cover_type,:sum_insured,:gross_premium,:proof_of_payment,:method_of_payment,:amount,:certificate_number,:underwriter,:seating_capacity,:tonnage,:optional_benefits)");
      
      $insert->bindParam(':first_name',$first_name);
      $insert->bindParam(':middle_name',$middle_name);
      $insert->bindParam(':last_name',$last_name);
      $insert->bindParam(':id_number',$id_number);
      $insert->bindParam(':pin_number',$pin_number);
      $insert->bindParam(':phone_number',$phone_number);
      $insert->bindParam(':client_email',$client_email);
      $insert->bindParam(':gender',$gender);
      $insert->bindParam(':poastall_address',$poastall_address);
      $insert->bindParam(':policy_number',$policy_number);
      $insert->bindParam(':cover_from',$cover_from);
      $insert->bindParam(':cover_to',$cover_to);
      $insert->bindParam(':cert_from',$cert_from);
      $insert->bindParam(':cert_to',$cert_to);
      $insert->bindParam(':vehicle_reg',$vehicle_reg);
      $insert->bindParam(':chassis_number',$chassis_number);
      $insert->bindParam(':insurance_class',$insurance_class);
      $insert->bindParam(':cover_type',$cover_type);
      $insert->bindParam(':sum_insured',$sum_insured);
      $insert->bindParam(':gross_premium',$gross_premium);
      $insert->bindParam(':proof_of_payment',$proof_of_payment);
      $insert->bindParam(':method_of_payment',$method_of_payment);
      $insert->bindParam(':amount',$amount);
      $insert->bindParam(':certificate_number',$certificate_number);
      $insert->bindParam(':underwriter',$underwriter);
      $insert->bindParam(':seating_capacity',$seating_capacity);
      $insert->bindParam(':tonnage',$tonnage);
      $insert->bindParam(':optional_benefits',$optional_benefits);
      
      if($insert->execute()){
          echo "sucess";
      }else{
        print_r($insert->errorInfo());
      }
  }
  echo "done";
  fclose($fp);  
?>