<?php 
    error_reporting(E_ALL ^ E_WARNING);
    include('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    // $requests = $residentbmis->view_request($userdetails['id_resident']);
    $requests_decline = $residentbmis->view_request_decline($userdetails['id_resident']);

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
    .tabs--div{
        background: #309464 !important;
        padding:5px 5px;
        border-radius: 10px;
    }
    .request--btn{
        width:33.3%;
        border:none;
        font-weight: bold;
        letter-spacing: 3px !important;
        color: #fff !important;
        
    }
    .request--btn:hover{
        color: #309464 !important;
        background-color: #fff !important;
        
    }
    .request--btn.active{
        color: #309464 !important;
        background-color: #fff !important;
    }
    .request--container{
        margin-top:5%;
    }

    @media (max-width: 767px) {
    .request--container{
        margin-top:20%;
    }
    .request--btn{
        width:33.3%;
        border:none;
        font-weight: bold;
        letter-spacing: 0px !important;
        color: #fff !important;
        
    }
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
         
        <a class="navbar-brand d-none d-lg-block" href="resident_homepage.php">Barangay Santa Rita Information & E-Services</a>

        <a class="navbar-brand d-lg-none" href="resident_homepage.php">BSRI&E-S</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
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
<div class="container-fluid request--container">
    <div class="tabs--div d-flex justify-content-between">
        <a href="request_pending.php" class="btn request--btn ">PENDING</a>
        <a href="request_approved.php" class="btn request--btn">APPROVED</a>
        <a href="request_done.php" class="btn request--btn">DONE</a>
        <a href="request_declined.php" class="btn request--btn active">DECLINED</a>
    </div>
    
    <div class="row mt-3">
    <?php 
    // Check if requests are available and sort them by date in descending order
    if(is_array($requests_decline)) {
        // Combine all request data into one array
        $all_requests = [];
        foreach($requests_decline as $request_data) {
            $all_requests = array_merge($all_requests, $request_data);
        }

        // Sort all requests by date in descending order
        usort($all_requests, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        // Iterate over sorted requests and display them
        foreach($all_requests as $request) {?>
            <div class="col-md-4">
                <div class="card mt-3 mb-3">
                    <div class="card-header bg-primary text-light d-flex justify-content-between">
                        Date Requested: <?= ucfirst(date("F d, Y", strtotime($request['date']))); ?>
                    </div>
                    <div class="card-body">
                        <?php 
                        // Display common request fields
                        if($request['id_brgyid']) { ?>
                            <h3 class="card-h1">Barangay ID</h3>
                            <h5>Street: <?= $request['street'];?><?= $request['brgy'];?></h5>
                        <?php } elseif($request['id_bspermit']) { ?>
                            <h3 class="card-h1">Business Recommendation</h3>
                            <h5>Business Name: <?= $request['bsname'];?></h5>
                        <?php } elseif($request['id_clearance']) { ?>
                            <h3 class="card-h1">Barangay Clearance</h3>
                            <h5>Purpose: <?= $request['purpose'];?></h5>
                        <?php } elseif($request['id_indigency']) { ?>
                            <h3 class="card-h1">Indigency</h3>
                            <h5>Purpose: <?= $request['purpose'];?></h5>
                        <?php } elseif($request['id_rescert']) { ?>
                            <h3 class="card-h1">Residency</h3>
                            <h5>Purpose: <?= $request['purpose'];?></h5>
                        <?php } ?>
                        <h5>Status: <span class="pill-danger"><?= $request['form_status'];?></span></h5>
                        <!-- Add more fields as needed -->
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>

</div>


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
