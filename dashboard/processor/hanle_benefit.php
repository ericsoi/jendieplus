        <!-- cards row 2 -->
        <div class="w-full px-6 py-6 mx-auto">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h7>EDIT PRODUCT</h7>
        </div>
        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="w-full px-3 mb-6 lg:mb-0 lg:w-5/12 lg:flex-none">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="ma2 lg:flex-nonex-w-full px-3 lg:w-1/">
                            <div class="flex flex-col h-full">
                                <form role="form" action="#" method="post">
                                    <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Optional Benefit</label>
                                    <div class="mb-4">
                                        <select class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" name="benefit" id="benefit" onchange="handlebenefit(this)">
                                            
                                        <?php
                                            $select = $pdo->prepare("SELECT * FROM tbl_benefits_list");
                                            $select->execute();
                                            while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                                extract($row);
                                                // print_r($row);
                                                $row = array_map('trim', $row);?>
                                                <option value="<?php echo $row["benefit_name"];?>"><?php echo  $row["benefit_name"];?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            
                                    </div>
                                    <div class="mb-4">
                                    <label id="freelimitlabel" name="freelimitlabel" class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Free Limit</label>
                                        <input type="number" name="freelimit" id="freelimit" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                            placeholder="Enter Free Limit" aria-label="Email" aria-describedby="email-addon" />
                                    </div>
                                    <div class="mb-4">
                                        <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Rate</label>
                                        <input type="number" name="rate" id="rate" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                            placeholder="Enter Rate" aria-label="Email" aria-describedby="email-addon" />
                                    </div>
                                    <div class="flex-none max-w-full px-3 text-right">
                                    <button type="submit" name="benefit_submit" id="benefit_submit" class="inline-block px-2 py-1 font-bold text-right text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-size-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-dark-gray hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">Submit </button>
                                    </div> 
                                </form>
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="ma2 lg:flex-nonex-w-full px-3 lg:w-1/">
                            <div class="flex flex-col h-full">
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Product Benefits</label>

                                    <thead class="align-bottom">
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Name</th>
                                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Rate</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Value</th>
                                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $no=1;
                                        $select = $pdo->prepare("SELECT * FROM tbl_benefits where product_id='$product_id'");
                                        $select->execute();
                                        while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                            extract($row);
                                            $row = array_map('trim', $row);?>
                                            
                                        <tr>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <div class="flex px-2 py-1">
                                                    
                                                    <div class="flex flex-col justify-center">
                                                        <h6 class="mb-0 leading-normal text-size-sm"><<?php echo $row["benefit_name"]?>></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row["benefit_name"]?></p>
                                            </td>
                                            
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row["benefit_name"]?></span>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <a href="javascript:;" class="font-semibold leading-tight text-size-xs text-slate-400"> Edit </a>
                                            </td>
                                        </tr>    
                                        <?php 
                                        }
                                        ?>                              
                                        
                                    </tbody>
                                </table>
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h7>Excluded Vehicles</h7>
        </div>
        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="w-full px-3 mb-6 lg:mb-0 lg:w-5/12 lg:flex-none">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="ma2 lg:flex-nonex-w-full px-3 lg:w-1/">
                            <div class="flex flex-col h-full">
                                <form role="form">
                                    
                                    <div class="mb-4">
                                    <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Vehicle</label>
                                        <input type="email" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                            placeholder="Search vehicle make" aria-label="Email" aria-describedby="email-addon" />
                                    </div>
                                    
                                    <div class="flex-none max-w-full px-3 text-right">
                                    <button type="submit" name="submit" id="submit" class="inline-block px-2 py-1 font-bold text-right text-white align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-size-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-dark-gray hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25"
                                        href="createpolicy.php"></i>Submit </button>
                                    </div> 
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="ma2 lg:flex-nonex-w-full px-3 lg:w-1/">
                            <div class="flex flex-col h-full">
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <label class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Product Benefits</label>

                                    <thead class="align-bottom">
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Name</th>
                                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Rate</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Value</th>
                                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $no=1;
                                        // while (!empty($keys)){
                                        //     $key = array_pop($keys);
                                            ?>
                                        <tr>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <div class="flex px-2 py-1">
                                                    
                                                    <div class="flex flex-col justify-center">
                                                        <h6 class="mb-0 leading-normal text-size-sm"><?php echo $benefits[$key]->benefit_name?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $benefits[$key]->benefit_name?></p>
                                            </td>
                                            
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $benefits[$key]->benefit_name?></span>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <a href="javascript:;" class="font-semibold leading-tight text-size-xs text-slate-400"> Edit </a>
                                            </td>
                                        </tr>    
                                        <?php 
                                        // }
                                        ?>                              
                                        
                                    </tbody>
                                </table>
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function handlebenefit(input) {
        var benefit=input.value.trim().replace("_", '').toLowerCase();
        console.log(benefit);
    }

        // var freeLiit=["windscreen","radiocassete"];
        // var passenger=["passengerlegal_liability"];
        // var days=["courtesycar"];
        // var value=["personalaccident", "passengerlegal_liability","infamaroad_resque", "bimalife", "amref", "aaroad_resque"];
        // var rate=["politicalviolence_and_terrorism","excessprotector"];
    
        // if (freeLiit.includes(benefit)){
        //     document.getElementById("freelimitlabel").innerHTML = "Free limit";
        //     document.getElementById("freelimit").placeholder = "Enter Free Limit";
        //     document.getElementById("ratelabel").innerHTML = "Rate";
        //     document.getElementById("freelimit").style.background ="#ffffff";
        //     document.getElementById("freelimit").readOnly=false;
        //     document.getElementById("freelimit").removeAttribute('required');
        //     document.getElementById("freelimit").setAttribute('required','');
        //     document.getElementById("rate").placeholder = "Enter Rate";
        // }
        // if (passenger.includes(benefit)){
        //     console.log(benefit);
        //     document.getElementById("freelimitlabel").innerHTML = "Amount";
        //     document.getElementById("freelimit").placeholder = "Enter Premium per Passangers";
        //     document.getElementById("freelimit").style.background ="#ffffff";
        //     document.getElementById("freelimit").readOnly=false;
        //     document.getElementById("ratelabel").innerHTML = "Value";
        //     document.getElementById("rate").placeholder = "Enter Value";
        // }
        // if (rate.includes(benefit)){
        //     document.getElementById("freelimitlabel").placeholder = "Enter Number of Passangers";
        //     document.getElementById("freelimit").style.background ="#d3d8dd";
        //     document.getElementById("freelimit").readOnly=true;
        //     document.getElementById("freelimit").setAttribute('required','');
        //     document.getElementById("freelimit").name="none";
        //     document.getElementById("ratelabel").innerHTML = "Rate";
        //     document.getElementById("rate").placeholder = "Enter Rate";
        // }
        // if (value.includes(benefit)){
        //     document.getElementById("freelimitlabel").placeholder = "Enter Number of Passangers";
        //     document.getElementById("freelimit").style.background ="#d3d8dd";
        //     document.getElementById("freelimit").readOnly=true;
        //     document.getElementById("freelimit").setAttribute('required','');
        //     document.getElementById("ratelabel").innerHTML = "Value";
        //     document.getElementById("rate").placeholder = "Enter Value";
        // }
        // if (days.includes(benefit)){
        //     console.log("0000");
        //     document.getElementById("freelimitlabel").innerHTML = "Number of days";
        //     document.getElementById("freelimit").placeholder = "Enter Number of days";
        //     document.getElementById("freelimit").style.background ="#ffffff";
        //     document.getElementById("freelimit").readOnly=false;
        //     document.getElementById("freelimit").removeAttribute('required');
        //     document.getElementById("freelimit").setAttribute('required','');
        //     document.getElementById("ratelabel").innerHTML = "Value";
        //     document.getElementById("rate").placeholder = "Enter Value";
        // }
        // if (value.includes(benefit)){
        //     document.getElementById("freelimitlabel").innerHTML = "Number of Passangers";
        //     document.getElementById("freelimit").placeholder = "Enter Number of Passangers";
        //     document.getElementById("ratelabel").innerHTML = "Rate";
        //     document.getElementById("rate").placeholder = "Enter Rate";
        // }
        // if (value.includes(benefit)){
        //     document.getElementById("freelimitlabel").innerHTML = "Number of Passangers";
        //     document.getElementById("freelimit").placeholder = "Enter Number of Passangers";
        //     document.getElementById("ratelabel").innerHTML = "Rate";
        //     document.getElementById("rate").placeholder = "Enter Rate";
        // }

        // var optionalbenefit=document.getElementById(input.id).value;
        // console.log(optionalbenefit);
    // function unhide(unhide, hide){
    //   unhide.forEach(unhidefunction);
    //   function unhidefunction(value) {
    //     document.getElementById(value).style.background="#ffffff";
    //     document.getElementById(value).readOnly = false;
    //     document.getElementById(value).setAttribute('required','');

    //   }
    //   hide.forEach(hideFrunction);
    //   function hideFrunction(value) {
    //     document.getElementById(value).style.background ="#d3d8dd";
    //     document.getElementById(value).readOnly=true;
    //     document.getElementById(value).removeAttribute('required');
    //   }  
      
    // }
</script>

<?php
    include "../pages/nav/footer.php";
?>