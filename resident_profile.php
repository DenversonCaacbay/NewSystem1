<?php 
    error_reporting(E_ALL ^ E_WARNING);
    require('classes/resident.class.php');
    ini_set('display_errors',0);
    $userdetails = $residentbmis->get_userdata();
    $id_resident = $_GET['id_resident'];
    $resident = $residentbmis->get_single_resident($id_resident);
    // print_r($resident);
    

    $residentbmis->profile_update();

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

        <div id="down2"></div>

        <br>

        <div class="container"> 
            <div class="card">  
                    <div class="card-header bg-primary text-white" style="font-size:20px"> Personal Information </div>
                <div class="card-body"> 
                    <form method="post">

                        

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Last Name:</label>
                                    <input class="form-control" value="<?= $resident['lname'];?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input class="form-control" value="<?= $resident['fname'];?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Middle Name:</label>
                                    <input class="form-control" value="<?= $resident['mi'];?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input class="form-control" value="<?= $resident['email'];?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sex:</label>
                                    <input class="form-control" value="<?= $resident['sex'];?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nationality:</label>
                                    <input  class="form-control" value="<?= $resident['nationality'];?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Birth Date:</label>
                                    <input class="form-control" value="<?= $resident['bdate'];?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="down1">
                                    <label>Birth Place:</label>
                                    <input class="form-control" value="<?= $resident['bplace'];?>" disabled>
                                </div>
                            </div>
                        </div>

                        <h6 class="mt-3">
                            Update Information
                        </h6>

                        <hr class="w-100">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Age:</label>
                                    <input class="form-control" type="number" name="age" value="<?= $resident['age'];?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <input class="form-control" type="text" name="status" value="<?= $resident['status'];?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Contact:</label>
                                    <input class="form-control" type="tel" name="contact" maxlength="11" pattern="[0-9]{11}" value="<?= $resident['contact'];?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>House No:</label>
                                    <input class="form-control" type="text" name="houseno" value="<?= $resident['houseno'];?>">
                                </div>
                            </div>
                            
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Purok:</label>
                                    <select id="purokDropdown" onchange="showStreets(this.value)" class="form-control" name="purok" value="<?= $resident['purok'];?>" aria-label="Default select example" required>
                                        <option value="" <?php echo ($resident['purok'] === '') ? 'selected' : ''; ?>>Select Purok</option>
                                        <option value="1A" <?php echo ($resident['purok'] === '1A') ? 'selected' : ''; ?>>1A</option>
                                        <option value="1B" <?php echo ($resident['purok'] === '1B') ? 'selected' : ''; ?>>1B</option>
                                        <option value="2" <?php echo ($resident['purok'] === '2') ? 'selected' : ''; ?>>2</option>
                                        <option value="3A" <?php echo ($resident['purok'] === '3A') ? 'selected' : ''; ?>>3A</option>
                                        <option value="3B" <?php echo ($resident['purok'] === '3B') ? 'selected' : ''; ?>>3B</option>
                                        <option value="3C" <?php echo ($resident['purok'] === '3C') ? 'selected' : ''; ?>>3C</option>
                                        <option value="3E" <?php echo ($resident['purok'] === '3E') ? 'selected' : ''; ?>>3E</option>
                                        <option value="3F" <?php echo ($resident['purok'] === '3F') ? 'selected' : ''; ?>>3F</option>
                                        <option value="4A" <?php echo ($resident['purok'] === '4A') ? 'selected' : ''; ?>>4A</option>
                                        <option value="4B" <?php echo ($resident['purok'] === '4B') ? 'selected' : ''; ?>>4B</option>
                                        <option value="4C" <?php echo ($resident['purok'] === '4C') ? 'selected' : ''; ?>>4C</option>
                                        <option value="4D" <?php echo ($resident['purok'] === '4D') ? 'selected' : ''; ?>>4D</option>
                                        <option value="5A" <?php echo ($resident['purok'] === '5A') ? 'selected' : ''; ?>>5A</option>
                                        <option value="5A-1" <?php echo ($resident['purok'] === '5A-1') ? 'selected' : ''; ?>>5A-1</option>
                                        <option value="5B" <?php echo ($resident['purok'] === '5B') ? 'selected' : ''; ?>>5B</option>
                                        <option value="5C" <?php echo ($resident['purok'] === '5C') ? 'selected' : ''; ?>>5C</option>
                                        <option value="5D" <?php echo ($resident['purok'] === '5D') ? 'selected' : ''; ?>>5D</option>
                                        <option value="5E" <?php echo ($resident['purok'] === '5E') ? 'selected' : ''; ?>>5E</option>
                                        <option value="5F" <?php echo ($resident['purok'] === '5F') ? 'selected' : ''; ?>>5F</option>
                                        <option value="6A" <?php echo ($resident['purok'] === '6A') ? 'selected' : ''; ?>>6A</option>
                                        <option value="6AEXT" <?php echo ($resident['purok'] === '6AEXT') ? 'selected' : ''; ?>>6AEXT</option>
                                        <option value="6B1" <?php echo ($resident['purok'] === '6B1') ? 'selected' : ''; ?>>6B1</option>
                                        <option value="6B2" <?php echo ($resident['purok'] === '6B2') ? 'selected' : ''; ?>>6B2</option>
                                        <option value="6C1" <?php echo ($resident['purok'] === '6C1') ? 'selected' : ''; ?>>6C1</option>
                                        <option value="6C2" <?php echo ($resident['purok'] === '6C2') ? 'selected' : ''; ?>>6C2</option>
                                        <option value="6D" <?php echo ($resident['purok'] === '6D') ? 'selected' : ''; ?>>6D</option>
                                        <option value="6E" <?php echo ($resident['purok'] === '6E') ? 'selected' : ''; ?>>6E</option>
                                        <option value="7" <?php echo ($resident['purok'] === '7') ? 'selected' : ''; ?>>7</option>
                                    </select>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Street: </label>
                                            <select id="streetsDropdown" class="form-control" name="street" required>
                                                <option value="<?= $resident['street'];?>""><?= $resident['street'];?></option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Barangay:</label>
                                    <input class="form-control" type="text" name="brgy" value="<?= $resident['brgy'];?>" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <!--<div class="row">-->
                        <!--    <div class="col">-->
                        <!--        <div class="form-group">-->
                        <!--            <label>Address:</label>-->
                        <!--            <input class="form-control" type="text" name="address" value="<?= $resident['address'];?>">-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->


                        <div class="row" style="margin-bottom: 5px; bg-danger"> 
                            <div>
                                <div class="form-inline">
                                    <input class="form-control" name="lname" type="hidden" value="<?= $resident['lname'];?>"/>
                                    <input class="form-control" name="mi" type="hidden" value="<?= $resident['mi'];?>" />
                                    
                                        <div class="col-md-6"><button type="submit" class="btn btn-info w-100 mt-2" name="search_household">View Household</button></div>
                                        <div class="col-md-6"> <button class="btn btn-primary btn-info w-100 mt-2" type="submit" name="profile_update"> Update </button></div>
                                   
                                    <a href="resident_profile.php?id_resident=<?= $userdetails['id_resident'];?>"></a>   
                                    <div>
                                        <br><br>
                                        <?php include'testingsearch.php'?>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>                               
            </div>
        </div>

        <!-- Footer -->

       
        <!---->
        <script src="js/purok-street.js" type="text/javascript"></script>


        <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

    </body>
</html>
