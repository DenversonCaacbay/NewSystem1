<?php 
     require('classes/resident.class.php');
    $residentbmis->create_resident();
     //$data = $bms->get_userdata();

     
?>

<!DOCTYPE html> 
<html> 
    <head> 
        <title> Barangay Santa Rita Management System </title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
        <!-- responsive tags for screen compatibility -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- bootstrap css --> 
        <!-- <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">  -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        
        <!-- fontawesome icons -->
        <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>

    </head>

    <style>
        
        .field-icon {
            margin-left: 78%;
            margin-top: -8.5%;
            position: absolute;
            z-index: 2;
        }
        body::-webkit-scrollbar {
            display: none;
        }
        .form-control{
            padding:20px;
        }
        .was-validated .form-control:valid, 
        .was-validated .form-control:invalid {
            background-image: none; /* Remove background-image (validation icon) */
            padding-right: .75rem; /* Add padding for better spacing */
        }
        .was-validated .form-select:valid, 
        .was-validated .form-select:invalid {
            background-image: none; /* Remove background-image (validation icon) */
        }

        /* Additional styles to override Bootstrap validation icons */
        .was-validated .form-control.is-valid, 
        .was-validated .form-select.is-valid {
            border-color: #ced4da; /* Reset border color for valid state */
        }

        .was-validated .form-control.is-invalid, 
        .was-validated .form-select.is-invalid {
            border-color: #dc3545; /* Reset border color for invalid state */
        }

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
    
    <body >

        <!-- eto yung navbar -->
        <nav class="navbar py-2 navbar-expand-md navbar-dark bg-primary sticky-top">
            <a class="navbar-brand desk ms-3" style="color: white;">Barangay Santa Rita Information & E-Services</a>
            <a class="navbar-brand mob mx-auto" style="color: white;">BSRI & E-Services</a>
        </nav>

        <div class="container" style="margin-top: 1em;">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center">Registration Form</h3>
                </div>
            </div>

            <div class="row mt-2"> 

                <div class="col-sm-12">
                    <div class="card mbottom" style="margin-bottom: 3em;">
                        <div class="card-body">
                            <form method="post" enctype='multipart/form-data' class="was-validated">

                                <div class="row">
                                <div class="col-md-12"><h5>Personal Information</h5></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mtop">Last Name: </label>
                                            <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mtop">First Name: </label>
                                            <input type="text" class="form-control" name="fname" placeholder="Enter First Name" value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mtop">Middle Name: </label>
                                            <input type="text" class="form-control" name="mi" placeholder="Enter Middle Name" value="<?php echo isset($_POST['mi']) ? htmlspecialchars($_POST['mi']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mtop">Birth Date: </label>
                                            <input type="date" class="form-control" id="myDateInput" onchange="checkBdate('myDateInput')" name="bdate" value="<?php echo isset($_POST['bdate']) ? htmlspecialchars($_POST['bdate']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mtop">Birth Place </label>
                                            <input type="text" class="form-control" name="bplace" placeholder="Enter Birth Place" value="<?php echo isset($_POST['bplace']) ? htmlspecialchars($_POST['bplace']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mtop">Nationality: </label>
                                            <input type="text" class="form-control" name="nationality" placeholder="Enter Nationality" value="<?php echo isset($_POST['nationality']) ? htmlspecialchars($_POST['nationality']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mtop">Civil Status: </label>
                                            <select class="form-select" name="status" id="status" required>
                                                <option value="" <?php echo empty($_POST['status']) ? 'selected' : ''; ?>>Choose your Status</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Divorced">Divorced</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 rb">
                                        <div class="form-group">
                                            <label class="mtop">Sex</label>
                                            <select class="form-select" name="sex" id="sex" required>
                                                <option value="" <?php echo empty($_POST['sex']) ? 'selected' : ''; ?>>Choose your Sex</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12"><h5>Address</h5></div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> House No: </label>
                                            <input type="text" class="form-control" name="houseno" placeholder="Enter House No." value="<?php echo isset($_POST['houseno']) ? htmlspecialchars($_POST['houseno']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> Purok: </label>
                                            <select id="purokDropdown" class="form-select" onchange="showStreets(this.value)" name="purok" aria-label="Default select example" required>
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
                                            <select id="streetsDropdown" class="form-control" name="street" disabled required>
                                                <option value="" disabled selected>Select Street</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> Barangay: </label>
                                            <input type="text" class="form-control" name="brgy" placeholder="Enter Barangay" value="Sta.Rita" readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Municipality: </label>
                                            <input type="text" class="form-control" name="municipal" placeholder="Enter Municipality" value="Olongapo" readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                <div class="col-md-12"><h5>Contact Information</h5></div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Contact Number:</label>
                                            <input type="tel" class="form-control" name="contact" maxlength="11" pattern="[0-9]{11}" placeholder="Enter Contact Number" value="<?php echo isset($_POST['contact']) ? htmlspecialchars($_POST['contact']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Email: </label>
                                            <input type="email" class="form-control" name="email" placeholder="Enter Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Password:</label>
                                            <input type="password" class="form-control" id="password-field" name="password" placeholder="Enter Password" required>
                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Confirm Password:</label>
                                            <input type="password" class="form-control" id="confirm-password-field" name="confirm_password" placeholder="Enter Confirm Password" required>
                                            <span toggle="#confirm-password-field" class="fa fa-fw fa-eye field-icon toggle-confirm-password"></span>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="role" value="resident">
                                <div class="row">
                                    <div class="col-md-6"><a class="btn btn-danger w-100 mt-2" href="index.php"> Back to Login</a></div>
                                    <div class="col-md-6"><button class="btn btn-primary w-100 mt-2" type="submit" name="add_resident"> Submit </button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->

        <footer id="footer" class="bg-primary text-white d-flex-column text-center">

            <!--Copyright-->

            <div class="py-3 text-center">
                Copyright
                <script>
                document.write(new Date().getFullYear())
                </script> 
                <!--BI & ESMS -->
            </div>

        </footer>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <!---->
        <script src="js/purok-street.js" type="text/javascript"></script>
        
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

            $(".toggle-confirm-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
        </script>
        

        <script src="..//bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>
    </body>
</html>

