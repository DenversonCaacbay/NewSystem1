<?php 
    require('classes/main.class.php');
    require('classes/resident.class.php');
    
    $userdetails = $bmis->get_userdata();
    $bmis->create_brgyclearance();

?>

<!DOCTYPE html>

<html>
  <head> 
    <title> Barangay Santa Rita Management System </title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
      <!-- responsive tags for screen compatibility -->
      <meta name="viewport" content="width=device-width, initial-scale=1"><!-- bootstrap css --> 
      <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
      <!-- fontawesome icons --> 
      <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
  
        <style>
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
img{
    width: 150px;
    padding: 10px;
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
  </head>

    <body>
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
                <li class="nav-item px-3">
                    <a href="#down1" class="nav-link text-light btn2" data-toggle="tooltip" title="Registrations">
                        <i class="fa fa-edit fa-md d-none d-sm-inline"></i>
                        <span class="d-inline d-sm-none">Registration</span>
                    </a>
                </li>
                <li class="nav-item px-3 icon-item">
                    <a href="#down2" class="nav-link text-light btn1" data-toggle="tooltip" title="Procedure">
                        <i class="fa fa-question fa-md d-none d-sm-inline"></i>
                        <span class="d-inline d-sm-none">Procedure</span>
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
        <div class="container-fluid text-center mt-3"> 
            <div class="row"> 
                <div class="col"> 
                    <div class="header">
                        <h1 class="text1">Barangay Clearance </h1>
                        <h5> A Barangay Clearance is a document issued by the Barangay Secretary and signed by the 
                        <br> Barangay Captain stating that you are a living at that specific place and you are 
                        <br> of good moral character. Somehow, a smaller version of NBI or Police clearance.</h5>
                    </div>


                    <img src="icons/Documents/santaritalogo.png">
                    <img src="icons/Documents/rnplogo.png">
                    <img src="icons/Documents/sklogo.png">
                </div>
            </div>
        </div>

        <div id="down1"></div>

    <div class="container mt-5">

    <h1 class="text-center">Request Form</h1>
    <hr style="background-color:black;">

    <div class="col">   
        <button type="button" class="btn btn-primary applybutton p-4 w-100" data-toggle="modal" data-target="#exampleModalCenter">
            Request Form
        </button>
    </div>


    <!-- Modal -->

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Barangay Clearance Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Body -->

                <div class="modal-body">
                    <form method="post" class="was-validated" enctype="multipart/form-data">

                        <div class="row"> 

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lname">Last Name:</label>
                                    <input name="lname" type="text" class="form-control" 
                                    placeholder="Enter Last Name" value="<?= $userdetails['surname']?>" readonly>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fname">First Name:</label>
                                    <input name="fname" type="text" class="form-control" 
                                    placeholder="Enter First Name" value="<?= $userdetails['firstname']?>" readonly>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mi">Middle Name </label>
                                    <input name="mi" type="text" class="form-control" 
                                    placeholder="Enter Middle Name" value="<?= $userdetails['mname']?>" readonly>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="purposes">Purposes:</label>
                                    <select class="form-control" name="purpose" onchange="checkOptions(this)" id="purposes" placeholder="Enter Status" required>
                                        <option value="">Choose your Purpose</option>
                                        <option value="Job Requirement">Job Requirement</option>
                                        <option value="Open a Bank Account">Open a Bank Account</option>
                                        <option value="NBI Clearance">NBI Clearance</option>
                                        <option value="Police Clearance">Police Clearance</option>
                                        <option value="Postal ID">Postal ID</option>
                                        <option value="UMID Card">UMID Card</option>
                                        <option value="Driver's License">Driver's License</option>
                                        <option value="Business Requirement">Business Requirement</option>
                                        <option value="Philhealth">Philhealth</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>

                                <!-- other -->
                                <div class="form-group" id="otherDiv" style="display: none">
                                    <input type="text" class="form-control" name="otherInput" id='otherInput' placeholder="Enter Other" style="display: none" />
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> House No: </label>
                                    <input type="text" class="form-control" name="houseno"  
                                    placeholder="Enter House No." value="<?= $userdetails['houseno']?>"  readonly>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Street: </label>
                                    <input type="text" class="form-control" name="street"  
                                    placeholder="Enter Street" value="<?= $userdetails['street']?>" readonly>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Barangay: </label>
                                    <input type="text" class="form-control" name="brgy"  
                                    placeholder="Enter Barangay" value="<?= $userdetails['brgy']?>" readonly>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Municipality: </label>
                                    <input type="text" class="form-control" name="municipal" 
                                    placeholder="Enter Municipality" value="<?= $userdetails['municipal']?>" readonly>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">Civil Status:</label>
                                    <select class="form-control" name="status" id="status" placeholder="Enter Status" required>
                                    <option value="">Choose your Status</option>
                                    <option value="Single">Single</option>
                                        <option value="In a relationship">In a relationship</option>
                                        <option value="Engaged">Engaged</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Divorces">Divorced</option>
                                    </select>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="mtop">Pick-Up Date: </label>
                                            <input type="date" id="myDateInput" onchange="checkDateValidity('myDateInput')"  class="form-control" name="date" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                        </div>

                        <hr>

                        <h6>Guidelines for Supporting Evidence Photo:</h6>

                        <p>
                            <ul style="font-size: 15px;">
                                <li>
                                    Good quality photo.
                                </li>
                                <li>
                                    At least 50KB and no more than 50MB.
                                </li>
                                <li>
                                    File Format: JPEG or PNG
                                </li>
                                <li>
                                    Clear and in focus.
                                </li>
                            </ul>
                        </p>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Supporting Evidence Photo:</label>
                                <div class="custom-file form-group">
                                    <input type="file" onchange="readURL(this);" class="custom-file-input" id="customFile" name="brgyclearance_photo" required>
                                    <label class="custom-file-label" for="customFile">Choose File Photo</label>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <label>Photo Display:</label>
                                <img id="blah" src="http://placehold.it/470x350" alt="your image" />
                            </div>
                        </div>
                    
                </div>

                <!-- Modal Footer -->
    
                <div class="modal-footer">
                    <div class="paa">
                        <input name="id_resident" type="hidden" class="form-control" value="<?= $userdetails['id_resident']?>">
                        <input name="addedby" type="hidden" class="form-control" value="<?= $userdetails['surname']?> <?= $userdetails['firstname']?> <?= $userdetails['mname']?>">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button name ="create_brgyclearance" type="submit" class="btn btn-primary">Submit Request</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
</form>

        <div id="down2"></div>
        <div class="container mt-5 text-center">
            <div class="row">
                <div class="col">
                    <h1>Procedure</h1>
                    <hr style="background-color: black;">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-4">
                    <i class="fas fa-laptop fa-7x"></i>

                    <br>
                    <br>

                    <h3>Step 1: Fill-Up</h3>
                    <p>The first step is to fill out the entire form in our system.</p>
                </div>

                <div class="col-md-4">
                    <i class="fas fa-user-check fa-7x"></i>

                    <br>
                    <br>

                    <h3>Step 2: Assessment</h3>
                    <p>The second step is to verify all the information you've provided in our system to ensure the accuracy of your document.</p>
                </div>

                <div class="col-md-4">
                    <i class="fas fa-file fa-7x"></i>

                    <br>
                    <br>

                    <h3>Step 3: Release</h3>
                    <p>The third step involves the release of your document.</p>
                </div>
            </div>
        </div>




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
