<?php 
    error_reporting(E_ALL ^ E_WARNING);
    include('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $requests = $residentbmis->view_request($userdetails['id_resident']);

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
        padding: 12px 22px;
    }

    .pill-pending{
        background: #ffc107;
        color: #fff;
        padding: 5px;
        font-size: 13px;
        border-radius: 15px;
    }
    .pill-primary{
        background: #309464 ;
        color: #fff;
        padding: 5px;
        font-size: 13px;
        border-radius: 15px;
    }
    .pill-danger{
        background: #dc3545;
        color: #fff;
        padding: 5px;
        font-size: 13px;
        border-radius: 15px;
    }
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
                <a href="index.php" class="nav-link text-light btn1" data-toggle="tooltip" title="Home">
                    <i class="fa fa-home fa-md d-none d-sm-inline"></i>
                    <span class="d-inline d-sm-none">Home</span>
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
    <h3>Requests</h3>
    <div class="card mt-3 mb-3">
        <div class="card-header bg-primary text-light d-flex justify-content-between">
            Date Requested: January 1,1999
            <button class="btn btn-danger"><i class="fas fa-trash text-white"></i></button>
        </div>
        <div class="card-body">
            <h3 class="card-h1">Barangay Clearance</h3>
            <h5>Pick Up Date: January 1,1999</h5>
            <h5>Status: <span class="pill-pending">Pending</span></h5>
        </div>
    </div>
    <div class="card mt-3 mb-3">
        <div class="card-header bg-primary text-light d-flex justify-content-between">
            Date Requested: January 1,1999
            <button class="btn btn-danger"><i class="fas fa-trash text-white"></i></button>
        </div>
        <div class="card-body">
            <h3 class="card-h1">Barangay Clearance</h3>
            <h5>Pick Up Date: January 1,1999</h5>
            <h5>Status: <span class="pill-primary">Done</span></h5>
        </div>
    </div>
    <div class="card mt-3 mb-3">
        <div class="card-header bg-primary text-light d-flex justify-content-between">
            Date Requested: January 1,1999
            <button class="btn btn-danger"><i class="fas fa-trash text-white"></i></button>
        </div>
        <div class="card-body">
            <h3 class="card-h1">Barangay Clearance</h3>
            <h5>Pick Up Date: January 1,1999</h5>
            <h5>Status: <span class="pill-danger">Reject</span></h5>
        </div>
    </div>
</div>

        <!-- <div id="down"></div>
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
        </div> -->

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
