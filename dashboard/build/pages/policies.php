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
            <div class="flex-none">
                <form action="handle_policy.php" method="post" enctype="multipart/form-data">
                    <button type="button"><a href="assets/sample_policy.csv" class="bg-gradient-slate px-3.6-em text-size-xs-em rounded-1.8 py-2.2-em  whitespace-nowrap text-center align-baselin leading-none text-white">Download Sample File</a></button>
                    <input type="file" name="upcsv" accept=".csv" required class="bg-gradient-slate px-3.6-em text-size-xs-em rounded-1.8 py-2.2-em  whitespace-nowrap text-center align-baselin leading-none text-white"/>
                    <button type="submit" class="bg-gradient-slate px-3.6-em text-size-xs-em rounded-1.8 py-2.2-em  whitespace-nowrap text-center align-baselin leading-none text-white">Upload Policy File</button>
                </form>
                    
            </div>
                                        
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6>Policies    (<?php
                                            $select = $pdo->prepare("SELECT * FROM tbl_policy $clause");
                                            $select->execute();
                                            $total_records = $select->rowCount();
                                            echo $total_records;
                                            ?>)
                            </h6>
                        </div>
                        <nav class="navbar">
                            <input class="form-control" type="search" id="policy" placeholder="Search" aria-label="Search">
                        </nav>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            
                            <div class="p-0 overflow-x-auto">
                                <div class="flex-none w-1/2 max-w-full px-3 text-right">
                                    <!-- <form action="handle_policy.php" method="post" enctype="multipart/form-data">
                                        <input type="submit" value="Click to upload Policy File" class="bg-gradient-lime px-3.6-em text-size-xs-em rounded-1.8 py-2.2-em  whitespace-nowrap text-center align-baseline font-bold leading-none text-white"/>
                                        <input type="file" name="upcsv" accept=".csv" required class="bg-gradient-slate px-3.6-em text-size-xs-em rounded-1.8 py-2.2-em  whitespace-nowrap text-center align-baselin leading-none text-white"/>
                                        <input type="text" value="download policy sample" class="bg-gradient-lime px-3.6-em text-size-xs-em rounded-1.8 py-2.2-em  whitespace-nowrap text-center align-baseline font-bold leading-none text-white"/>
                                    </form> -->
                                    
                                </div>
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 table-bordered table-striped container">
                                    
                                    <thead class="align-bottom">
                                        
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Client Name</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Contact Details</th>
                                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Risk Details</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Cover Period</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Underwriter</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Gross Premium</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Sum Insured</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Action</th>
                                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
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
                                           
                                            $interval = date_diff($datetime1, $datetime2);
                                            $interval = $interval->format('%R%y years %R%m months');
                                            
                                            $count++;
                                            ?>
                                        <tr>
                                            
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $count . '&nbsp&nbsp&nbsp' . $row['first_name'] . ' ' . $row['last_name'] ;?></p>
                                                <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo '&nbsp&nbsp&nbsp&nbsp&nbsp'.$row['policy_number'];?></p>
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
                                                <p class="mb-0 font-semibold leading-tight text-size-xs"> <?php echo $row['cover_from'];?></p>
                                               
                                                <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $row['cover_to'];?></p>
                                                <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo  $interval;?></p>
                                            </td>
                                        
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['underwriter'];?></span>
                                            </td>
                                      
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['gross_premium'];?></span>
                                            </td>
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['sum_insured'];?></span>
                                            </td>
                                        
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 leading-tight text-size-xs text-slate-400"><button type="file" class="bg-gradient-slate px-3.6-em text-size-xs-em rounded-1.8 py-2.2-em inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">View details</button></p>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>    
                                            
                                    </tbody>
                                </table>
                                <nav aria-label="...">
                                    <ul class="pagination container d-flex justify-content-md-center align-items-center vh-100">
                                        <?php
                                            $select = $pdo->prepare("SELECT * FROM tbl_policy $clause");
                                            $select->execute();
                                            $total_records = $select->rowCount();
                                            $total_pages=ceil($total_records/$num_per_page);
                                            for($i=1;$i<=$total_pages;$i++)
                                            {?>
                                                <li class='page-item'><a class='page-link' href='policies.php?page=<?php echo $i?>'><?php echo $i?></a></li>
                                            <?php
                                                }
                                            ?>                                    
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- devadmin card 2 -->

            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6>Renewals (<?php
                                            $select = $pdo->prepare("SELECT * FROM tbl_renewal $clause");
                                            $select->execute();
                                            $total_records = $select->rowCount();
                                            echo $total_records;

                                            ?>)
                            </h6>
                        </div>
                        <nav class="navbar">
                            <input class="form-control" type="search" id="renewals" placeholder="Search" aria-label="Search">
                        </nav>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 table-bordered table-striped container">
                                    
                                    <thead class="align-bottom">
                                        
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Client Name</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Contact Details</th>
                                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Risk Details</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Cover Period</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Underwriter</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Gross Premium</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Sum Insured</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Action</th>
                                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="renewalstable">
                                    <?php
                                        $sql = $pdo->prepare("SELECT * FROM tbl_renewal $clause limit $start_from,$num_per_page");
                                        $sql->execute();
                                        $count=1;
                                        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                            extract($row);
                                            $datetime1 = date_create($row['cover_from']);
                                            $datetime2 = date_create($row['cover_to']);
                                           
                                            $interval = date_diff($datetime1, $datetime2);
                                            $interval = $interval->format('%R%y years %R%m months');
                                            $count++;
                                            ?>
                                        <tr>
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
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['underwriter'];?></span>
                                            </td>
                                      
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['gross_premium'];?></span>
                                            </td>
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['sum_insured'];?></span>
                                            </td>
                                        
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">                                            
                                                <button class="bg-gradient-slate px-3.6-em text-size-xs-em rounded-1.8 py-2.2-em inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white" type="button" data-toggle="collapse" data-target="#<?php echo $row['id']?>" aria-expanded="false" aria-controls="collapseExample">
                                                    View details
                                                </button>                                              
                                            </td>
                                        </tr>
                                        <tr class="collapse" id="<?php echo $row['id']?>">
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
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['underwriter'];?></span>
                                            </td>
                                      
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['gross_premium'];?></span>
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
                                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
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
                                <nav aria-label="...">
                                    <ul class="pagination container d-flex justify-content-md-center align-items-center vh-100">
                                        <?php
                                            $select = $pdo->prepare("SELECT * FROM tbl_renewal $clause");
                                            $select->execute();
                                            $total_records = $select->rowCount();
                                            $total_pages=ceil($total_records/$num_per_page);
                                            for($i=1;$i<=$total_pages;$i++)
                                            {?>
                                                <li class='page-item'><a class='page-link' href='policies.php?page=<?php echo $i?>#renewals'><?php echo $i?></a></li>
                                            <?php
                                                }
                                            ?>                                    
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6>Extensions (<?php
                                            $select = $pdo->prepare("SELECT * FROM tbl_extension $clause");
                                            $select->execute();
                                            $total_records = $select->rowCount();
                                            echo $total_records;

                                            ?>)
                        </h6>
                        </div>
                        <nav class="navbar">
                            <input class="form-control" type="search" id="myInput" placeholder="Search" aria-label="Search">
                        </nav>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                    
                                    <thead class="align-bottom">
                                        
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Client Name</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Contact Details</th>
                                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Risk Details</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Cover Period</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Underwriter</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Gross Premium</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Sum Insured</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Action</th>
                                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = $pdo->prepare("SELECT * FROM tbl_extension $clause");
                                        $sql->execute();
                                        $count=0;
                                        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                            extract($row);
                                            $datetime1 = date_create($row['cover_from']);
                                            $datetime2 = date_create($row['cover_to']);
                                           
                                            $interval = date_diff($datetime1, $datetime2);
                                            $interval = $interval->format('%R%y years %R%m months');
                                            $count++;
                                            ?>
                                        <tr>
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
                                            </td>
                                        
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['underwriter'];?></span>
                                            </td>
                                      
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['gross_premium'];?></span>
                                            </td>
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php echo $row['sum_insured'];?></span>
                                            </td>
                                        
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 leading-tight text-size-xs text-slate-400"><button type="file" class="bg-gradient-slate px-3.6-em text-size-xs-em rounded-1.8 py-2.2-em inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">View details</button></p>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>    
                                            
                                    </tbody>
                                </table>
                                <nav aria-label="...">
                                    <ul class="pagination container d-flex justify-content-md-center align-items-center vh-100">
                                        <?php
                                            $select = $pdo->prepare("SELECT * FROM tbl_extension $clause");
                                            $select->execute();
                                            $total_records = $select->rowCount();
                                            $total_pages=ceil($total_records/$num_per_page);
                                            for($i=1;$i<=$total_pages;$i++)
                                            {?>
                                                <li class='page-item'><a class='page-link' href='policies.php?page=<?php echo $i?>'><?php echo $i?></a></li>
                                            <?php
                                                }
                                            ?>                                    
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
  
            <footer class="py-12">
            <div class="container">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-shrink-0 w-full max-w-full mx-auto mb-6 text-center lg:flex-0 lg:w-8/12">
                        <a href="#" target="#" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> JendiePlus</a>
                        <a href="#" target="#" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> About Us </a>
                        <a href="#" target="#" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> FAQs </a>
                        <a href="#" target="#" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> Contact </a>
                        <a href="#" target="#" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> Services </a>
                    </div>
                    <div class="flex-shrink-0 w-full max-w-full mx-auto mt-2 mb-6 text-center lg:flex-0 lg:w-8/12">
                        <a href="#" target="#" class="mr-6 text-slate-400">
                            <span class="text-size-lg fab fa-dribbble"></span>
                        </a>
                        <a href="#" target="#" class="mr-6 text-slate-400">
                            <span class="text-size-lg fab fa-twitter"></span>
                        </a>
                        <a href="#" target="#" class="mr-6 text-slate-400">
                            <span class="text-size-lg fab fa-instagram"></span>
                        </a>
                        <a href="#" target="#" class="mr-6 text-slate-400">
                            <span class="text-size-lg fab fa-pinterest"></span>
                        </a>
                        <a href="#" target="#" class="mr-6 text-slate-400">
                            <span class="text-size-lg fab fa-github"></span>
                        </a>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3">
                    <div class="w-8/12 max-w-full px-3 mx-auto mt-1 text-center flex-0">
                        <p class="mb-0 text-slate-400">
                            Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            JendiePlus Technologies
                        </p>
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
</script>
</html>