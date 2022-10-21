<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["username"])){
    $phone= $_SESSION["username"];
    include "../../db/connect_db.php";
    include "functions/select.php";
    $user=selectuser("SELECT * FROM tbl_user WHERE phonenumber='$phone'");
    if($user){
        $user_info=$user;
        if($user_info->role == "admin" && $user_info->is_active==1){
            include "nav/headeradmin.php";
        }elseif($user_info->role == "agency" && $user_info->is_active==1){
            include "nav/headeragency.php";
        }elseif($user_info->role == "sub-agent" && $user_info->is_active==1){
            include "nav/headersubagent.php";
        }elseif($user_info->role == "operator" && $user_info->is_active==1){
            include "nav/headersoperator.php";
        }else{
            header ("Location: ./misc/logout.php");
        }
    }else{
        header ("Location: ./misc/logout.php");
    }
}else{
    header ("Location: ./misc/logout.php");
}
   if(isset($_GET["q"])){
        if($_GET["q"] =="duplicate"){
            echo "<script>alert('duplicate')</script>";
        }
        if($_GET["q"] =="success"){
            echo "<script>alert('success')</script>";
        }
        if($_GET["q"] =="error"){
            echo "<script>alert('error')</script>";
        }
   }
  ?>
          <div class="w-full p-6 mx-auto">
            <h4>Product Setup</h4>
          </div>
          <div class="flex-none w-1/2 max-w-full px-3 text-right">
                                <a class="inline-block px-6 py-3 font-bold text-right text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-size-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-dark-gray hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25"
                                    href="../pages/products.php">  </i>&nbsp;&nbsp;Back  </a>
                            </div>
          <form action="../../processor/handle_product_setup.php" method="POST" role="form text-left">
            <div class="w-full p-6 mx-auto">
              <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-6 xl:w-4/12">
                  <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">        
                    <div class="flex-auto p-4">
                          <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Underwriter</label>
                          <div class="mb-4">
                          <select id="underwriter" name="underwriter" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" onchange="handledescription(this)">
                                <?php
                                $i=0;
                                $select = $pdo->prepare("SELECT * FROM tbl_underwriter");
                                $select->execute();
                                while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                    extract($row);
                                    $row = array_map('trim', $row);
                                    $i++;
                                ?>
                                    <option value="<?php echo $row['Name']."... ".$row["description"]?>"><?php echo $i.".  ".$row['Name']; ?></option>
                                <?php
                                  }
                                ?>
                            </select>
                            
                          </div>
                          <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Risk</label>
                          <div class="mb-4">
                            <select class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" name="vehicleclass" id="vehicleclass" onchange="vehicleSelect(this)">
                              <optgroup label="1. MOTORCYCLE">
                                    <?php
                                    $select = $pdo->prepare("SELECT * FROM tbl_vehicleclass where type = 'MOTORCYCLE'");
                                    $select->execute();
                                    while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                        extract($row);
                                        $row = array_map('trim', $row);
                                    ?>
                                        <option><?php echo $row["ID"].".  ".$row["class"] ?></option>
                                        
                                    <?php
                                        }
                                    ?>
                                </optgroup>
                                <optgroup label="2. TRICYCLE">
                                    <?php
                                    $select = $pdo->prepare("SELECT * FROM tbl_vehicleclass where type = 'TRICYCLE'");
                                    $select->execute();
                                    while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                        extract($row);
                                        $row = array_map('trim', $row);
                                    ?>  
                                        <option><?php echo $row["ID"].".  ".$row["class"] ?></option>
                                    <?php
                                        }
                                    ?>
                                </optgroup>
                                <optgroup label="3. MOTORVEHICLE">
                                    <?php
                                    $select = $pdo->prepare("SELECT * FROM tbl_vehicleclass where type = 'MOTORVEHICLE'");
                                    $select->execute();
                                    while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                        extract($row);
                                        $row = array_map('trim', $row);

                                    ?>
                                        <option><?php echo $row["ID"].".  ".$row["class"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </optgroup>
                            </select>
                          </div>
                          <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Coverage</label>
                          <div class="mb-4">
                            <select class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" name="coverage" id="coverage" onchange="vehicleSelect(this)">
                                <?php
                                $select = $pdo->prepare("SELECT * FROM tbl_coverage");
                                $select->execute();
                                while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                    extract($row);
                                    $row = array_map('trim', $row);

                                ?>
                                    <option><?php echo $row['cover']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                          </div>
                          <div class="mb-4">
                          </div>
                          <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Underwriter Description</label>
                          <div class="mb-4">
                              <textarea name="description" id="description" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white sm-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="message" rows="4"></textarea>
                          </div>
                          <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">About Policy</label>
                          <div class="mb-4">
                              <textarea name="policy" id="policy" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white sm-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" id="message" rows="4"></textarea>
                          </div>
                    </div>
                  </div>
                </div>
                <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-4/12 ">
                  <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border ">
                    <div class="flex-auto p-4">
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Maximum Tonnage</label>
                      <div class="mb-4">
                          <input type="number" name="maxtonnage" id="maxtonnage" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Maximum Tonnage" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Minimum Tonnage</label>
                      <div class="mb-4">
                          <input type="number" name="mintonnage" id="mintonnage" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Minimum Tonnage" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Maximum Age</label>
                      <div class="mb-4">
                          <input type="number" name="maxage" id="maxage" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Maximum Age" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Minimum Age</label>
                      <div class="mb-4">
                          <input type="number" name="minage" id="minage" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Minimum Age" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Maximum sum insured</label>
                      <div class="mb-4">
                          <input type="number" name="maxsum" id="maxsum" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Maximum sum insured" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Minimum sun insured</label>
                      <div class="mb-4">
                          <input type="number" name="minsum" id="minsum" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Minimum sun insured" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Number of passengers</label>
                      <div class="mb-4">
                          <input type="number" name="passangers" id="passangers" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Number of Passangers" aria-label="Password" aria-describedby="password-addon" />
                      </div>
  
                    </div>
                  </div>
                </div>
                <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-4/12 ">
                  <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border ">
                    <div class="flex-auto p-4">
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Weekly rate</label>
                      <div class="mb-4">
                          <input type="number" name="weeklyrates" id="weeklyrates" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Weekly Rates" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Fortnight rate</label>
                      <div class="mb-4">
                          <input type="number"  name="fortnightrates" id="fortnightrates" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Fort Night Rates" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Monthly rate</label>
                      <div class="mb-4">
                          <input type="number"  name="monthlyrates" id="monthlyrates"  class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Monthly Rates" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Annual rates</label>
                      <div class="mb-4">
                          <input type="number" step="any" name="annualrates" id="annualrates" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Annual Rates" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Minimum premium</label>
                      <div class="mb-4">
                          <input type="number" name="minimumpremium" id="minimumpremium" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Risk" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Excluded vehicles</label>
                      <div class="mb-4">
                          <input type="text"  name="excludedvehicles" id="excludedvehicles" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                              placeholder="Excluded Vehicles" aria-label="Password" aria-describedby="password-addon" />
                      </div>
                      <div class="text-center">
                            <button type="submit" name="btn_submit" class="inline-block w-full bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Create</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_preview').attr('src', e.target.result)
                .width(250)
                .height(200);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function handledescription(input){
      document.getElementById("description").value=input.value;
    }
    function vehicleSelect(input) {
        var coverage=document.getElementById("coverage").value.trim().replace(/\s/g, '').toLowerCase();
        var vehicleclass=document.getElementById("vehicleclass").value.trim().replace(/\s/g, '').toLowerCase();
        var motorcycleThirdParty=["1.private","2.psv(bodaboda)","3.commercial","4.commercialowngoods","10.chauffeurdriven"];
        var tricyclepsv=["5.psv(tuktuk)", "11.motortrade", "12.institutionalvehicles", "13.drivingschoolvehicle", "14.tourservicevehicles", "16.psv-taxi","18.ambulanceandfirefighters","19.forklift,crane,rollersandexcavators","20.uber"];
        var motorVehicleThirdParty=["6.private"];
        var motorVehicleComercial=["7.commercialowngoods","8.generalcartagelorries,trucksandtankers","9.agriculturalandforestryvehicles"];
        var motorVehicleChaufer=["10.chauffeurdriven"];
        var matatuPsv=["15.psv-matatu", "17.psv-bus"];
        var motorTanker=["21.tanker(liquidcarrying)"];
        var motorComprehensive=["1.private","2.psv(bodaboda)","3.commercial", "4.commercialowngoods","5.psv(tuktuk)"];
        var motorVehicleComprehensivePrivate=["6.private"];
        if (motorcycleThirdParty.includes(vehicleclass) && coverage=="thirdpartyonly"){
            hidden=["monthlyrates", "minage", "mintonnage", "maxtonnage", "maxage", "maxsum", "minsum", "passangers", "fortnightrates", "excludedvehicles", "weeklyrates","minimumpremium"];
            unhidden=["annualrates"];
            unhide(unhidden, hidden);
        }
        if(tricyclepsv.includes(vehicleclass) && coverage=="thirdpartyonly"){
            hidden=["minage", "mintonnage", "maxtonnage", "maxage", "maxsum", "minsum", "passangers", "fortnightrates", "excludedvehicles", "weeklyrates","minimumpremium"];
            unhidden=["monthlyrates","annualrates"];
            unhide(unhidden, hidden);
        }
        if (motorVehicleThirdParty.includes(vehicleclass) && coverage=="thirdpartyonly"){
            hidden=["minage", "mintonnage", "maxtonnage", "maxage", "maxsum", "minsum", "passangers", "fortnightrates", "excludedvehicles", "weeklyrates","minimumpremium"];
            unhidden=["monthlyrates","annualrates", "weeklyrates",];
            unhide(unhidden, hidden);
        }
        if (motorVehicleComercial.includes(vehicleclass) && coverage=="thirdpartyonly"){
            hidden=["monthlyrates", "minage", "maxage", "maxsum", "minsum", "passangers", "fortnightrates", "excludedvehicles", "weeklyrates","minimumpremium"];
            unhidden=["annualrates", "mintonnage", "maxtonnage"];
            unhide(unhidden, hidden);
        }
        if (matatuPsv.includes(vehicleclass) && coverage=="thirdpartyonly"){
            hidden=["minage", "mintonnage", "maxtonnage", "maxage", "maxsum", "minsum", "excludedvehicles", "minimumpremium"];
            unhidden=["weeklyrates","annualrates", "passangers", "monthlyrates", "fortnightrates"];
            unhide(unhidden, hidden);
        }
        if (motorTanker.includes(vehicleclass) && coverage=="thirdpartyonly"){
            hidden=["minage", "maxage", "maxsum", "minsum", "passangers", "fortnightrates", "excludedvehicles", "weeklyrates","minimumpremium"];
            unhidden=["annualrates", "monthlyrates", "mintonnage", "maxtonnage"];
            unhide(unhidden, hidden);
        }
        if (motorComprehensive.includes(vehicleclass) && coverage=="comprehensive"){
            hidden=["monthlyrates", "mintonnage", "maxtonnage", "passangers", "fortnightrates", "excludedvehicles", "weeklyrates"];
            unhidden=["annualrates","maxage", "maxsum", "minsum", "minage","minimumpremium"];
            unhide(unhidden, hidden);
        }
        if (motorVehicleComprehensivePrivate.includes(vehicleclass)&& coverage=="comprehensive"){
            hidden=["monthlyrates", "mintonnage", "maxtonnage", "passangers", "fortnightrates", "weeklyrates"];
            unhidden=["annualrates","maxage", "maxsum", "minsum", "minage","minimumpremium","excludedvehicles"];
            unhide(unhidden, hidden);
        }
        if (!(vehicleclass == "6.private") && coverage=="comprehensive"){
            hidden=["monthlyrates", "mintonnage", "maxtonnage", "passangers", "fortnightrates", "weeklyrates","excludedvehicles"];
            unhidden=["annualrates","maxage", "maxsum", "minsum", "minage","minimumpremium"];
            unhide(unhidden, hidden);
        }
    }
    function unhide(unhide, hide){
      unhide.forEach(unhidefunction);
      function unhidefunction(value) {
        document.getElementById(value).style.background="#ffffff";
        document.getElementById(value).readOnly = false;
        document.getElementById(value).setAttribute('required','');

      }
      hide.forEach(hideFrunction);
      function hideFrunction(value) {
        document.getElementById(value).style.background ="#d3d8dd";
        document.getElementById(value).readOnly=true;
        document.getElementById(value).removeAttribute('required');
      }  
      
    }
    function loaded(){
      var  hide = ["minage", "mintonnage", "maxtonnage", "maxage", "maxsum", "minsum", "passangers", "fortnightrates", "monthlyrates", "excludedvehicles", "weeklyrates","minimumpremium"];
      hide.forEach(myFunction);
      function myFunction(value) {
        document.getElementById(value).style.background  = "#d3d8dd";
        document.getElementById(value).readOnly = true;
        document.getElementById("annualrates").setAttribute('required','');
      }   
      
    }
    window.onload = loaded();
</script>
   <?php
   include "nav/footer.php";
   ?>