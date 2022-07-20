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
            // print_r($user_info);
            if($user_info->role == "admin" && $user_info->is_active==1){
                
                $agents=selectunderwriter("SELECT * FROM tbl_user WHERE  role='agency' ORDER BY time_created DESC");
                if($agents){
                    $keys=array_keys($agents);
                }
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
        <div class="w-full px-6 py-6 mx-auto">
            <!-- table 1 -->

            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6>All Platform Users</h6>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Agency Name</th>
                                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">IRA Licence</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Date Joined</th>
                                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while (!empty($keys)){
                                            $key = array_pop($keys);
                                            ?>
                                        <tr>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <div class="flex px-2 py-1">
                                                    <div>
                                                        <img src="../assets/img/team-2.jpg" class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-size-sm h-9 w-9 rounded-xl" alt="user1" />
                                                    </div>
                                                    <div class="flex flex-col justify-center">
                                                        <h6 class="mb-0 leading-normal text-size-sm"><?php echo $agents[$key]->companyname?></h6>
                                                        <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $agents[$key]->firstname . " " . $agents[$key]->lastname?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $agents[$key]->iralicense?></p>
                                                <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $agents[$key]->code?></p>
                                            </td>
                                            <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-size-sm whitespace-nowrap shadow-transparent">
                                                <?php if($agents[$key]->is_active == 1){
                                                    ?>
                                                    <span class="bg-gradient-lime px-3.6-em text-size-xs-em rounded-1.8 py-2.2-em inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Active</span>
                                                <?php }else{
                                                    ?>
                                                    <span class="bg-gradient-slate px-3.6-em text-size-xs-em rounded-1.8 py-2.2-em inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Inactive</span>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="font-semibold leading-tight text-size-xs text-slate-400"><?php $date = date_create($agents[$key]->time_created); $time_created=date_format($date, 'Y-m-d'); echo $time_created;?></span>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <a href="edituser.php?code=<?php echo $agents[$key]->code?>&role=<?php echo $agents[$key]->role?>" class="font-semibold leading-tight text-size-xs text-slate-400"> Edit </a>
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

            <!-- card 2 -->

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
</html>