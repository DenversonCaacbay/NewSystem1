<?php 
    error_reporting(E_ALL ^ E_WARNING);
    require('classes/resident.class.php');

    //$view = $residentbmis->view_single_resident($email);
    $userdetails = $residentbmis->get_userdata();
    $residentbmis->resident_changepass();
    //print_r($userdetails);

    
    
?>


<!DOCTYPE html> 
<html>

    <head> 
    <title> Barangay Santa Rita Management System </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
        <!-- responsive tags for screen compatibility -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- custom css --> 
        <!-- bootstrap css --> 
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <!-- fontawesome icons --> 
        <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>

    <style>

.bg-primary{
    background: #309464 !important;
}
.text-primary{
    color: #309464 !important;
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
img{
    width: 150px;
    padding: 10px;
}
 .input-container {
        display: -ms-flexbox; /* IE10 */
        display: flex;
        width: 100%;
        margin-bottom: 10px;
        }

        .icon {
        padding: 15px;
        background: #309464 !important;
        color: white;
        min-width: 50px;
        text-align: center;
        }

        .input-field {
        width: 100%;
        padding: 10px;
        outline: none;
        }

        .input-field:focus {
        border: 2px solid dodgerblue;
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
.fa-home{
    color: #309464 ;
    background: #fff !important;
    padding: 10px;
    border-radius: 50px;
}

/* .fa-lock{
    color: #fff ;
    background: #309464 !important;
    padding: 10px;
} */

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

        <!-- Back-to-Top and Back Button -->

        <!--<a data-toggle="tooltip" title="Back-To-Top" class="top-link hide" href="" id="js-top">-->
        <!--    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 6"><path d="M12 6H0l6-6z"/></svg>-->
        <!--    <span class="screen-reader-text">Back to top</span>-->
        <!--</a>-->

        <!-- Eto yung navbar -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
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
                    <a href="login.php" class="btn btn-primary ml-2">Login</a>
                    <a href="resident_registration.php" class="btn btn-primary ml-2">Create an Account</a>
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


        <div id="down1"></div>

        <div class="container-fluid" style="margin-top: 2em;">
            <div class="row">
                <div class="col-md-12">

                    <br>

                    <div class="row margin mtop">
                        <div class="col-md-6 m-auto">   
                            <div class="card mbottom">
                            <div class="card-header bg-primary text-white text-center" style="font-size:30px"> Change Password </div>
                            <br>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <form method="post">
                                                
                                                <label> Current Password: </label>
                                                <div class="input-container">
                                                    <i class="fa fa-key icon"></i>
                                                    <input class="input-field" type="password" id="password-field" name="oldpassword" placeholder="Enter Current Password" required>
                                                    <span style="margin-left: 10px;margin-top:10px;" toggle="#password-field" class="fa fa-fw fa-eye field-icon text-primary 3toggle-password"></span>
                                                </div>

                                                <br>

                                                <label> New Password: </label>
                                                <div class="input-container">
                                                    <i class="fa fa-key icon"></i>
                                                    <input class="input-field" id="password1" type="password" name="newpassword" placeholder="Enter New Password" required>
                                                </div>
                                                
                                                <br>

                                                <label> Verify Password: </label>
                                                <div class="input-container">
                                                    <i class="fa fa-key icon"></i>
                                                    <input class="input-field" id="confirm_password" type="password" name="confirm_password" placeholder="Enter Verify Password" required>
                                                </div>

                                                <span id="message"></span>

                                                <br>
                                                <br>

                                                <button class="btn btn-primary w-100 p-3" type="submit" name="resident_changepass"> Change Password </button>
                                            </form>
                                        </div>  
                                    </div>   
                                </div>
                            </div>
                        </div> 

                    </div>
                </div>
            </div>
        </div>

        <br>

        <!-- Footer -->

       
        <script>
            $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
            input.attr("type", "text");
            } else {
            input.attr("type", "password");
            }
            });
        </script>

        <script>
            $('#password1, #confirm_password').on('keyup', function () {
            if ($('#password1').val() == $('#confirm_password').val()) {
                $('#message').html('New and Verify Password are match').css('color', 'green');
            } else 
                $('#message').html('New and Verify Password does not match').css('color', 'red');
            });
        </script>

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
