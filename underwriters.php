<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        global $agencycode;
        
    }
    if (isset($_SESSION["username"])){  
        $phone= $_SESSION["username"];
        include "../../db/connect_db.php";
        include "functions/select.php";
        $user=selectuser("SELECT * FROM tbl_user WHERE phonenumber='$phone'");
        if($user){
            $user_info=$user;
            $owner=$user_info->agency;
            $user_role=$user_info->role;
            
            if($user_info->role == "admin" && $user_info->is_active==1){
                include "nav/headeradmin.php";
                $underwriters=selectunderwriter("SELECT * FROM tbl_underwriter ORDER BY Name DESC");
                if($underwriter){
                    $underwriter=$underwriter;
                    $keys=array_keys($underwriter);
                }
                    
            }elseif($user_info->role == "agency" && $user_info->is_active==1){
                include "nav/headeragency.php";
                $underwriter=selectunderwriter("SELECT * FROM tbl_email where owner='$owner' ORDER BY underwriter DESC");
                //$underwriters=selectunderwriter("SELECT * FROM tbl_agencycode where owner='$owner' ORDER BY underwriter DESC");
                if($underwriter){
                    $underwriter=$underwriter;
                    $keys=array_keys($underwriter);
                }
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
    }
    
?>

        <div class="w-full px-6 py-6 mx-auto">
            <!-- table 1 -->

            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6>Underwriter List</h6>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">INSURER NAME</th>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">API AGENCY CODE</th>
                                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Pay Bill</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Email Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while (!empty($keys)){
                                            if($user_info->role == "admin"){
                                               $key = array_pop($keys);
                                                
                                               $img="./assets/".$underwriter[$key]->path;
                                               $ID = trim($underwriter[$key]->ID);
                                               $EMAIL_ADDRESS = $underwriter[$key]->EMAIL_ADDRESS;
                                               $Name=$underwriter[$key]->Name;
                                            }
                                            if($user_info->role == "admin"){
                                                $key = array_pop($keys);
                                                 
                                                $img="./assets/".$underwriter[$key]->path;
                                                $ID = trim($underwriter[$key]->ID);
                                                $agentcode=$underwriter[$key]->agencycode;
                                                $Name=$underwriter[$key]->Name;
                                              
                                            }
                                            if($user_info->role == "agency"){
                                                $key = array_pop($keys);
                                                //$img="./assets".$underwriters[$key]->path;
                                                $id = trim($underwriter[$key]->id);
                                                $EMAIL_ADDRESS = $underwriter[$key]->email;
                                                $Name=$underwriter[$key]->underwriter;
                                                
                                                
                                            }
                                            
                                          
                                         ?>  
                                        <tr>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <div class="flex px-2 py-1">
                                                <div>
                                                    <?php  if($user_info->role == "admin"  ){?>  
                                                        <img src="<?php echo $img?>" class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-size-sm h-9 w-9 rounded-xl" />
                                                    <?php }?>
                                                    </div>
                                                    <div>
                                                    
                                                    <?php   if($user_info->role == "agency"  ){?>  
                                                        <png src="<?php echo $img ?>" class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-size-sm h-9 w-9 rounded-xl" />
                                                    <?php }?>
                                                    </div>
                                                    <div class="flex flex-col justify-center">
                                                        <h6><?php echo $Name?></h6>
                                                        <p class="mb-0 font-semibold leading-tight text-size-xs"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $underwriter[$key]->agencycode?></p>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $underwriter[$key]->paybill?></p>
                                                <p class="mb-0 leading-tight text-size-xs text-slate-400">Active</p>
                                            </td>
                                            <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-size-sm whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $EMAIL_ADDRESS?></p>
                                          
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <a href="edit_underwriter.php?id=<?php echo $user_role=='agency'? $id : $ID;?>" class="font-semibold leading-tight text-size-xs text-slate-400"> Edit </a>
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

          
            <footer class="pt-4">
                <div class="w-full px-6 mx-auto">
                    <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                        <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                            <div class="leading-normal text-center text-size-sm text-slate-500 lg:text-left">
                                ©
                                <script>
                                    document.write(new Date().getFullYear() + ",");
                                </script>
                                made with <i class="fa fa-heart"></i> by
                                <a href="#" class="font-semibold text-slate-700" target="_blank">JendiePlus Technologies</a> for BEST InsurTech Solutions.
                            </div>
                        </div>
                        
                    </div>
                </div>
            </footer>
        </div>
    </main>
    
        </div>
      </div>
    </div>
  </body>
  <!-- plugin for scrollbar  -->
  <script src="../assets/js/plugins/perfect-scrollbar.min.js " async></script>
  <!-- github button -->
  <script async defer src="https://buttons.github.io/buttons.js "></script>
  <!-- main script file  -->
  <script src="../assets/js/soft-ui-dashboard-tailwind.js?v=1.0.3 " async></script>
</html>