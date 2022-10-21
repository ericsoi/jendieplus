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
            $user_agency=$user_info->agency;
            $company=$user_info->companyname;
            $clause = "WHERE  owner='$user_agency' ORDER BY time ASC";
            $user_role = $user_info->role;
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
<!-- Custom Filter -->
<div class="w-full px-6 py-6 mx-auto">
    <div class=" flex-none w-full max-w-full px-3">
        <div class="flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="space-x-2  p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent bg-contain">

                    <link href='DataTables/datatables.css' rel='stylesheet' type='text/css'>

                    <!-- jQuery Library -->
                    <script src="jquery-3.3.1.min.js"></script>
                    
                    <!-- Datatable JS -->
                    <script src="DataTables/datatables.js"></script>
                        <div class="flex">
                            <div class="flex">
                                <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                                <input type="search" id="searchByName" class="inline-block px-6 py-2 border-2 border-black-200 text-black-200 font-medium text-xs leading-tight rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" placeholder="Search by Underwriter ..." aria-label="Search" aria-describedby="button-addon2">
                                </div>
                            </div>
                            <div class="">
                                <div class="mb-3 sm:w-96">
                                    <select id='searchByGender' class="inline-block px-6 py-2 border-2 border-black-200 text-black-200 font-medium text-xs leading-tight rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                        <option value=''>-- Select Coverage--</option>
                                        <option value='Comprehensive'>Comprehensive</option>
                                        <option value='Third Party Only'>Third Party Only</option>
                                    </select>
                                </div>                        
                            </div>  
                            <div>
                            <a href="../pages/productsetup.php"><button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Add Product</button></a>
                            </div>                      

                        </div>                        


                <!-- Table -->
                <table id='empTable' class='display dataTable items-center w-full mb-0 align-top border-gray-200 text-slate-500 table table-success table-striped border-separate border-spacing-2 border border-slate-500'>
                    <thead class="border-b bg-slate-800 text-left">
                    <tr>
                        <th>Underwriter</th>
                        <th>Vehicle Class</th>
                        <th>Coverage</th>
                        <th>Owner</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js " async></script>
  <!-- github button -->
  <script async defer src="https://buttons.github.io/buttons.js "></script>
  <!-- main script file  -->
  <script src="../assets/js/soft-ui-dashboard-tailwind.js?v=1.0.3 " async></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
var role = "<?php echo $user_role;?>";
var owner = "<?php echo $user_agency;?>";
var dataTable = $('#empTable').DataTable({
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    //'searching': false, // Remove default Search Control
    'ajax': {
        'url':"ajaxfile.php?role="+role+"&&owner="+owner,
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
        { data: 'underwriter' },
        { data: 'vehicleclass' },
        { data: 'coverage' },
        { data: 'owner' },
        { data: 'product_id' },
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
