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
            $products=selectunderwriter("SELECT * FROM tbl_product WHERE  owner='$user_agency' ORDER BY time DESC");
                if($products){
                    $keys=array_keys($products);
                }
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

<div class="w-full px-6 py-6 mx-auto">

<div class="flex flex-wrap my-6 -mx-3">
    <!-- card 1 -->

    
                    <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                        <h6>Products</h6>
                      
                    </div>

            <div class="flex-auto p-6 px-0 pb-2"> 
                <div class="overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-size-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Underwriting Company</th>
                                <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-size-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Vehicle Class</th>
                                <th class="px-6 py-3 pl-2 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-size-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Coverage</th>
                                <th class="px-6 py-3 pl-2 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-size-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Owner</th>
                                <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-size-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Premium/Rate</th>
                                <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-size-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Action</th>
                            </tr>
                        </thead>
                        <div class="flex-none w-1/2 max-w-full px-3 text-right">
                                <a class="inline-block px-6 py-3 font-bold text-right text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-size-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-dark-gray hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25"
                                    href="../pages/productsetup.php"> <i class="fas fa-plus"> </i>&nbsp;&nbsp;Add Product  </a>
                            </div>
                        <tbody>
                        <?php
                            while (!empty($keys)){
                                $key = array_pop($keys);
                                $underwriter=$products[$key]->underwriter;
                                $vehicleclass=$products[$key]->vehicleclass;
                                $coverage=$products[$key]->coverage;
                                $owner=$products[$key]->owner;
                                $annualrates=$products[$key]->annualrates;
                                $productid=$products[$key]->uniqueidentifier;
                                $id=$products[$key]->product_id;
                            ?> 
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <div class="flex px-2 py-1">
                                        <div>
                                            <img src="../assets/img/small-logos/logo-xd.svg" class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-size-sm h-9 w-9 rounded-xl" alt="xd" />
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-size-sm"><?php echo $underwriter?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $vehicleclass?></p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 leading-tight text-size-xs text-slate-400"><?php echo $coverage?></p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs"><?php echo $owner?></p>
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-size-sm whitespace-nowrap">
                                    <span class="font-semibold leading-tight text-size-xs"> <?php echo $annualrates?> </span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex-none w-1/2 max-w-full px-3 text-right">
                                    <a href="optionalbenefits.php?q=<?php echo $id?>" class="font-semibold leading-tight text-size-xs text-slate-400"> EDIT </a>
                                </td>
                                </td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                        <div class="row text-center py-2 mt-3">

                        </div>
                      </div>
                    </table>
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
</main>
<div fixed-plugin>
<a fixed-plugin-button class="bottom-7.5 right-7.5 text-size-xl z-990 shadow-soft-lg rounded-circle fixed cursor-pointer bg-white px-4 py-2 text-slate-700">
<i class="py-2 pointer-events-none fa fa-cog"> </i>
</a>
<!-- -right-90 in loc de 0-->
<div fixed-plugin-card class="z-sticky shadow-soft-3xl w-90 ease-soft -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white bg-clip-border px-2.5 duration-200">
<div class="px-6 pt-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
    <div class="float-left">
        <h5 class="mt-4 mb-0">JendiePlus Configurator</h5>
        <p>See our dashboard options.</p>
    </div>
    <div class="float-right mt-6">
        <button fixed-plugin-close-button class="inline-block p-0 mb-4 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:scale-102 leading-pro text-size-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 active:opacity-85 text-slate-700">
  <i class="fa fa-close"></i>
</button>
    </div>
    <!-- End Toggle Button -->
</div>
<hr class="h-px mx-0 my-1 bg-transparent bg-gradient-horizontal-dark" />
<div class="flex-auto p-6 pt-0 sm:pt-4">
    <!-- Sidebar Backgrounds -->
    <div>
        <h6 class="mb-0">Sidebar Colors</h6>
    </div>
    <a href="javascript:void(0)">
        <div class="my-2 text-left" sidenav-colors>
            <span class="py-2.2-em text-size-xs px-3.6-em rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-fuchsia relative inline-block cursor-pointer whitespace-nowrap border border-solid border-slate-700 text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                active-color data-color="fuchsia" onclick="sidebarColor(this)"></span>
            <span class="py-2.2-em text-size-xs px-3.6-em rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-dark-gray relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                data-color="dark-gray" onclick="sidebarColor(this)"></span>
            <span class="py-2.2-em text-size-xs px-3.6-em rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-cyan relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                data-color="cyan" onclick="sidebarColor(this)"></span>
            <span class="py-2.2-em text-size-xs px-3.6-em rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-lime relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                data-color="lime" onclick="sidebarColor(this)"></span>
            <span class="py-2.2-em text-size-xs px-3.6-em rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-orange relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                data-color="orange" onclick="sidebarColor(this)"></span>
            <span class="py-2.2-em text-size-xs px-3.6-em rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-red relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700"
                data-color="red" onclick="sidebarColor(this)"></span>
        </div>
    </a>
    <!-- Sidenav Type -->
    <div class="mt-4">
        <h6 class="mb-0">Sidenav Type</h6>
        <p class="leading-normal text-size-sm">Choose between 2 different sidenav types.</p>
    </div>
    <div class="flex">
        <button transparent-style-btn class="inline-block w-full px-4 py-3 mb-2 font-bold text-center text-white uppercase align-middle transition-all border border-transparent border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-fuchsia xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-fuchsia bg-fuchsia-500 hover:border-fuchsia-500"
            data-class="bg-transparent" active-style>Transparent</button>
        <button white-style-btn class="inline-block w-full px-4 py-3 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-fuchsia xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500"
            data-class="bg-white">White</button>
    </div>
    <p class="block mt-2 leading-normal text-size-sm xl:hidden">You can change the sidenav type just on desktop view.</p>
    <!-- Navbar Fixed -->
    <div class="mt-4">
        <h6 class="mb-0">Navbar Fixed</h6>
    </div>
    <div class="min-h-6 mb-0.5 block pl-0">
        <input class="rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5-em relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
            type="checkbox" navbarFixed />
    
<div class="w-full text-center ">
<br>
<h6 class="mt-4 ">Thank you for for TRUSTING us!</h6>
<!-- </br>
<a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20Tailwind%20made%20by%20%40CreativeTim&hashtags=webdesign,dashboard,tailwindcss&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard-tailwind
        " class="inline-block px-6 py-3 mb-0 mr-2 font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro text-size-xs ease-soft-in tracking-tight-soft
        shadow-soft-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700 " target="_blank "> <i class="mr-1 fab fa-twitter " aria-hidden="true "></i> Tweet </a>
<a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard-tailwind " class="inline-block px-6 py-3 mb-0 mr-2 font-bold text-center text-white uppercase align-middle transition-all border-0
        rounded-lg cursor-pointer hover:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700 " target="_blank "> <i class="mr-1
        fab fa-facebook-square " aria-hidden="true "></i> Share </a> -->
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