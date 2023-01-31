<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION["username"])){
        $phone= $_SESSION["username"];
        include "../../db/connect_db.php";
        include "functions/select.php";
        $user=selectuser("SELECT * FROM tbl_user WHERE phonenumber='$phone'");
        $num_per_page=10;
        if(isset($_GET["page"]))
        {
            $page=$_GET["page"];
        }
        else
        {
            $page=1;
        }
    
        $start_from=($page-1)*05;
        if($user){
            $user_info=$user;
            $clause = "WHERE ResultCode!='0' order by TransactionTime desc";
            if($user_info->role == "admin" && $user_info->is_active==1){
                include "nav/headeradmin.php";
            }elseif($user_info->role == "agency" && $user_info->is_active==1){
                include "nav/headeragency.php";
                $agency = $user_info->agency;
            }elseif($user_info->role == "sub-agent" && $user_info->is_active==1){
                include "nav/headersubagent.php";
                $subagent = $user_info->subagent;
                // echo $subagent;
            }elseif($user_info->role == "operator" && $user_info->is_active==1){
                include "nav/headersoperator.php";
                $subagent = $user_info->subagent;
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

        <div class="w-full px-6 py-6 mx-auto">
            <!-- table 1 -->
  
                                          
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex space-x-2  p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <div class="font-black">
                                <h6>Transactions    (<?php
                                                $select = $pdo->prepare("SELECT * FROM tbl_mpesa $clause");
                                                $select->execute();
                                                $total_records = $select->rowCount();
                                                echo $total_records;
                                                ?>)
                                </h6>
                            </div>
                            <div class="flex">
                                <div class="mb-3 xl:w-96">
                                    <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                                        <input type="search" id="policy" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                        <button class="btn inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center" type="button" id="button-addon2">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <div class="container cursor-move">
                                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 table table-success table-striped border-separate border-spacing-2 border border-slate-500">
                                        
                                        <thead class="border-b bg-slate-800">
                                            
                                            <tr>
                                                <th class="text-xs">Phone Number</th>
                                                <th class="text-xs">Transaction Date</th>
                                                <th class="text-xs">Result Desc</th>
                                                <th class="text-xs">Result Code</th>
                                            </tr>
                                        </thead>
                                        <tbody id='policytable'>
                                        <?php
                                            $sql=$pdo->prepare("SELECT * FROM tbl_mpesa $clause limit $start_from,$num_per_page");
                                            $sql->execute();
                                            $count=0;
                                            while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                                extract($row);
                                                
                                                try {
                                                    $date = new DateTime($row['TransactionDate']);
                                                    $transdate = $date->format('Y-m-d');
                                                    $transtime = $date->format('H:i:s');
                                                } catch (Exception $e) {
                                                    $transdate = $row['TransactionDate'];

                                                }
                                                $count++;
                                                ?>
                                            <tr <?php echo $count%2==0? "class='bg-gray-100 border-b'":"class='bg-blue-100 border-b'"?> data-toggle="collapse" data-target="#<?php echo $row['ID']?>" data-bs-toggle="tooltip" data-bs-placement="right" title="click to view more details">
                                                
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $count . '&nbsp&nbsp&nbsp' . $row['PhoneNumber']; ;?></p>
                                                </td>
                                        
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row["TransactionTime"];?></p>
                                                </td>                                   
                                                
                                                                                           
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['ResultDesc'];?></span>
                                                </td>
                                        
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['ResultCode'];?></span>
                                                </td>
                                                
                                            </tr>  
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="flex justify-center">
                                    <!-- <nav aria-label="Page navigation example">
                                        <ul class="flex list-style-none">
                                        <?php
                                            $select = $pdo->prepare("SELECT * FROM tbl_mpesa $clause");
                                            $select->execute();
                                            $total_records = $select->rowCount();
                                            $total_pages=ceil($total_records/$num_per_page);
                                            for($i=1;$i<=$total_pages;$i++)
                                            {if($i==$page){?>
                                                <li class="page-item active"><a
                                                    class="page-link relative block py-1.5 px-3 border-0 bg-blue-600 outline-none transition-all duration-300 rounded-full text-white hover:text-white hover:bg-blue-600 shadow-md focus:shadow-md"
                                                    href='failed.php?page=<?php echo $i?>'><?php echo $i?> <span class="visually-hidden">(current)</span></a></li>
                                            <?php
                                                }else{?>
                                                <li class='page-item'><a class="page-link relative block py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                                                 href='failed.php?page=<?php echo $i?>'><?php echo $i?> </a></li>
                                                <?php
                                                }}
                                            ?>   
                                        
                                        <li class="page-item disabled"><a
                                            class="page-link relative block py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-500 pointer-events-none focus:shadow-none"
                                            href="#" tabindex="-1" aria-disabled="true">Previous</a></li>
                                        <li class="page-item"><a
                                            class="page-link relative block py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                                            href="#">Next</a></li>
                                        </ul>
                                    </nav> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- devadmin card 2 -->

            
                                          
            
        </footer>
    </div>
  </body>
  <!-- plugin for scrollbar  -->
  <script src="../assets/js/plugins/perfect-scrollbar.min.js " async></script>
  <!-- github button -->
  <script async defer src="https://buttons.github.io/buttons.js "></script>
  <!-- main script file  -->
  <script src="../assets/js/soft-ui-dashboard-tailwind.js?v=1.0.3 " async></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function(){
        $("#policy").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#policytable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
         $("#renewals").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#renewalstable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

function benefits(name){
    let id=name.id;
    if(id=="customControlValidation2"){
        console.log(id);
        document.getElementById("custom_file").className ="custom-file";
    }
    if(id=="customControlValidation3"){
        console.log(id);
        document.getElementById("custom_file").className ="custom-file d-none";
    }
}
function receipt(){
    document.getElementById("receiptform").innerHTML='<div class="modal-body">\
                                                <input type="text" class="form-control" id="recipient-name" name="receipt" placeholder="eg... QH42O98F56" required>\
                                            </div>'
}
</script>
</html>