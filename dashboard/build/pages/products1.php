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

        $start_from=($page-1)*10;
        if($user){
            $user_info=$user;
            $user_agency=$user_info->agency;
            $company=$user_info->companyname;
            $clause = "WHERE  owner='$user_agency' ORDER BY time ASC";
            $edit = false;
            if($user_info->role == "admin" && $user_info->is_active==1){
                include "nav/headeradmin.php";
                $clause = "where 1";
                $edit = true;
            }elseif($user_info->role == "agency" && $user_info->is_active==1){
                include "nav/headeragency.php";
                $agency = $user_info->agency;
                $edit = true;
            }elseif($user_info->role == "sub-agent" && $user_info->is_active==1){
                include "nav/headersubagent.php";
                $subagent = $user_info->subagent;
                $edit = false;
            }elseif($user_info->role == "operator" && $user_info->is_active==1){
                include "nav/headersoperator.php";
                $subagent = $user_info->subagent;
                $edit = false;
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
        <link href='DataTables/datatables.min.css' rel='stylesheet' type='text/css'>

        <!-- jQuery Library -->
        <script src="jquery-3.3.1.min.js"></script>

        <!-- Datatable JS -->
        <script src="DataTables/datatables.min.js"></script>
        <h6>PRODUCTS(<?php
                $select = $pdo->prepare("SELECT * FROM tbl_product $clause");
                $select->execute();
                $total_records = $select->rowCount();
                echo $total_records;
                ?>)
        </h6>
        <div class="w-full px-6 py-6 mx-auto">
            <!-- table 1 -->          
                                   
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex items-center justify-center">
                            <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="toolbar">
                                <input type="search" placeholder="search  ..." class="inline-block px-6 py-2 border-2 border-black-200 text-black-200 font-medium text-xs leading-tight rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out"></input>
                                <input type="search" id="searchByName" placeholder="seach by underwriter ..." class="inline-block px-6 py-2 border-2 border-black-200 text-black-200 font-medium text-xs leading-tight rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out"></input>
                                <select  id="searchByGender" type="search" placeholder="select coverage" class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-medium text-xs leading-tight rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">
                                    <option selected value="">Select Coverage</option>
                                    <option value="comprehensive">Comprehensive</option>
                                    <option value="third party only">Thirdparty Only</option>
                                </select >
                                <a href="../pages/productsetup.php"><button type="button" class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out">Add Product</button></a>
                            </div>
                        </div>   

                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <div class="container cursor-move">
                                    <table id="empTable" class="dataTable display items-center w-full mb-0 align-top border-gray-200 text-slate-500 table table-success table-striped border-separate border-spacing-2 border border-slate-500">
                                        
                                        <thead class="border-b bg-slate-800">
                                            
                                            <tr>
                                                <th class="text-xs">No</th>
                                                <th class="text-xs">Underwriter</th>
                                                <th class="text-xs">Vehicle Class</th>
                                                <th class="text-xs">Coverage</th>
                                                <th class="text-xs">Owner</th>
                                                <th class="text-xs">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id='policytable'>
                                        <?php
                                            $sql=$pdo->prepare("SELECT * FROM tbl_product $clause limit $start_from,$num_per_page");
                                            $sql->execute();
                                            $count=0;
                                            while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                                extract($row);
                                                $owner=$row["owner"];
                                                $usersql=$pdo->prepare("SELECT * FROM tbl_user WHERE agency='$owner' order by time_created LIMIT 1");
                                                $usersql->execute();
                                                $agency = $usersql->fetch(PDO::FETCH_ASSOC);
                                                // print_r($agency);
                                                $count++;
                                                ?>
                                            <tr <?php echo $count%2==0? "class='bg-gray-100 border-b'":"class='bg-blue-100 border-b'"?> data-toggle="collapse" data-target="#<?php echo $row['product_id']?>" data-bs-toggle="tooltip" data-bs-placement="right" title="click to view more details">
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $count;?></p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo ucwords($row['underwriter']);?></p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo ucwords($row['vehicleclass']);?></p>
                                                </td> 
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo  ucwords($row['coverage']);?></p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"> <?php echo $agency["companyname"];?></p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <div class="flex space-x-2 justify-center">
                                                        <div>
                                                            <?php 
                                                                if($edit){?>
                                                                    <a href="processor/handle_product.php?q=<?php echo $row["product_id"]?>"><button type="button" class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out">Edit</button></a>
                                                                    <a href="processor/handle_product.php?q=<?php echo $row["product_id"]?>&delete=true">   <button type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Delete</button></a>
                                                                <?php
                                                                }
                                                                ?>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr class="collapse border-b bg-yellow-100 border-yellow-200" id="<?php echo $row['product_id']?>">
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $count;?></p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo "";?></p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo "";?></p>
                                                </td> 
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo "";?></p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"> <?php echo "";?></p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"> <?php echo "";?></p>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>   
                                                
                                        </tbody>
                                    </table>
                                </div>
                                <div class="flex justify-center">
                                    <nav aria-label="Page navigation example">
                                        <ul class="flex list-style-none">
                                        <?php
                                            $select = $pdo->prepare("SELECT * FROM tbl_product $clause");
                                            $select->execute();
                                            $total_records = $select->rowCount();
                                            $total_pages=ceil($total_records/$num_per_page);
                                            for($i=1;$i<=$total_pages;$i++)
                                            {if($i==$page){?>
                                                <li class="page-item active"><a
                                                    class="page-link relative block py-1.5 px-3 border-0 bg-blue-600 outline-none transition-all duration-300 rounded-full text-white hover:text-white hover:bg-blue-600 shadow-md focus:shadow-md"
                                                    href='products.php?page=<?php echo $i?>'><?php echo $i?> <span class="visually-hidden">(current)</span></a></li>
                                            <?php
                                                }else{?>
                                                <li class='page-item'><a class="page-link relative block py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                                                 href='products.php?page=<?php echo $i?>'><?php echo $i?> </a></li>
                                                <?php
                                                }}
                                            ?>   
                                        
                                        <!-- <li class="page-item disabled"><a
                                            class="page-link relative block py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-500 pointer-events-none focus:shadow-none"
                                            href="#" tabindex="-1" aria-disabled="true">Previous</a></li>
                                        <li class="page-item"><a
                                            class="page-link relative block py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                                            href="#">Next</a></li>
                                        </ul> -->
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
  </body>
  <!-- plugin for scrollbar  -->
  <!-- <script src="../assets/js/plugins/perfect-scrollbar.min.js " async></script> -->
  <!-- github button -->
  <!-- <script async defer src="https://buttons.github.io/buttons.js "></script> -->
  <!-- main script file  -->
  <!-- <script src="../assets/js/soft-ui-dashboard-tailwind.js?v=1.0.3 " async></script> -->
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
  
  <script>
$(document).ready(function(){
var dataTable = $('#empTable').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    //'searching': false, // Remove default Search Control
    'ajax': {
        'url':"ajaxfile.php",
        'data': function(data){
            // Read values
            var gender = $('#searchByGender').val();
            var name = $('#searchByName').val();

            // Append to data
            data.searchByGender = gender;
            data.searchByName = name;
        }
    },
    'columns': [
        { data: 'emp_name' },
        { data: 'email' },
        { data: 'gender' },
        { data: 'salary' },
        { data: 'city' },
    ]
});

$('#searchByName').keyup(function(){
    dataTable.draw();
});

$('#searchByGender').change(function(){
    dataTable.draw();
});
});
</script>
  <!-- <script>
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
</script> -->
</html>