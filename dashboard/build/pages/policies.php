<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION["username"])){
        $phone= $_SESSION["username"];
        include "../../db/connect_db.php";
        include "functions/select.php";
        $user=selectuser("SELECT * FROM tbl_user WHERE phonenumber='$phone'");
        $num_per_page=05;
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
            if($user_info->role == "admin" && $user_info->is_active==1){
                include "nav/headeradmin.php";
                $clause = "where 1";
            }elseif($user_info->role == "agency" && $user_info->is_active==1){
                include "nav/headeragency.php";
                $agency = $user_info->agency;
                $clause = "where agency = '$agency'";
            }elseif($user_info->role == "sub-agent" && $user_info->is_active==1){
                include "nav/headersubagent.php";
                $subagent = $user_info->subagent;
                // echo $subagent;
                $clause = "where subagent = '$subagent'";
            }elseif($user_info->role == "operator" && $user_info->is_active==1){
                include "nav/headersoperator.php";
                $subagent = $user_info->subagent;
                $clause = "where subagent = '$subagent'";
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
  
            <div class="flex space-x-2 justify-center">
                <div>
                    <form action="handle_policy.php" method="post" enctype="multipart/form-data">
                        <button type="button" class="inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded-full hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out"><a href="assets/sample_policy.csv">Download Sample Policy</a></button>
                        <input type="file" name="upcsv" class="inline-block px-6 py-2 border-2 border-purple-600 text-purple-600 font-medium text-xs leading-tight uppercase rounded-full hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" required></input>
                        <button type="submit" class="inline-block px-6 py-2 border-2 border-green-500 text-green-500 font-medium text-xs leading-tight uppercase rounded-full hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Upload Policy File</button>
                    </form>
                </div>
            </div>                                   
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex space-x-2  p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <div class="font-black">
                                <h6>POLICIES    (<?php
                                                $select = $pdo->prepare("SELECT * FROM tbl_policy $clause");
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
                                                <th class="text-xs">Client Name</th>
                                                <th class="text-xs">Contact Details</th>
                                                <th class="text-xs">Risk Details</th>
                                                <th class="text-xs">Cover Period</th>
                                                <th class="text-xs">Underwriter</th>
                                                <th class="text-xs">Gross Premium</th>
                                                <th class="text-xs">Policy Status</th>
                                                <th class="text-xs">Installments</th>
                                            </tr>
                                        </thead>
                                        <tbody id='policytable'>
                                        <?php
                                            $sql=$pdo->prepare("SELECT * FROM tbl_policy $clause limit $start_from,$num_per_page");
                                            $sql->execute();
                                            $count=0;
                                            while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                                extract($row);
                                                $datetime1 = date_create($row['cover_from']);
                                                $datetime2 = date_create($row['cover_to']);
                                                $datetime3 = date_create($row['cover_from']);
                                                $datetime4 = date_create($row['cover_to']);                                           
                                                $interval = date_diff($datetime1, $datetime2);
                                                $certinterval = date_diff($datetime3, $datetime4);

                                                $interval = $interval->format('%R%y %R%m months');
                                                $certinterval =$certinterval->format('%R%y %R%m months');
                                                
                                                $count++;
                                                ?>
                                            <tr <?php echo $count%2==0? "class='bg-gray-100 border-b'":"class='bg-blue-100 border-b'"?> data-toggle="collapse" data-target="#<?php echo $row['id']?>" data-bs-toggle="tooltip" data-bs-placement="right" title="click to view more details">
                                                
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $count . '&nbsp&nbsp&nbsp' . ucwords($row['first_name']) . ' ' . $row['last_name'] ;?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo '&nbsp&nbsp&nbsp&nbsp&nbsp'.$row['policy_number'];?></p>
                                                </td>
                                        
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row['phone_number'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['client_email'];?></p>
                                                </td> 
                                            
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row['vehicle_reg'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo  ucwords($row['cover_type']);?></p>

                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo ucwords($row['insurance_class']);?></p>
                                                </td>
                                                
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"> <?php echo $row['cover_from'];?></p>
                                                
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['cover_to'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo  $interval;?></p>
                                                </td>
                                            
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo ucwords($row['underwriter']);?></span>
                                                </td>
                                        
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['gross_premium'];?></span>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <?php
                                                    if($row["status"]==0){?>
                                                        <p><span class="badge badge-success  badge-pill text-size-xs">Active</span></p>
                                                    <?php
                                                    }elseif($row["status"]==1){
                                                    ?>
                                                        <p><span class="badge badge-danger  badge-pill text-size-xs">Inactice</span></p>
                                                    <?php
                                                    }elseif($row["status"]==2){
                                                    ?>
                                                        <p><span class="badge badge-warning  badge-pill text-size-xs">Pending Agent Approval</span></p>
                                                    <?php
                                                    }
                                                    ?>

                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['installments'];?></span>
                                                </td>
                                            </tr>
                                            <tr class="collapse border-b bg-yellow-100 border-yellow-200" id="<?php echo $row['id']?>">
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Owner</p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['role'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php if ($row['role'] == 'agency'){echo $row['agency'];}elseif($row['role']=="sub-agent"){echo $row['subagent'];}elseif($row['role']=="operator"){echo $row['code'];}elseif($row['role']=="admin"){echo $row['agency'];}?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Agent Number</p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['username'];?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                </td> 
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Certificate Number</p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['certificate_number']?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>

                                                </td>
                                                
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Cert Period</p>
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row['cert_from'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['cert_to'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $certinterval;?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>


                                                </td>
                                            
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Seating Capacity</p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['seating_capacity'];?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                </td>
                                        
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Sum Insured</p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['sum_insured'];?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>

                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <?php 
                                                        if($row["method_of_payment"] == "mpesa"){?>
                                                        <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Payment Method</p>
                                                        <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['method_of_payment'];?></p>

                                                        <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Mpesa Receip</p>
                                                        <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['proof_of_payment'];?></p>

                                                    <?php
                                                        }else{
                                                            if ($row['role'] == 'agency' && $row['status'] == 2){?>
                                                        <form action="#" method="get">
                                                        <ul class="list-group">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center alert-dark text-size-xs">
                                                                <p class="font-semibold leading-tight text-size-xs text-slate-400">Payment Method</p>
                                                                <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo ucwords($row['method_of_payment']);?></p>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center text-size-xs list-group-item-success">
                                                                <button type="submit" name="approve" value="approve"  class="btn btn-success btn-sm  text-size-xs">Approve</button>
                                                                <button type="submit" name="reject" value="reject" class="btn btn-danger btn-sm   text-size-xs">Reject </button>
                                                            </li>    
                                                            <li class="list-group-item d-flex justify-content-between align-items-center text-size-xs list-group-item-success">
                                                                <br><button type="button" class="btn btn-primary  text-size-xs btn-sm " data-toggle="modal"  data-target="#exampleModalCenter" onclick="receipt()">

                                                                Update transaction receipt
                                                                </button>

                                                            </li>
                                                            <?php
                                                                }else{
                                                            ?>
                                                            <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Payment Method </p><p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo ucwords($row['method_of_payment']);?></p>
                                                            <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Payment receipt </p>
                                                            <p class="font-semibold  text-size-xs text-slate-400"><?php echo $row['proof_of_payment'];?></p>
                                                            <p class="font-semibold  text-size-xs text-slate-400"><br></p>

                                                            <?php
                                                                }
                                                            ?>
                                                        </ul>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Transaction Receipt</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div id="receiptform">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </form>

                                                    <?php
                                                        }
                                                        ?>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Transaction Amount</p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"> Ksh. <?php echo $row['amount'];?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>


                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"> 
                                                    <?php
                                                    if (strtolower($row['optional_benefits']) == 'yes'){
                                                    ?>
                                                    <form class="was-validated" >     
                                                        <label>Optional Benefits</label>             
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required onchange="benefits(this)">
                                                            <label class="custom-control-label" for="customControlValidation2">Upload File</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" required onchange="benefits(this)">
                                                            <label class="custom-control-label" for="customControlValidation3">Enter benefits</label>
                                                            <div class="invalid-feedback">Select one</div>
                                                        </div>
                                                        <div class="custom-file d-none" id="custom_file">
                                                            <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                                                            <label class="custom-file-label" for="validatedCustomFile"></label>
                                                        </div>
                                                    </form>
                                                    <?php
                                                    }
                                                    ?>                                          
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
                                            $select = $pdo->prepare("SELECT * FROM tbl_policy $clause");
                                            $select->execute();
                                            $total_records = $select->rowCount();
                                            $total_pages=ceil($total_records/$num_per_page);
                                            for($i=1;$i<=$total_pages;$i++)
                                            {if($i==$page){?>
                                                <li class="page-item active"><a
                                                    class="page-link relative block py-1.5 px-3 border-0 bg-blue-600 outline-none transition-all duration-300 rounded-full text-white hover:text-white hover:bg-blue-600 shadow-md focus:shadow-md"
                                                    href='policies.php?page=<?php echo $i?>'><?php echo $i?> <span class="visually-hidden">(current)</span></a></li>
                                            <?php
                                                }else{?>
                                                <li class='page-item'><a class="page-link relative block py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                                                 href='policies.php?page=<?php echo $i?>'><?php echo $i?> </a></li>
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

            <!-- devadmin card 2 -->

            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex space-x-2  p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <div class="font-black">
                                <h6>RENEWALS    (<?php
                                                $select = $pdo->prepare("SELECT * FROM tbl_renewal $clause");
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
                                                <th class="text-xs">Client Name</th>
                                                <th class="text-xs">Contact Details</th>
                                                <th class="text-xs">Risk Details</th>
                                                <th class="text-xs">Cover Period</th>
                                                <th class="text-xs">Underwriter</th>
                                                <th class="text-xs">Gross Premium</th>
                                                <th class="text-xs">Policy Status</th>
                                                <th class="text-xs">Installments</th>
                                            </tr>
                                        </thead>
                                    <tbody id="renewalstable">
                                    <?php
                                        $sql = $pdo->prepare("SELECT * FROM tbl_renewal $clause limit $start_from,$num_per_page");
                                        $sql->execute();
                                        $count=1;
                                        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                            extract($row);
                                            // $datetime1 = date_create($row['cover_from']);
                                            // $datetime2 = date_create($row['cover_to']);
                                           
                                            // $interval = date_diff($datetime1, $datetime2);
                                            // $interval = $interval->format('%R%y %R%m months');
                                            $count++;
                                            ?>
                                        <tr <?php echo $count%2==0? "class='bg-gray-100 border-b'":"class='bg-blue-100 border-b'"?> data-toggle="collapse" data-target="#<?php echo $row['id']?>" data-bs-toggle="tooltip" data-bs-placement="right" title="click to view more details">
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row['first_name'] . ' ' . $row['last_name'] ;?></p>
                                                <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['policy_number'];?></p>
                                            </td>
                                       
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row['phone_number'];?></p>
                                                <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['client_email'];?></p>
                                            </td> 
                                        
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row['vehicle_reg'];?></p>
                                                <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['insurance_class'] . ' ' . $row['cover_type'];?></p>
                                            </td>
                                               
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row['cover_from'];?></p>
                                                <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['cover_to'];?></p>
                                                <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $interval;?></p>
                                            </td>
                                        
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo ucwords($row['underwriter']);?></span>
                                            </td>
                                      
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['gross_premium'];?></span>
                                            </td>
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['sum_insured'];?></span>
                                            </td>
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['installments'];?></span>
                                                </td>
    
                                        </tr>
                                        <tr class="collapse border-b bg-yellow-100 border-yellow-200" id="<?php echo $row['id']?>">
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Owner</p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['role'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php if ($row['role'] == 'agency'){echo $row['agency'];}elseif($row['role']=="sub-agent"){echo $row['subagent'];}elseif($row['role']=="operator"){echo $row['code'];}elseif($row['role']=="admin"){echo $row['agency'];}?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Agent Number</p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['username'];?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                </td> 
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Certificate Number</p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['certificate_number']?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>

                                                </td>
                                                
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Cert Period</p>
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row['cert_from'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['cert_to'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $certinterval;?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>


                                                </td>
                                            
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Seating Capacity</p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['seating_capacity'];?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                </td>
                                        
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Sum Insured</p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['sum_insured'];?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>

                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <?php 
                                                        if($row["method_of_payment"] == "mpesa"){?>
                                                        <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Payment Method</p>
                                                        <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['method_of_payment'];?></p>

                                                        <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Mpesa Receip</p>
                                                        <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['proof_of_payment'];?></p>

                                                    <?php
                                                        }else{
                                                            if ($row['role'] == 'agency' && $row['status'] == 2){?>
                                                        <form action="#" method="get">
                                                        <ul class="list-group">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center alert-dark text-size-xs">
                                                                <p class="font-semibold leading-tight text-size-xs text-slate-400">Payment Method</p>
                                                                <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo ucwords($row['method_of_payment']);?></p>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center text-size-xs list-group-item-success">
                                                                <button type="submit" name="approve" value="approve"  class="btn btn-success btn-sm  text-size-xs">Approve</button>
                                                                <button type="submit" name="reject" value="reject" class="btn btn-danger btn-sm   text-size-xs">Reject </button>
                                                            </li>    
                                                            <li class="list-group-item d-flex justify-content-between align-items-center text-size-xs list-group-item-success">
                                                                <br><button type="button" class="btn btn-primary  text-size-xs btn-sm " data-toggle="modal"  data-target="#exampleModalCenter" onclick="receipt()">

                                                                Update transaction receipt
                                                                </button>

                                                            </li>
                                                            <?php
                                                                }else{
                                                            ?>
                                                            <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Payment Method </p><p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo ucwords($row['method_of_payment']);?></p>
                                                            <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Payment receipt </p>
                                                            <p class="font-semibold  text-size-xs text-slate-400"><?php echo $row['proof_of_payment'];?></p>
                                                            <p class="font-semibold  text-size-xs text-slate-400"><br></p>

                                                            <?php
                                                                }
                                                            ?>
                                                        </ul>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Transaction Receipt</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div id="receiptform">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </form>

                                                    <?php
                                                        }
                                                        ?>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Transaction Amount</p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"> Ksh. <?php echo $row['amount'];?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>


                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"> 
                                                    <?php
                                                    if (strtolower($row['optional_benefits']) == 'yes'){
                                                    ?>
                                                    <form class="was-validated" >     
                                                        <label>Optional Benefits</label>             
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required onchange="benefits(this)">
                                                            <label class="custom-control-label" for="customControlValidation2">Upload File</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" required onchange="benefits(this)">
                                                            <label class="custom-control-label" for="customControlValidation3">Enter benefits</label>
                                                            <div class="invalid-feedback">Select one</div>
                                                        </div>
                                                        <div class="custom-file d-none" id="custom_file">
                                                            <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                                                            <label class="custom-file-label" for="validatedCustomFile"></label>
                                                        </div>
                                                    </form>
                                                    <?php
                                                    }
                                                    ?>                                          
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
                                            $select = $pdo->prepare("SELECT * FROM tbl_renewal $clause");
                                            $select->execute();
                                            $total_records = $select->rowCount();
                                            $total_pages=ceil($total_records/$num_per_page);
                                            for($i=1;$i<=$total_pages;$i++)
                                            {if($i==$page){?>
                                                <li class="page-item active"><a
                                                    class="page-link relative block py-1.5 px-3 border-0 bg-blue-600 outline-none transition-all duration-300 rounded-full text-white hover:text-white hover:bg-blue-600 shadow-md focus:shadow-md"
                                                    href='policies.php?page=<?php echo $i?>'><?php echo $i?> <span class="visually-hidden">(current)</span></a></li>
                                            <?php
                                                }else{?>
                                                <li class='page-item'><a class="page-link relative block py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                                                 href='policies.php?page=<?php echo $i?>'><?php echo $i?> </a></li>
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
                                          
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex space-x-2  p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <div class="font-black">
                                <h6>EXTENSIONS    (<?php
                                                $select = $pdo->prepare("SELECT * FROM tbl_extension $clause");
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
                                                <th class="text-xs">Client Name</th>
                                                <th class="text-xs">Contact Details</th>
                                                <th class="text-xs">Risk Details</th>
                                                <th class="text-xs">Cover Period</th>
                                                <th class="text-xs">Underwriter</th>
                                                <th class="text-xs">Gross Premium</th>
                                                <th class="text-xs">Policy Status</th>
                                                <th class="text-xs">Installments</th>
                                            </tr>
                                        </thead>
                                        <tbody id='extensions'>
                                        <?php
                                            $sql=$pdo->prepare("SELECT * FROM tbl_extension $clause limit $start_from,$num_per_page");
                                            $sql->execute();
                                            $count=0;
                                            while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                                extract($row);
                                                $datetime1 = date_create($row['cover_from']);
                                                $datetime2 = date_create($row['cover_to']);
                                                $datetime3 = date_create($row['cover_from']);
                                                $datetime4 = date_create($row['cover_to']);                                           
                                                $interval = date_diff($datetime1, $datetime2);
                                                $certinterval = date_diff($datetime3, $datetime4);

                                                $interval = $interval->format('%R%y %R%m months');
                                                $certinterval =$certinterval->format('%R%y %R%m months');
                                                
                                                $count++;
                                                ?>
                                            <tr <?php echo $count%2==0? "class='bg-gray-100 border-b'":"class='bg-blue-100 border-b'"?> data-toggle="collapse" data-target="#<?php echo $row['id']?>" data-bs-toggle="tooltip" data-bs-placement="right" title="click to view more details">
                                                
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $count . '&nbsp&nbsp&nbsp' . ucwords($row['first_name']) . ' ' . $row['last_name'] ;?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo '&nbsp&nbsp&nbsp&nbsp&nbsp'.$row['policy_number'];?></p>
                                                </td>
                                        
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row['phone_number'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['client_email'];?></p>
                                                </td> 
                                            
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row['vehicle_reg'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo  ucwords($row['cover_type']);?></p>

                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo ucwords($row['insurance_class']);?></p>
                                                </td>
                                                
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"> <?php echo $row['cover_from'];?></p>
                                                
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['cover_to'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo  $interval;?></p>
                                                </td>
                                            
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo ucwords($row['underwriter']);?></span>
                                                </td>
                                        
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['gross_premium'];?></span>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <?php
                                                    if($row["status"]==0){?>
                                                        <p><span class="badge badge-success  badge-pill text-size-xs">Active</span></p>
                                                    <?php
                                                    }elseif($row["status"]==1){
                                                    ?>
                                                        <p><span class="badge badge-danger  badge-pill text-size-xs">Inactice</span></p>
                                                    <?php
                                                    }elseif($row["status"]==2){
                                                    ?>
                                                        <p><span class="badge badge-warning  badge-pill text-size-xs">Pending Agent Approval</span></p>
                                                    <?php
                                                    }
                                                    ?>

                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['installments'];?></span>
                                                </td>
                                            </tr>
                                            <tr class="collapse border-b bg-yellow-100 border-yellow-200" id="<?php echo $row['id']?>">
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Owner</p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['role'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php if ($row['role'] == 'agency'){echo $row['agency'];}elseif($row['role']=="sub-agent"){echo $row['subagent'];}elseif($row['role']=="operator"){echo $row['code'];}elseif($row['role']=="admin"){echo $row['agency'];}?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Agent Number</p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['username'];?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                </td> 
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Certificate Number</p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['certificate_number']?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>

                                                </td>
                                                
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Cert Period</p>
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $row['cert_from'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['cert_to'];?></p>
                                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $certinterval;?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>


                                                </td>
                                            
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Seating Capacity</p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['seating_capacity'];?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                </td>
                                        
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Sum Insured</p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['sum_insured'];?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>

                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <?php 
                                                        if($row["method_of_payment"] == "mpesa"){?>
                                                        <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Payment Method</p>
                                                        <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['method_of_payment'];?></p>

                                                        <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Mpesa Receip</p>
                                                        <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['proof_of_payment'];?></p>

                                                    <?php
                                                        }else{
                                                            if ($row['role'] == 'agency' && $row['status'] == 2){?>
                                                        <form action="#" method="get">
                                                        <ul class="list-group">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center alert-dark text-size-xs">
                                                                <p class="font-semibold leading-tight text-size-xs text-slate-400">Payment Method</p>
                                                                <p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo ucwords($row['method_of_payment']);?></p>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center text-size-xs list-group-item-success">
                                                                <button type="submit" name="approve" value="approve"  class="btn btn-success btn-sm  text-size-xs">Approve</button>
                                                                <button type="submit" name="reject" value="reject" class="btn btn-danger btn-sm   text-size-xs">Reject </button>
                                                            </li>    
                                                            <li class="list-group-item d-flex justify-content-between align-items-center text-size-xs list-group-item-success">
                                                                <br><button type="button" class="btn btn-primary  text-size-xs btn-sm " data-toggle="modal"  data-target="#exampleModalCenter" onclick="receipt()">

                                                                Update transaction receipt
                                                                </button>

                                                            </li>
                                                            <?php
                                                                }else{
                                                            ?>
                                                            <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Payment Method </p><p class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo ucwords($row['method_of_payment']);?></p>
                                                            <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Payment receipt </p>
                                                            <p class="font-semibold  text-size-xs text-slate-400"><?php echo $row['proof_of_payment'];?></p>
                                                            <p class="font-semibold  text-size-xs text-slate-400"><br></p>

                                                            <?php
                                                                }
                                                            ?>
                                                        </ul>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Transaction Receipt</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div id="receiptform">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </form>

                                                    <?php
                                                        }
                                                        ?>
                                                </td>
                                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-size-xs alert-dark">Transaction Amount</p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"> Ksh. <?php echo $row['amount'];?></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>
                                                    <p class="font-semibold leading-tight text-size-xs text-slate-400"><br></p>


                                                </td>
                                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent"> 
                                                    <?php
                                                    if (strtolower($row['optional_benefits']) == 'yes'){
                                                    ?>
                                                    <form class="was-validated" >     
                                                        <label>Optional Benefits</label>             
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required onchange="benefits(this)">
                                                            <label class="custom-control-label" for="customControlValidation2">Upload File</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" required onchange="benefits(this)">
                                                            <label class="custom-control-label" for="customControlValidation3">Enter benefits</label>
                                                            <div class="invalid-feedback">Select one</div>
                                                        </div>
                                                        <div class="custom-file d-none" id="custom_file">
                                                            <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                                                            <label class="custom-file-label" for="validatedCustomFile"></label>
                                                        </div>
                                                    </form>
                                                    <?php
                                                    }
                                                    ?>                                          
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
                                            $select = $pdo->prepare("SELECT * FROM tbl_extension $clause");
                                            $select->execute();
                                            $total_records = $select->rowCount();
                                            $total_pages=ceil($total_records/$num_per_page);
                                            for($i=1;$i<=$total_pages;$i++)
                                            {if($i==$page){?>
                                                <li class="page-item active"><a
                                                    class="page-link relative block py-1.5 px-3 border-0 bg-blue-600 outline-none transition-all duration-300 rounded-full text-white hover:text-white hover:bg-blue-600 shadow-md focus:shadow-md"
                                                    href='policies.php?page=<?php echo $i?>'><?php echo $i?> <span class="visually-hidden">(current)</span></a></li>
                                            <?php
                                                }else{?>
                                                <li class='page-item'><a class="page-link relative block py-1.5 px-3 border-0 bg-transparent outline-none transition-all duration-300 rounded-full text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                                                 href='policies.php?page=<?php echo $i?>'><?php echo $i?> </a></li>
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