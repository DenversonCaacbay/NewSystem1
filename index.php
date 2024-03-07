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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
      <!-- responsive tags for screen compatibility -->
      <meta name="viewport" content="width=device-width, initial-scale=1"><!-- bootstrap css --> 
      <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
      <!-- fontawesome icons --> 
      <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>

        <!-- css & js for resident is on resident.class.php -->
    <style>

    /* Navbar Buttons */
.bg-primary{
        background: #309464 !important;
    }
    .btn-primary{
        background: #309464 !important;
        border: 0;
    }
.btn-primary:focus {
            outline: none !important;
        }
    h4{
        color: #309464 !important;
    }
    .btn1 {
    border-radius: 20px;
    border: none; /* Remove borders */
    color: white; /* White text */
    font-size: 16px; /* Set a font size */
    cursor: pointer; /* Mouse pointer on hover */
    /* margin-left: 16%; */
    padding: 12px 22px;
    }

    .btn2 {
    border-radius: 20px;
    border: none; /* Remove borders */
    color: white; /* White text */
    font-size: 16px; /* Set a font size */
    cursor: pointer; /* Mouse pointer on hover */
    padding: 12px 22px;
    margin-left: .1%;
    }

    .btn3 {
    border-radius: 20px;
    border: none; /* Remove borders */
    color: white; /* White text */
    font-size: 16px; /* Set a font size */
    cursor: pointer; /* Mouse pointer on hover */
    padding: 12px 22px;
    margin-left: .1%;
    }

    /* Darker background on mouse-over */
    /* .btn1:hover {
    background-color: #ffffff;
    color: black;
    }

    .btn2:hover {
    background-color: #ffffff;
    color: black;
    }

    .btn3:hover {
    background-color: #ffffff;
    color: black;
    } */

    .fa{
        color: #309464 ;
        background: #fff !important;
        padding: 10px;
        border-radius: 50px;
    }
    .fa-angle-left, .fa-angle-right {
        color: #309464 ;
        background: #fff !important;
        padding: 10px;
        border-radius: 50px;
    }
    .fas{
        color: #309464 ;
    }
    .card{
        border:none;
        box-shadow: 0px 7px 17px -3px rgba(0,0,0,0.36);
-webkit-box-shadow: 0px 7px 17px -3px rgba(0,0,0,0.36);
-moz-box-shadow: 0px 7px 17px -3px rgba(0,0,0,0.36);
    }
    .alert{
        height: 400px;
    }
    @media (max-width: 767px) {
    .alert {
        margin-top: 20%;
        height: auto; /* Set height to auto for mobile view */
        max-height: 400px; /* Optionally set a maximum height if needed */
        overflow-y: scroll; /* Add vertical scroll for overflow content */
    }
    .alert h3{
        font-size: 18px;
    }
    .col-lg-8 h4{
        font-size: 13px;
    }
    .col-lg-8 h3{
        font-size: 15px;
    }
    .icon-item{
        padding: none;
    }
    .header h2{
        font-size: 18px;
    }

    .header h3{
        font-size: 15px;
    }

}

    </style>
    <body> 

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
      <!-- Desktop version of the brand -->
      <a class="navbar-brand d-none d-lg-block" href="resident_homepage.php">Barangay Santa Rita Information & E-Services</a>

<!-- Mobile version of the brand -->
    <a class="navbar-brand d-lg-none" href="resident_homepage.php">BSRI&E-S</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav m-auto">
        <li class="nav-item px-3 icon-item">
            <a href="#down2" class="nav-link text-light btn1" data-toggle="tooltip" title="Announcement">
                <i class="fa fa-bullhorn fa-md d-none d-sm-inline"></i>
                <span class="d-inline d-sm-none">Announcement</span>
            </a>
        </li>
        <li class="nav-item px-3">
            <a href="#down1" class="nav-link text-light btn2" data-toggle="tooltip" title="E-Services">
                <i class="fa fa-edit fa-md d-none d-sm-inline"></i>
                <span class="d-inline d-sm-none">E-Services</span>
            </a>
        </li>
        <li class="nav-item px-3">
            <a href="#down" class="nav-link text-light btn3" data-toggle="tooltip" title="Contact">
                <i class="fa fa-phone fa-md d-none d-sm-inline"></i>
                <span class="d-inline d-sm-none">Contact</span>
            </a>
        </li>
    </ul>

 

        <div class="dropdown ml-auto">
            <?php if (empty($userdetails)) : ?>
                <a href="login.php" class="btn btn-primary ml-2">Login | Create an Account</a>
                <!-- <a href="resident_registration.php" class="btn btn-primary ml-2"></a> -->
            <?php else : ?>
                <button title="Your Account" class="btn btn-primary dropdown-toggle ml-2" type="button" data-toggle="dropdown">
                 <?= $userdetails['surname']; ?>, <?= $userdetails['firstname']; ?>
                    <span class="caret" style="margin-left: 2px;"></span>
                </button>
                <ul class="dropdown-menu" style="">
                    <a class="nav-link" href="resident_profile.php?id_resident=<?= $userdetails['id_resident']; ?>">
                        <i class="fas fa-user"> &nbsp; </i>Personal Profile
                    </a>
                    <a class="nav-link" href="resident_changepass.php?id_resident=<?= $userdetails['id_resident']; ?>">
                        <i class="fas fa-lock">&nbsp;</i>Change Password
                    </a>
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt">&nbsp;</i> Logout
                    </a>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>



<div class="container-fluid" style="margin-top:5%">
    <div id="down2"></div>
        <?php
        $view = $bmis->view_announcement();

        if ($view > 0) { ?>
            <div id="announcementCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">

                    <?php foreach ($view as $index => $announcement) { ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
                            <div class="alert bg-primary" style="color: white;">
                                        <div class="sticky-top bg-primary">
                                            <strong>
                                                <h3 class="text-center">ANNOUNCEMENT!<h3>
                                            </strong>
                                        </div>
                                
                                <hr>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <?php if (is_null($announcement['announcement_image'])): ?>
                                            <img id="blah" src="assets/default-thumbnail.jpg" class="text-center img-fluid">
                                        <?php else: ?>
                                            <div class="text-center">
                                                <img class="img-fluid" src="<?= $announcement['announcement_image'] ?>">
                                            </div>

                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-8">
                                        <h3 class="text-light">Title: <?= $announcement['announcement_title']; ?></h3>
                                        <h4 class="text-light">Description:<br> <?= $announcement['event']; ?></h4>
                                        <h4 class="text-light">Date and Time: <?= $announcement['announcement_datetime']; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>

                <!-- Add carousel controls -->
                <a class="carousel-control-prev" role="button" data-slide="prev" data-target="#announcementCarousel">
                    <span aria-hidden="true"><i class="fas fa-angle-left fa-2x"></i></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" role="button" data-slide="next" data-target="#announcementCarousel">
                    <span aria-hidden="true"><i class="fas fa-angle-right fa-2x"></i></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        <?php } else {
            // Handle case when there are no announcements
        } ?>

</div>


        <div id="down1"></div>


        <section class="heading-section mt-3"> 
            <div class="container text-center"> 
                <div class="row"> 
                    <div class="col"> 

                        <div class="header"> 
                            <h2> Welcome to Barangay Santa Rita Information & E-Services </h2><br>
                            <h3> You may select the following e-services offered below </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5"> 
                <div class="row title-spacing">
                    <div class="col"> 
                        <h3 class="text-center"> E-Services</h3>
                        <hr>
                    </div> 
                </div>
                
                <div class="row">
                    <div class="col-md-4 mt-2"> 
                        <a href="services_business.php" onclick="checkUserData(event)">
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
                        <a href="services_brgyid.php" onclick="checkUserData(event)">
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
                        <a href="services_certofindigency.php" onclick="checkUserData(event)">
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
                        <a href="services_certofres.php" onclick="checkUserData(event)"> 
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
                        <a href="services_brgyclearance.php" onclick="checkUserData(event)"> 
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


                <div class="row "> 
                    
                </div>
            </div>
        </section>
        <br>

        <br>
        <div id="down"></div>
        <div class="container-fluid bg-primary text-center text-light">
            <div class="row p-2">
                <div class="col-md-4 m-auto">
                    <h3>Services:</h3>
                    <p>Business Recommendation</p>
                    <p>Barangay ID</p>
                    <p>Certificate of Indigency</p>
                    <p>Certificate of Residency</p>
                    <p>Barangay Clearance</p>
                </div>
                <div class="col-md-4">
                    <h3>Contact:</h3>
                    <p>Barangay Hotline: 091111111</p>
                </div>
                <div class="col-md-4">
                    <h3>Developers:</h3>
                    <p> Charlene Turqueza | 09762866176</p>
                    <p>Dan Emmanuel Duarte | 09989120644</p>
                    <p>Jerika Soriano | 09661385889</p>
                </div>
            </div>
        </div>

        <!-- Footer -->

        <script>
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
        <script>
    document.querySelectorAll('[data-slide="prev"]').forEach(function (element) {
        element.addEventListener('click', function () {
            $('#announcementCarousel').carousel('prev');
        });
    });

    document.querySelectorAll('[data-slide="next"]').forEach(function (element) {
        element.addEventListener('click', function () {
            $('#announcementCarousel').carousel('next');
        });
    });
</script>
<script>
    // Initialize tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Hide tooltips on mobile devices
    if (window.innerWidth <= 576) {
        $('[data-toggle="tooltip"]').tooltip('disable');
    }
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
        <script>
            function checkUserData(event) {
                // Assuming $userdata is a JavaScript variable containing user data
                var userdata = <?php echo json_encode($userdetails); ?>;

                // Check if userdata is empty or null
                if (!userdata) {
                    // Prevent the link from navigating
                    event.preventDefault();

                    // Show an alert
                    alert('Please login first.');
                }
            }
        </script>
    </body>
</html>
