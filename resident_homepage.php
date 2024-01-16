<?php 
    error_reporting(E_ALL ^ E_WARNING);
    include('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();

    $dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
    $tm = new DateTime("now", new DateTimeZone('Asia/Manila'));
    $cdate = $dt->format('Y/m/d');
    $ctime = $tm->format('H');

?>



<script> 
    function logout() {
    window.location.href = "logout.php";
    }
    function profile() {
    window.location.href = "resident_profile.php";
    }
</script>


<!DOCTYPE html> 
<html>

    <head> 
        <title> Barangay Santa Rita Information & E-Services </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- css & js for resident is on resident.class.php -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>

    /* Navbar Buttons */
    .bg-primary{
        background: #309464 !important;
    }
    .btn-primary{
        background: #309464 !important;
    }
    body::-webkit-scrollbar {
            display: none;
        }
        .top-link {
    transition: all 0.25s ease-in-out;
    position: fixed;
    bottom: 0;
    right: 0;
    display: inline-flex;
    cursor: pointer;
    align-items: center;
    justify-content: center;
    margin: 0 3em 3em 0;
    border-radius: 50%;
    padding: 0.25em;
    width: 80px;
    height: 80px;
    background-color: #3661D5;
    }
    .top-link.show {
    visibility: visible;
    opacity: 1;
    }
    .top-link.hide {
    visibility: hidden;
    opacity: 0;
    }
    .top-link svg {
    fill: white;
    width: 24px;
    height: 12px;
    }
    .top-link:hover {
    background-color: #3498DB;
    }
    .top-link:hover svg {
    fill: #000000;
    }

    .screen-reader-text {
    position: absolute;
    clip-path: inset(50%);
    margin: -1px;
    border: 0;
    padding: 0;
    width: 1px;
    height: 1px;
    overflow: hidden;
    word-wrap: normal !important;
    clip: rect(1px, 1px, 1px, 1px);
    }
    .screen-reader-text:focus {
    display: block;
    top: 5px;
    left: 5px;
    z-index: 100000;
    clip-path: none;
    background-color: #eee;
    padding: 15px 23px 14px;
    width: auto;
    height: auto;
    text-decoration: none;
    line-height: normal;
    color: #444;
    font-size: 1em;
    clip: auto !important;
    }

    /* E-Services Zoom */

    /* .zoom1 {
    transition: transform .3s;
    }

    .zoom1:hover {
    -ms-transform: scale(1.1); 
    -webkit-transform: scale(1.1); 
    transform: scale(1.1); 
    } */

    /* Footer Style */
    
    .footerlinks{
        color:white;
        }
    .shfooter .collapse {
        display: inherit;
    }
        @media (max-width:767px) {
    .shfooter ul {
            margin-bottom: 0;
    }

    .shfooter .collapse {
            display: none;
    }

    .shfooter .collapse.show {
            display: block;
    }

    .shfooter .title .fa-angle-up,
    .shfooter .title[aria-expanded=true] .fa-angle-down {
            display: none;
    }

    .shfooter .title[aria-expanded=true] .fa-angle-up {
            display: block;
    }

    .shfooter .navbar-toggler {
            display: inline-block;
            padding: 0;
    }

    }

    .resize {
        text-align: center;
    }
    .resize {
        margin-top: 3rem;
        font-size: 1.25rem;
    }
    /*RESIZESCREEN ANIMATION*/
    .fa-angle-double-right {
        animation: rightanime 1s linear infinite;
    }

    .fa-angle-double-left {
        animation: leftanime 1s linear infinite;
    }
    @keyframes rightanime {
        50% {
            transform: translateX(10px);
            opacity: 0.5;
    }
        100% {
            transform: translateX(10px);
            opacity: 0;
    }
    }
    @keyframes leftanime {
        50% {
            transform: translateX(-10px);
            opacity: 0.5;
    }
        100% {
            transform: translateX(-10px);
            opacity: 0;
    }
    }

    /* Contact Chip */

    .chip {
    display: inline-block;
    padding: 0 25px;
    height: 50px;
    line-height: 50px;
    border-radius: 25px;
    background-color: #2C54C1;
    margin-top: 5px;
    }

    .chip img {
    float: left;
    margin: 0 10px 0 -25px;
    height: 50px;
    width: 50px;
    border-radius: 50%;
    }




    /* Contact Chip */
    @media (min-width: 768px) {
            /* Display "desk" class on medium and larger screens (desktop) */
            .mob {
                display: none;
            }
            
        }

        @media (max-width: 767.98px) {
            /* Display "mob" class on smaller screens (mobile) */
            .desk {
                display: none;
            }
        }

    </style>
    <body> 

        <!-- Back-to-Top and Back Button -->

        <!-- <a data-toggle="tooltip" title="Back-To-Top" class="top-link hide" href="" id="js-top">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 6"><path d="M12 6H0l6-6z"/></svg>
            <span class="screen-reader-text">Back to top</span>
        </a> -->

        <!-- Eto yung navbar -->

        <nav class="navbar navbar-dark navbar-expand-lg bg-primary sticky-top">
            <div class="container-fluid w-100">
                <!-- Desktop view -->
                <a class="navbar-brand desk ms-3 d-none d-lg-block" style="color: white;">Barangay Santa Rita Information & E-Services</a>

                <!-- Mobile view -->
                <a class="navbar-brand mob mx-auto d-lg-none" style="color: white;">BSRI & E-Services</a>

                <div class="dropdown ml-auto me-3">
                    <a title="Your Account" class="nav-link text-white dropdown-toggle" style="margin-right: 2px;" type="button" data-toggle="dropdown">
                        <?= $userdetails['surname'];?>, <?= $userdetails['firstname'];?>
                        <span class="caret" style="margin-left: 2px;"></span>
                    </a>
                    <ul class="dropdown-menu" style="width: 175px; right: 0;" >
                        <a class="btn" href="resident_profile.php?id_resident=<?= $userdetails['id_resident'];?>"> <i class="fas fa-user"> &nbsp; </i>Personal Profile  </a>
                        <a class="btn" href="resident_changepass.php?id_resident=<?= $userdetails['id_resident'];?>"> <i class="fas fa-lock" >&nbsp;</i> Change Password  </a>
                        <a class="btn" href="logout.php"> <i class="fas fa-sign-out-alt">&nbsp;</i> Logout  </a>
                    </ul>
                </div>
            </div>            
        </nav>


        <?php 
            $view = $bmis->view_announcement();

            if($view > 0 ) { ?>
            <table class="table table-dark table-responsive">
                <thead style="display:none;"> 
                    <tr>
                        <th> Announcement </th>
                    </tr>
                </thead>
                <tbody style="display:none"> 
                <?php if(is_array($view)) {?>
                    <?php foreach($view as $view) {?>
                        <tr>
                            <td> <?= $view['event'];?> </td>             
                        </tr>
                    <?php }?>
                <?php } ?>
                </tbody>
            </table>

            <div class="container">
                <div class="alert alert-primary bg-primary alert-dismissible fade show" role="alert"
                 style="margin-top: 4%; 
                        margin-bottom: 1.5%;
                        border-radius:20px; 
                        width:100%;
                        color: white;">
                <strong><h5 class="text-center">ANNOUNCEMENT!<h3></strong> 
                <hr class="w-100"> 
                <p style="font-size: 18px;"> 
                    <?= $view['event'];?> 
                </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            </div>
            

        <?php 
            }

            else {
            
            }

        ?>



            <div class="container text-center"> 
                <div class="row"> 
                    <div class="col"> 
                        <div class="header"> 
                            <h2> Welcome to Barangay Santa Rita Information & E-Services </h2><bR>
                            <h3> You may select the following e-services offered below </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container"> 
                <div class="row">
                    <div class="col-md-12"> 
                        <h2 class="text-center"> E-Services</h2>
                        <hr class="w-100">
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-4 mt-2"> 
                        <a style="text-decoration:none;" href="services_business.php">
                            <div class="zoom1"> 
                                <div class="card"> 
                                    <div class="card-body text-center"> 
                                        <img src="icons/ResidentHomepage/busper.png">
                                        <h4> Business Recommendation </h4> 
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mt-2"> 
                        <a style="text-decoration:none;" href="services_brgyid.php">
                            <div class="zoom1">
                                <div class="card"> 
                                    <div class="card-body text-center"> 
                                        <img style="height: 139px;" src="icons/ResidentHomepage/brgyid.png">
                                        <h4> Barangay ID </h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mt-2"> 
                        <a style="text-decoration:none;" href="services_certofindigency.php">
                            <div class="zoom1">
                                <div class="card"> 
                                    <div class="card-body text-center"> 
                                        <img src="icons/ResidentHomepage/indigency.png">
                                        <h4> Certificate of Indigency </h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 mt-2">
                        <a style="text-decoration:none;" href="services_certofres.php"> 
                        <div class="zoom1">    
                            <div class="card"> 
                                <div class="card-body text-center"> 
                                <img src="icons/ResidentHomepage/residency.png">
                                    <h4> Certificate of Residency </h4>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-6 mt-2">
                        <a style="text-decoration:none;" href="services_brgyclearance.php"> 
                        <div class="zoom1">    
                            <div class="card"> 
                                <div class="card-body text-center">
                                <img src="icons/ResidentHomepage/clearance.png"> 
                                    <h4> Barangay Clearance </h4>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

            </div>

        <br>
        <br>
        <br>

        <!-- Footer -->
        
            <!--/.Footer Links-->

          

       

        <script>
            // Set a variable for our button element.
            const scrollToTopButton = document.getElementById('js-top');

            // Let's set up a function that shows our scroll-to-top button if we scroll beyond the height of the initial window.
            const scrollFunc = () => {
            // Get the current scroll value
            let y = window.scrollY;
            
            // If the scroll value is greater than the window height, let's add a class to the scroll-to-top button to show it!
            if (y > 0) {
                scrollToTopButton.className = "top-link show";
            } else {
                scrollToTopButton.className = "top-link hide";
            }
            };

            window.addEventListener("scroll", scrollFunc);

            const scrollToTop = () => {
            // Let's set a variable for the number of pixels we are from the top of the document.
            const c = document.documentElement.scrollTop || document.body.scrollTop;
            
            // If that number is greater than 0, we'll scroll back to 0, or the top of the document.
            // We'll also animate that scroll with requestAnimationFrame:
            // https://developer.mozilla.org/en-US/docs/Web/API/window/requestAnimationFrame
            if (c > 0) {
                window.requestAnimationFrame(scrollToTop);
                // ScrollTo takes an x and a y coordinate.
                // Increase the '10' value to get a smoother/slower scroll!
                window.scrollTo(0, c - c / 10);
            }
            };

            // When the button is clicked, run our ScrolltoTop function above!
            scrollToTopButton.onclick = function(e) {
            e.preventDefault();
            scrollToTop();
            }
        </script>

        <script>
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>

        <script>
            $(document).ready(function(){
            // Add smooth scrolling to all links
            $("a").on('click', function(event) {

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
                } // End if
            });
            });
        </script>

        <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>
    </body>
</html>
