<?php
  if (session_status() == PHP_SESSION_NONE) {
        session_start();
  }
    include "../db/connect_db.php";
    $_POST = array_map('trim', $_POST);$linksArray=$_POST;$unique='';
    $linksArray["underwriter"]=explode('#', $linksArray["underwriter"])[0];
    $productCodeLink=$linksArray;
    $unique="-".$_SESSION["agency"];
    foreach($linksArray as $key => $link){ 
        if($link === '' || $key=='description' || $key=='policy'  || $key=="weeklyrates" || $key=="fortnightrates" || $key=="monthlyrates" || $key=="annualrates" || $key=="excludedvehicles" || $key=="minimumpremium") {
            unset($linksArray[$key]); 
        } else{
            $unique.='-'.$link;
        }
    }
    $product_unique="-".$_SESSION["agency"];
    foreach($productCodeLink as $key => $link){ 
        if($link == '' ||$key=='description' || $key=='policy' || $key=='maxtonnage' || $key=='mintonnage' || $key=='maxage' || $key=='minage' || $key=='maxsum' || $key=='minsum' || $key=='passangers' || $key=='weeklyrates' || $key=='fortnightrates' || $key=='monthlyrates' || $key=='annualrates' || $key=='minimumpremium' || $key=='excludedvehicles') {
            unset($productCodeLink[$key]); 
        } else{
            $product_unique.='-'.$link;
        }
    }
    // print_r($_POST);
    //-32121-africamerchantassurancecompanylimited-1.private-comprehensive-20-16-10000000-500000
    //-32121-africamerchantassurancecompanylimited-1.private-comprehensive-15-0-10000000-500000
    echo $unique."<br>";
    echo $product_unique;
    $product_code=strtolower(preg_replace('/\s+/', '',$product_unique));
    $unique=strtolower(preg_replace('/\s+/', '', $unique));
    echo '<br>'. $unique."<br>";
    $uniqueidentifier = $unique; $vehicleclass = $_POST["vehicleclass"]; $underwriter = $linksArray["underwriter"]; $coverage = $_POST["coverage"]; $description = $_POST["description"]; $policylimits = $_POST["policy"]; $mintonnage = $_POST["mintonnage"]; $maxtonnage = $_POST["maxtonnage"]; $weeklyrates = $_POST["weeklyrates"]; $fortnightrates = $_POST["fortnightrates"]; $passangers = $_POST["passangers"]; $monthlyrates = $_POST["monthlyrates"]; $annualrates = $_POST["annualrates"]; $excludedvehicles = $_POST["excludedvehicles"]; $minimumpremium = $_POST["minimumpremium"]; $maxage = $_POST["maxage"]; $minage = $_POST["minage"]; $maxsum = $_POST["maxsum"]; $minsum = $_POST["minsum"];$owner=$_SESSION["agency"];
    $select = $pdo->prepare("SELECT uniqueidentifier FROM tbl_product WHERE uniqueidentifier='$uniqueidentifier'");
    $select->execute();
    echo "mintonnage". $mintonnage;
    echo "maxtonnage". $maxtonnage;
    if($select->rowCount() > 0 ){
        print_r("ERROR");
        header("Location: ../build/pages/productsetup.php?q=duplicate");
    }else{
        $insert = $pdo->prepare("INSERT INTO tbl_product(product_code,vehicleclass, underwriter, coverage, description, policylimits, mintonnage, maxtonnage, weeklyrates, fortnightrates, passangers, monthlyrates, annualrates, excludedvehicles, minimumpremium, maxage, minage, maxsum, minsum, owner, uniqueidentifier)
                    values(:product_code,:vehicleclass,:underwriter,:coverage,:description,:policylimits,:mintonnage,:maxtonnage,:weeklyrates,:fortnightrates,:passangers,:monthlyrates,:annualrates,:excludedvehicles,:minimumpremium,:maxage,:minage,:maxsum,:minsum,:owner,:uniqueidentifier)");
                    
                    $insert->bindParam(':product_code', $product_code);
                    $insert->bindParam(':vehicleclass', $vehicleclass);
                    $insert->bindParam(':underwriter', $underwriter);
                    $insert->bindParam(':coverage', $coverage);
                    $insert->bindParam(':description', $description);
                    $insert->bindParam(':policylimits', $policylimits);
                    $insert->bindParam(':mintonnage', $mintonnage);
                    $insert->bindParam(':maxtonnage', $maxtonnage);
                    $insert->bindParam(':weeklyrates', $weeklyrates);
                    $insert->bindParam(':fortnightrates', $fortnightrates);
                    $insert->bindParam(':passangers', $passangers);
                    $insert->bindParam(':monthlyrates', $monthlyrates);
                    $insert->bindParam(':annualrates', $annualrates);
                    $insert->bindParam(':excludedvehicles', $excludedvehicles);
                    $insert->bindParam(':minimumpremium', $minimumpremium);
                    $insert->bindParam(':maxage', $maxage);
                    $insert->bindParam(':minage', $minage);
                    $insert->bindParam(':maxsum', $maxsum);
                    $insert->bindParam(':minsum', $minsum);
                    $insert->bindParam(':owner', $owner);
                    $insert->bindParam(':uniqueidentifier', $uniqueidentifier);
                    // if($insert->execute()){
                    //     1==1;
                    if($insert->execute()){
                        header("Location: ../build/pages/productsetup.php?q=success");
                    }else{
                        print_r($insert->errorInfo()[2]);
                        header("Location: ../build/pages/productsetup.php?q=error");
                    }
            // }

    }
?>



