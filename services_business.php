<?php 
    error_reporting(E_ALL ^ E_WARNING);
    require('classes/main.class.php');
    require('classes/resident.class.php');
    
    $userdetails = $bmis->get_userdata();
    $bmis->create_bspermit();

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
  
        <!-- <link rel="stylesheet" href="css/services-navbar.css"> -->
        
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

    <div class="container-fluid"> 
        <div class="row mt-3"> 
            <div class="col-md-12 text-center p-3">   
                <h1 class="text1">Business Recommendation (Mayor's Permit) </h1>
                <h5 class="mb-3"> Before you can start operating your business in the Philippines, you need to secure 
                <br> a Mayor’s Permit or Business Permit from the Local Government Unit (LGU) where your 
                <br> company office is located. </h5>
                <img src="icons/Documents/santaritalogo.png">
                <img src="icons/Documents/rnplogo.png">
                <img src="icons/Documents/sklogo.png">
            </div>
        </div>
    </div>

        <div id="down1"></div>

        <!-- Button trigger modal -->

        <div class="container">

            <h1 class="text-center">Request Form</h1>
            <hr style="background-color:black;">

            <div class="col">   
                <button type="button" class="btn btn-primary applybutton w-100 mb-5 p-3" data-toggle="modal" data-target="#exampleModalCenter">
                    Request Form
                </button>
            </div>


            <!-- Modal -->

            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Business Permit Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="was-validated" enctype="multipart/form-data">
                                <div class="row"> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lname" class="mtop">Last Name:</label>
                                            <input name="lname" type="text" class="form-control" value="<?= $userdetails['surname'];?>" readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fname" class="mtop">First Name:</label>
                                            <input name="fname" type="text" class="form-control" value="<?= $userdetails['firstname'];?>" readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mi" class="mtop">Middle Name </label>
                                            <input name="mi" type="text" class="form-control" value="<?= $userdetails['mname'];?>"  readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bsname">Business Name:</label>
                                            <input name="bsname" type="text" class="form-control" placeholder="Enter Business Name" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                <h6>Business Address:</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Purok: </label>
                                            <select id="purokDropdown" class="form-select" onchange="showStreets(this.value)" name="houseno" aria-label="Default select example" required>
                                                <option value="" selected>Select Purok</option>
                                                <option value="1A">1A</option>
                                                <option value="1B">1B</option>
                                                <option value="2">2</option>
                                                <option value="3A">3A</option>
                                                <option value="3B">3B</option>
                                                <option value="3C">3C</option>
                                                <option value="3E">3E</option>
                                                <option value="3F">3F</option>
                                                <option value="4A">4A</option>
                                                <option value="4B">4B</option>
                                                <option value="4C">4C</option>
                                                <option value="4D">4D</option>
                                                <option value="5A">5A</option>
                                                <option value="5A-1">5A-1</option>
                                                <option value="5B">5B</option>
                                                <option value="5C">5C</option>
                                                <option value="5D">5D</option>
                                                <option value="5E">5E</option>
                                                <option value="5F">5F</option>
                                                <option value="6A">6A</option>
                                                <option value="6AEXT">6AEXT</option>
                                                <option value="6B1">6B1</option>
                                                <option value="6B2">6B2</option>
                                                <option value="6C1">6C1</option>
                                                <option value="6C2">6C2</option>
                                                <option value="6D">6D</option>
                                                <option value="6E">6E</option>
                                                <option value="7">7</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Street: </label>
                                            <select id="streetsDropdown" class="form-select" name="street" disabled required style="text-transform: none !important;">
                                                <option value="" disabled selected>Select Street</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Barangay: </label>
                                            <input type="text" class="form-control" name="brgy"  placeholder="Enter Barangay" value="<?= $userdetails['brgy'];?>"  readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Municipality: </label>
                                            <input type="text" class="form-control" name="municipal" placeholder="Enter Municipality" value="<?= $userdetails['municipal'];?>"  readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status" class="mtop">Business Industry:</label>
                                            <select class="form-control" name="bsindustry" id="status" placeholder="Enter Status" required>
                                            <option value="">Choose your Business Industry</option>
                                                <option value="Computer">Computer</option>
                                                <option value="Telecommunication">Telecommunication</option>
                                                <option value="Agriculture">Agriculture</option>
                                                <option value="Construction">Construction</option>
                                                <option value="Education">Education</option>
                                                <option value="Pharmaceutical">Pharmaceutical</option>
                                                <option value="Food">Food</option>
                                                <option value="HealthCare">HealthCare</option>
                                                <option value="Hospitality">Hospitality</option>
                                                <option value="Entertainment">Entertainment</option>
                                                <option value="News Media">News Media</option>
                                                <option value="Energy">Energy</option>
                                                <option value="Manufacturing">Manufacturing</option>
                                                <option value="Music">Music</option>
                                                <option value="Mining">Mining</option>
                                                <option value="WorldWide Web">WorldWide Web</option>
                                                <option value="Electronics">Electronics</option>
                                                <option value="Transport">Pharmaceutical</option>
                                                <option value="Transport">Aerospace</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="aoe" class="mtop">Area of Establishment (SqM): </label>
                                            <input type="number" name="aoe" class="form-control" placeholder="Enter your AOE" required>
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

                                <hr class="w-100">

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
                                    <div class="col">
                                        <label>Supporting Evidence Photo:</label>
                                        <div class="custom-file form-group">
                                            <input type="file" onchange="readURL(this);" class="custom-file-input" id="customFile" name="bspermit_photo" required>
                                            <label class="custom-file-label" for="customFile">Choose File Photo</label>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col">
                                        <label>Photo Display:</label>
                                        <img id="blah" src="http://placehold.it/470x350" alt="your image" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="paa">
                                        <input name="id_resident" type="hidden" class="form-control" value="<?= $userdetails['id_resident']?>">
                                        
                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                        <button name ="create_bspermit" type="submit" class="btn btn-primary">Submit Request</button>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <div id="down2"></div>

        <br>

        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-md-12">
                    <h1>Procedure</h1>
                    <hr style="background-color: black;">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <i class="fas fa-id-card fa-7x"></i>

                    <br>
                    <br>

                    <h3>Step 1: Preparation</h3>
                    <p>The first step is to gather all the necessary information required for acquiring a business permit.</p>
                </div>

                <div class="col-md-3">
                    <i class="fas fa-laptop fa-7x"></i>

                    <br>
                    <br>

                    <h3>Step 2: Fill-Up</h3>
                    <p>The second step involves completing the entire form in our system.</p>
                </div>

                <div class="col-md-3">
                    <i class="fas fa-user-check fa-7x"></i>

                    <br>
                    <br>

                    <h3>Step 3: Assessment</h3>
                    <p>The third step, verify all the information provided in our system to ensure accuracy in your document.</p>
                </div>

                <div class="col-md-3">
                    <i class="fas fa-file fa-7x"></i>

                    <br>
                    <br>

                    <h3>Step 4: Release</h3>
                    <p>The fourth step involves the issuance of your Business/Mayor's Permit.</p>
                </div>
            </div>

    
         <script src="js/purok-street.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

    </body>
</html>
