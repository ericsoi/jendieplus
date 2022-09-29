<?php
    if(isset($_GET["status"])){
        if ($_GET["status"] == "none"){
            echo "<script>alert('User does not exist')</script>";
        }if($_GET["status"] == "error"){
            echo "<script>alert('Internal Error. Try Again later')</script>";
        }if($_GET["status"] == "success"){
            echo "<script>alert('Password reset success')</script>";
            header ("Location: sign-in.php?status=success");
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>JendiePlus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="../assets/css/styles.css?v=1.0.3" rel="stylesheet" />

</head>

<body class="m-0 font-sans antialiased font-normal bg-white text-start text-size-base leading-default text-slate-500">

    <!-- Navbar -->
    <nav class="absolute top-0 z-30 flex flex-wrap items-center justify-between w-full px-4 py-2 mt-6 mb-4 shadow-none lg:flex-nowrap lg:justify-start">
        <div class="container flex items-center justify-between py-0 flex-wrap-inherit">
            <button navbar-trigger class="px-3 py-1 ml-2 leading-none transition-all bg-transparent border border-transparent border-solid rounded-lg shadow-none cursor-pointer text-size-lg ease-soft-in-out lg:hidden" type="button" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
          <span class="inline-block mt-2 align-middle bg-center bg-no-repeat bg-cover w-6-em h-6-em bg-none">
            <span bar1 class="w-5.5 rounded-xs duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
            <span bar2 class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
            <span bar3 class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
          </span>
        </button>
            <div navbar-menu class="items-center flex-grow transition-all ease-soft duration-350 lg-max:bg-white lg-max:max-h-0 lg-max:overflow-hidden basis-full rounded-xl lg:flex lg:basis-auto">
                <ul class="flex flex-col pl-0 mx-auto mb-0 list-none lg:flex-row xl:ml-auto">
                    
                  
                        <a class="block px-4 py-2 mr-2 font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out text-size-sm lg:px-2 lg:hover:text-white/75" href="../../../../index.php">  
                        <i class="mr-1 text-white lg-max:text-slate-700 fas fa-user-circle opacity-60"></i> Home
                        </a>
                    </li>
                    <li>
                        <a class="block px-4 py-2 mr-2 font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out text-size-sm lg:px-2 lg:hover:text-white/75" href="../pages/sign-in.php">
                            <i class="mr-1 text-white lg-max:text-slate-700 fas fa-key opacity-60"></i> Sign In
                        </a>
                    </li>
                </ul>
                <!-- online builder btn  -->
                <!-- <li class="flex items-center">
            <a
              class="leading-pro ease-soft-in border-white/75 text-size-xs tracking-tight-soft rounded-3.5xl hover:border-white/75 hover:scale-102 active:hover:border-white/75 active:hover:scale-102 active:opacity-85 active:shadow-soft-xs active:border-white/75 bg-white/10 hover:bg-white/10 active:hover:bg-white/10 mr-2 mb-0 inline-block cursor-pointer border border-solid py-2 px-8 text-center align-middle font-bold uppercase text-white shadow-none transition-all hover:text-white hover:opacity-75 hover:shadow-none active:scale-100 active:bg-white active:text-black active:hover:text-white active:hover:opacity-75 active:hover:shadow-none"
              target="#"
              href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053"
              >Online Builder</a
            >
          </li> -->
                <ul class="hidden pl-0 mb-0 list-none lg:block lg:flex-row">
                    <li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main class="mt-0 transition-all duration-200 ease-soft-in-out">
        <section class="min-h-screen mb-32">
            <div class="relative flex items-start pt-12 pb-56 m-4 overflow-hidden bg-center bg-cover min-h-50-screen rounded-xl" style="background-image: url('../assets/img/curved-images/curved14.jpg')">
                <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-dark-gray opacity-60"></span>
                <div class="container z-10">
                    <div class="flex flex-wrap justify-center -mx-3">
                        <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
                            <h1 class="mt-12 mb-2 text-white">Password Reset!</h1>
                            <p class="text-white">Reset Password.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="flex flex-wrap -mx-3 -mt-48 md:-mt-56 lg:-mt-48">
                    <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                        <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="p-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                                <h5>Reset</h5>
                            </div>
                            <div class="flex-auto p-6">
                                <form action="../../processor/handle_reset.php" method="POST" role="form text-left">
                                    <div class="mb-4">
                                        <input type="text" name="phone" id="phone" class="text-size-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                                            placeholder="Phone" aria-label="Name" aria-describedby="email-addon" onchange="checkPassword(this)" required />
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" name="password" id="password" class="text-size-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                                            placeholder="Password" aria-label="Name" aria-describedby="email-addon" onchange="checkPassword(this)" required />
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" name="c_password" id="c_password" class="text-size-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                                            placeholder="Password" aria-label="Password" aria-describedby="password-addon" onchange="checkPassword(this)" required />
                                    </div>
                                   
                                    <div class="min-h-6 mb-0.5 block pl-12">
                                        <input id="show" class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5-em relative float-left -ml-12 w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                                            type="checkbox" onchange="handlePasswords(this)"/>
                                        <label class="mb-2 ml-1 font-normal cursor-pointer select-none text-size-sm text-slate-700" for="show">Show Password</label>
                                    </div>
                                    <div class="min-h-6 pl-6.92-em mb-0.5 block">
                                        <input id="terms" name="terms" class="w-4.92-em h-4.92-em ease-soft -ml-6.92-em rounded-1.4 checked:bg-gradient-dark-gray after:text-size-fa-check after:font-awesome after:duration-250 after:ease-soft-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-200 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100"
                                            type="checkbox" checked required/>
                                        <label class="mb-2 ml-1 font-normal cursor-pointer select-none text-size-sm text-slate-700" for="terms"> Terms and Conditions </label>
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" name="btn_login" class="inline-block w-full px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
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
        <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    </main>
</body>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/soft-ui-dashboard-tailwind.js?v=1.0.3" async></script>
<script>
    function checkPassword(el){
        let phoneregex=/^[0-9]{10}$/g;
        if(el.id == 'phone'){
            if (!(el.value.match(phoneregex))) {
                document.getElementById(el.id).value = '';
                document.getElementById(el.id).placeholder="Enter a valid phone Number"; 
            }
        }
        if(el.id == 'c_password' || el.id == 'password' ){
            if(el.value.length < 6){
                document.getElementById(el.id).value = '';
                document.getElementById(el.id).placeholder="Password should not be less than 6 charecters"; 
            }else{
                if(el.id == 'c_password'){
                    let password = document.getElementById("password").value;
                    if(el.value !== password){
                        document.getElementById(el.id).value = '';
                        document.getElementById(el.id).placeholder="Passwords didnt match"; 
                    }
                }
            }
        }
    }
    function handlePasswords(el){
        console.log(el.checked);
        if(el.checked){
            document.getElementById('c_password').type = 'text';
            document.getElementById('password').type = 'text';
        }else{
            document.getElementById('c_password').type = 'password';
            document.getElementById('password').type = 'password';
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>