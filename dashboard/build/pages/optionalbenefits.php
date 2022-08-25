<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$product_id=$_SESSION["edit_product"];
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
?>





<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            </div>
            <?php if(isset($_GET["benefit_name"])){
                $status=$_GET;
                include "toasts/toast.php";
                ?>

            <?php
                }
            ?>

            <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                        <h6 class="mb-0 font-bold">Product Benefits</h6>
                    </div>
                    <div class="flex-none w-1/2 max-w-full px-3 text-right">

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap"></button>

                        <button type="button" class="px-6
                            py-2.5
                            bg-blue-600
                            text-white
                            font-medium
                            text-xs
                            leading-tight
                            uppercase
                            rounded
                            shadow-md
                            hover:bg-blue-700 hover:shadow-lg
                            focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                            active:bg-blue-800 active:shadow-lg
                            transition
                            duration-150
                            ease-in-out" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Benefit
                        </button>   
                        <a href="products.php"> <button type="button" class="inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded-full hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Back</button></a>
                    </div>
                    <!-- Button trigger modal -->

                                        <!-- Modal -->
                    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog relative w-auto pointer-events-none">
                            <form role="form" action="processor/handle_benefits.php" method="post">
                                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Optional Benefit</h5>
                                    </div>
                                    <div class="modal-body relative p-4">
                                        <div class="mb-4">
                                            <select class="form-select appearance-none
                                                block
                                                w-full
                                                px-3
                                                py-1.5
                                                text-base
                                                font-normal
                                                text-gray-700
                                                bg-white bg-clip-padding bg-no-repeat
                                                border border-solid border-gray-300
                                                rounded
                                                transition
                                                ease-in-out
                                                m-0
                                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                                                id="benefit_name" name="benefit_name"
                                                name="benefit" id="benefit" data-bs-toggle="dropdown" onchange="handlebenefit(this)"
                                                >
                                                <?php
                                                    $select = $pdo->prepare("SELECT * FROM tbl_benefits_list");
                                                    $select->execute();
                                                    while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                                        extract($row);
                                                        $row = array_map('trim', $row);?>
                                                        <option value="<?php echo $row["benefit_name"];?>"><?php echo  $row["benefit_name"];?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div id="rates">
                                            <div class="mb-4">
                                                <label id="freelimitlabel" name="freelimitlabel" class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Free Limit</label>
                                                <input type="number" name="freelimit" id="freelimit" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                                            placeholder="Enter Free Limit" aria-label="Email" aria-describedby="email-addon" />
                                            </div>
                                            <div class="mb-4">
                                                <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Rate</label>
                                                <input type="number" name="rate" id="rate" step="any" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                                            placeholder="Enter Rate" aria-label="Email" aria-describedby="email-addon" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                                        <button type="button" class="px-6
                                            py-2.5
                                            bg-purple-600
                                            text-white
                                            font-medium
                                            text-xs
                                            leading-tight
                                            uppercase
                                            rounded
                                            shadow-md
                                            hover:bg-purple-700 hover:shadow-lg
                                            focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0
                                            active:bg-purple-800 active:shadow-lg
                                            transition
                                            duration-150
                                            ease-in-out" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="submit" name="benefit_submit" class="px-6
                                            py-2.5
                                            bg-blue-600
                                            text-white
                                            font-medium
                                            text-xs
                                            leading-tight
                                            uppercase
                                            rounded
                                            shadow-md
                                            hover:bg-blue-700 hover:shadow-lg
                                            focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                                            active:bg-blue-800 active:shadow-lg
                                            transition
                                            duration-150
                                            ease-in-out
                                            ml-1">Save changes
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 table table-success table-striped border-separate border-spacing-2 border border-slate-500">
                        
                        <thead class="border-b bg-gray-800">
                            
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Name</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Rate</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Free Limit</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Value</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No of Days</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Minimum Premium</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $no=1;
                             $select = $pdo->prepare("SELECT * FROM tbl_benefits where product_id='$product_id'");
                             $select->execute();
                             while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                 extract($row);
                                 $no++;
                                 ?>
                            <tr <?php echo $no%2==0? "class='bg-gray-100 border-b'":"class='bg-blue-100 border-b'"?>>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row["benefit_name"]?></p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row["benefit_rate"];?></p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row["benefit_freelimit"];?></p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row["benefit_amount"];?></p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="grid grid-cols-4 gap-1">
                                        <div>10</div>
                                        <div>15</div>
                                        <div>20</div>
                                        <div>30</div>
                                    </div>
                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row["benefit_days"];?></p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row["benefit_minimum_premium"];?></p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <a href="processor/handle_benefits.php?action=delete&product_id=<?php echo $product_id?>&benefit_name=<?php echo $row['benefit_name']?>" class="font-semibold leading-tight text-size-xs text-slate-400"> Delete </a>
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

<div class="flex flex-wrap -mx-3">
<div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            </div>
            <?php if(isset($_GET["vehicle_model"])){
                $status=$_GET;
                include "toasts/toast.php";
                ?>

            <?php
                }
            ?>

            <div class="flex space-x-2  p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="font-black">
                    <h6 class="mb-0 font-bold">Excluded Vehicles
                        (<?php
                        $select = $pdo->prepare("SELECT * FROM tbl_excluded_vehicles where product_id='$product_id'");
                        $select->execute();
                        $total_records = $select->rowCount();
                        echo $total_records;
                        ?>)
                    </h6>
                </div>
                <div class="flex">
                    <div class="mb-3 xl:w-96">
                        <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                            
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
                            
                            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
                            <form class="flex" action="processor/handle_benefits.php" method="post">
                                <input type="search" name="term" id="term" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                <button type="submit" name="vehicle_search" class="btn inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" type="button" id="button-addon3">Add_Vehicle</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 table table-success table-striped border-separate border-spacing-2 border border-slate-500">
                        
                        <thead class="border-b bg-gray-800">
                            
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Vehicle Model</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $no=0;
                             $select = $pdo->prepare("SELECT * FROM tbl_excluded_vehicles where product_id='$product_id'");
                             $select->execute();
                             while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                 extract($row);
                                 $no++;
                                 ?>
                            <tr <?php echo $no%2==0? "class='bg-gray-100 border-b'":"class='bg-blue-100 border-b'"?>>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $no;?></p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row["vehicle_model"];?></p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <a href="processor/handle_benefits.php?action=delete&vehicle_id=<?php echo $row['vehicle_id']?>" class="font-semibold leading-tight text-size-xs text-slate-400"> Delete </a>
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
<script type="text/javascript">
  $(function() {
     $( "#term" ).autocomplete({
       source: 'processor/vehicle_search.php',
     });
  });
</script>
<script>

  
    function handlebenefit(input) {
        var benefit=input.value.trim().replace("_", '').toLowerCase();
        console.log(benefit);
        switch (benefit) {

            case "aaroad_resque":
                document.getElementById("rates").innerHTML ='<div id="rates">\
                    <div class="mb-4">\
                        <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Amount</label>\
                        <input type="number" name="amount" id="amount" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Amount" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                </div>'
                break;
            case "amref":
                document.getElementById("rates").innerHTML ='<div id="rates">\
                    <div class="mb-4">\
                        <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Amount</label>\
                        <input type="number" name="amount" id="amount" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Amount" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                </div>'
                break;
            case "courtesycar":
                document.getElementById("rates").innerHTML ='<div id="rates">\
                    <div class="mb-4">\
                        <label id="freelimitlabel" name="freelimitlabel" class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Days</label>\
                        <input type="number" name="days" id="days" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Number of Days" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                    <div class="mb-4">\
                        <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Amount</label>\
                        <input type="number" name="amount" id="amount" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Amount" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                </div>'
                break;
            case "excessprotector":
                document.getElementById("rates").innerHTML ='<div id="rates">\
                    <div class="mb-4">\
                        <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Rate</label>\
                        <input type="number" name="rate" id="rate" step="any" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Rate" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                    <div class="mb-4">\
                        <label  id="minpremiumlebal" name="minpremiumlebal"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Minimum Premium</label>\
                        <input type="number" name="minimum_premium" id="minimum_premium" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Amount" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                </div>'
                break;
            case "passengerlegal_liability":
                document.getElementById("rates").innerHTML ='<div id="rates">\
                    <div class="mb-4">\
                        <label id="freelimitlabel" name="freelimitlabel" class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Enter Minimum Premium</label>\
                        <input type="number" name="minimum_premium" id="minimum_premium" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter ammount" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                </div>'
                break;
            case "personalaccident":
                document.getElementById("rates").innerHTML ='<div id="rates">\
                    <div class="mb-4">\
                        <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Amount</label>\
                        <input type="number" name="amount" id="amount" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Amount" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                </div>'
                break;
            case  "politicalviolence_and_terrorism":
                document.getElementById("rates").innerHTML ='<div id="rates">\
                    <div class="mb-4">\
                        <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Rate</label>\
                        <input type="number" name="rate" id="rate" step="any" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Rate" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                    <div class="mb-4">\
                        <label  id="minpremiumlebal" name="minpremiumlebal"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Minimum Premium</label>\
                        <input type="number" name="amount" id="amount" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Amount" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                </div>'
                break;
            case "radiocassete":
                document.getElementById("rates").innerHTML ='<div id="rates">\
                    <div class="mb-4">\
                        <label id="freelimitlabel" name="freelimitlabel" class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Free Limit</label>\
                        <input type="number" name="freelimit" id="freelimit" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Free Limit" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                    <div class="mb-4">\
                        <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Rate</label>\
                        <input type="number" name="rate" id="rate" step="any" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Rate" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                </div>'
                break;
            case "windscreen":
                document.getElementById("rates").innerHTML ='<div id="rates">\
                    <div class="mb-4">\
                        <label id="freelimitlabel" name="freelimitlabel" class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Free Limit</label>\
                        <input type="number" name="freelimit" id="freelimit" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Free Limit" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                    <div class="mb-4">\
                        <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Rate</label>\
                        <input type="number" name="rate" id="rate" step="any" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Rate" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                </div>'
                break;
            case "bimalife":
                document.getElementById("rates").innerHTML ='<div id="rates">\
                    <div class="mb-4">\
                        <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Amount</label>\
                        <input type="number" name="amount" id="amount" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Amount" aria-label="Email" aria-describedby="email-addon"required />\
                    </div>\
                </div>'
                break;
            case "infamaroad_resque":
                document.getElementById("rates").innerHTML ='<div id="rates">\
                    <div class="mb-4">\
                        <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Amount</label>\
                        <input type="number" name="amount" id="amount" step="any" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Rate" aria-label="Email" aria-describedby="email-addon" required/>\
                    </div>\
                </div>'
                break;
            default:
                document.getElementById("rates").innerHTML ='<div id="rates">\
                    <div class="mb-4">\
                        <label id="freelimitlabel" name="freelimitlabel" class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Free Limit</label>\
                        <input type="number" name="freelimit" id="freelimit" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Free Limit" aria-label="Email" aria-describedby="email-addon" />\
                    </div>\
                    <div class="mb-4">\
                        <label  id="ratelabel" name="ratelabel"  class="mb-2 ml-1 font-bold text-size-xs text-slate-700">Rate</label>\
                        <input type="number" name="rate" id="rate" step="any" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"\
                            placeholder="Enter Rate" aria-label="Email" aria-describedby="email-addon" />\
                    </div>\
                </div>'
        }
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
window.addEventListener("load", function(event) 
{

    console.log('before');
    setTimeout(console.log("donothing"),30000); // run donothing after 0.5 seconds
    console.log('after');
    setTimeout(function(){
        document.getElementById("close_toast").click();
        console.log("Closed");
    },3000);
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<!-- <id="close_toast"> -->
<?php
    include "../pages/nav/footer.php";
?>