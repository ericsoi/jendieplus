<?php include "nav/header.php";?>
    <!-- End Header 1-->

    <!-- SubHeader =============================================== -->
    <section class="parallax_window_in" data-parallax="scroll" data-image-src="img/about_us.jpg" data-natural-width="1400" data-natural-height="470">
        <div id="sub_content_in">
            <div id="animate_intro">
                <h1>About JendiePlus</h1>

            </div>
        </div>
    </section>
    <!-- End section -->
    <!-- End SubHeader ============================================ -->

    <section class="wrapper">
        <div class="divider_border"></div>

        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <h3>The Platform</h3>
                    <p>JendiePlus is an Insuretech platform that offers seamless, automated and simple processes for all Motor Insurance solutions accessible to Insurance agents In partnership with Insurance Companies in Kenya. This product is developed
                        by JendiePlus Technologies.
                        <br><br> The company has its headquarters in Nairobi with interest across the country and neighboring countries. The company offers wide range of Insurance and Technology solutions in partnership with Major Insurance companies
                        locally.<br><br> We are a subsidiary of <strong>Jendie Automobile Limited</strong> a leader in Vehicle speed limiter and Vehicle tracking solutions.
                        <br><br>
                        <h3>Our <span>Values</span></h3>
                        <h4>• INTEGRITY
                            <br>• INNOVATION
                            <br>• RESPONSIBILITY
                            <br>• HONESTY
                            <br>• ENVIROMENTAL CARE
                            <br>• CUSTOMER CENTRIC

                        </h4>
                    </p>
                </div>

            </div>
            <!-- End row -->


            <!-- End container -->
    </section>
    <!-- End section -->

    <div class="container margin_60">

        <!-- end banner -->
    </div>
    <!-- end container -->

	<?php include "nav/footer.php"?>;
    <!-- End footer -->

    <div id="toTop"></div>
    <!-- Back to top button -->

    <!-- Search Menu -->
    <div class="search-overlay-menu">
        <span class="search-overlay-close"><i class="icon_close"></i></span>
        <form role="search" id="searchform" method="get">
            <input value="" name="q" type="search" placeholder="Search..." />
            <button type="submit"><i class="icon-search-6"></i>
			</button>
        </form>
    </div>
    <!-- End Search Menu -->

    <!-- COMMON SCRIPTS -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/common_scripts_min.js"></script>
    <script src="assets/validate.js"></script>
    <script src="js/jquery.tweet.min.js"></script>
    <script src="js/functions.js"></script>

    <!-- SPECIFIC SCRIPTS -->
    <script>
        'use strict';
        $(".team-carousel").owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            autoplay: false,
            smartSpeed: 300,
            responsiveClass: false,
            responsive: {
                320: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                1000: {
                    items: 3,
                }
            }
        });
    </script>

</body>

</html>