<?php 
     require('classes/resident.class.php');
     error_reporting(E_ALL ^ E_WARNING);
     ini_set('display_errors',0);
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>

    <style>
            .bg-primary{
                    background: #309464 !important;
                }
                .btn-primary{
                    background: #309464 !important;
                }
        
        /* .field-icon {
            margin-left: 78%;
            margin-top: -8.5%;
            position: absolute;
            z-index: 2;
        } */
        /* .field-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    } */
    .field-icon {
        position: absolute;
        right: 27%;
        top: 83%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    .field-icon i {
        margin: 0;
        padding: 0;
        border: none;
        background: none;
        font-size: 1rem; /* Adjust font size as needed */
        color: inherit;
    }
    
    .field-icon1 {
        position: absolute;
        right: 25px;
        top: 83%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
        body::-webkit-scrollbar {
            display: none;
        }
        .form-control{
            
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
        
        select#streetsDropdown, select#streetsDropdown option {
            text-transform: none !important;
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
                <div class="col-md-12 d-flex justify-content-between">
                    <h3 class="text-center">Registration Form</h3>
                    <!-- <button class="btn btn-primary"  onclick="downloadPDF()">Purok and Street List <i class="fas fa-download ms-1"></i></button> -->
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
                                            <input type="text" class="form-control"  id="lname" name="lname" placeholder="Enter Last Name" value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : ''; ?>" readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mtop">First Name: </label>
                                            <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : ''; ?>" readonly>
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

                                    <div class="col-md-4 rb">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mtop">When did you live in this barangay? </label>
                                            <input type="date" class="form-control" id="myDateInput" onchange="checkBdate('myDateInput')" name="date_live" value="<?php echo isset($_POST['date_live']) ? htmlspecialchars($_POST['date_live']) : ''; ?>" required>
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
                                            <select id="purok" class="form-select"  name="purok" onchange="updateStreet()" required>
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
                                            <select id="street" class="form-select" name="street" onchange="updatePurok()">
                                                <option value=""></option>
                                                <optgroup label="1A">
                                                    <option>Santolan Street</option>
                                                    <option>Santolan Extension</option>
                                                    <option>Chico Street</option>
                                                    <option>Mabolo Street</option>
                                                    <option>Ariola Bridge</option>
                                                    <option>Filtration Road (Left Side from Sta. Rita Bridge to Alfa Mart)</option>
                                                </optgroup>
                                                <optgroup label="1B">
                                                    <option>Avocado Street</option>
                                                    <option>Avocado Extension</option>
                                                    <option>Manggahan Street</option>
                                                    <option>Manggahan Extension</option>
                                                    <option>Filtration Road (Left Side after Alfa Mart to Corner of Manggahan Street)</option>
                                                </optgroup>
                                                <optgroup label="2">
                                                    <option>Cabling Street</option>
                                                    <option>Rosa Gonzales Street</option>
                                                    <option>Interior</option>
                                                    <option>Corpus Compound</option>
                                                    <option>Cabling Compound</option>
                                                    <option>Filtration Road (Right Side from Sta. Rita Bridge to Winnies Bake Shop Sampaguita Road)</option>
                                                    <option>Sta. Rita Road (One Way)</option>
                                                </optgroup>
                                                <optgroup label="3A">
                                                    <option>Begonia Street (Right Side from Dizon Junk Shop to Baptist Church)</option>
                                                    <option>Camia Street (Right Side from Rodriguez Ice Plant to Delrosario Compound)</option>
                                                    <option>Camia Street (Left Side from Baustista Compound to Gatchalian Store)</option>
                                                </optgroup>
                                                <optgroup label="3B">
                                                    <option>Filtration Road (Left Side going to Mabayuan)</option>
                                                    <option>Amapola Street</option>
                                                    <option>Camia Street</option>
                                                    <option>Rosal Street</option>
                                                    <option>Begonia Street</option>
                                                </optgroup>
                                                <optgroup label="3C">
                                                    <option>Horseshoe Drive</option>
                                                    <option>Marikit Street</option>
                                                    <option>Roselane</option>
                                                    <option>Marilag Street</option>
                                                    <option>Marilag Extension</option>
                                                    <option>Adelfa 1</option>
                                                    <option>Adelfa 2</option>
                                                    <option>Filtration Road (Right Side from Corner of Horseshoe Drive to Corner of Mayumi)</option>
                                                </optgroup>
                                                <optgroup label="3E">
                                                    <option>Sampaguita Road (Left Side from Back of Sta Rita Parish to Corner of Azucena Street)</option>
                                                    <option>Mahinhin Street</option>
                                                    <option>Maganda Street</option>
                                                    <option>Jasmin Street</option>
                                                    <option>Azucena Street</option>
                                                </optgroup>
                                                <optgroup label="3F">
                                                    <option>Aries Street</option>
                                                    <option>Jasmin Street</option>
                                                    <option>Leo Street</option>
                                                    <option>Leo Extension</option>
                                                    <option>Libra Street</option>
                                                    <option>Pisces Street</option>
                                                    <option>Taurus Street</option>
                                                    <option>Gemini Street</option>
                                                    <option>Virgo Street</option>
                                                    <option>Capricorn Street</option>
                                                    <option>Aquarius Street</option>
                                                    <option>Saguitarius Street</option>
                                                </optgroup>
                                                <optgroup label="4A">
                                                    <option>Whole of Sampaloc Compound</option>
                                                    <option>Sta. Rita Road (Fronting Sampaguita Compound)</option>
                                                </optgroup>
                                                <optgroup label="4B">
                                                    <option>Sta. Rita Road (Right Side from 1087-1111)</option>
                                                    <option>Clark Street</option>
                                                    <option>Aglipay Church</option>
                                                </optgroup>
                                                <optgroup label="4C">
                                                    <option>Mercury Lane</option>
                                                    <option>Mercury A & B Extension</option>
                                                    <option>Mars Lane</option>
                                                    <option>Venus Lane</option>
                                                    <option>Sta. Rita Road (Left Side)</option>
                                                    <option>Sampaguita Extension</option>
                                                    <option>Alejo Street</option>
                                                </optgroup>
                                                <optgroup label="4D">
                                                    <option>Baltazar Street</option>
                                                    <option>Soriano Street</option>
                                                    <option>Cayabyab Street</option>
                                                    <option>Back of Iglesia Ni Cristo</option>
                                                    <option>Sta. Rita Road (Right Side from 1113-1158)</option>
                                                </optgroup>
                                                <optgroup label="5A">
                                                    <option>Balic-Balic Road (Right Side from Corner Tabacuhan to Corner Laban Street)</option>
                                                    <option>Lunduyan Street</option>
                                                    <option>Payapa Street</option>
                                                </optgroup>
                                                <optgroup label="5A-1">
                                                    <option>Whole of Sta. Rita Village (Block 1- Block 9)</option>
                                                </optgroup>
                                                <optgroup label="5B">
                                                    <option>Laban Street</option>
                                                    <option>Dominguez Street (From 1683 to 1687)</option>
                                                    <option>Waterdam Road (1672) Balic-Balic Road (From Corner Laban Street to Corner Dominguez Street)</option>
                                                </optgroup>
                                                <optgroup label="5C">
                                                    <option>Block 4</option>
                                                    <option>Half of Dominguez Street</option>
                                                    <option>Block 8 (Slaughter House)</option>
                                                    <option>Block 12</option>
                                                    <option>Block 13</option>
                                                </optgroup>
                                                <optgroup label="5D">
                                                    <option>From Block 14 to Block 23</option>
                                                </optgroup>
                                                <optgroup label="5E">
                                                    <option>From Block 24-Block 27</option>
                                                </optgroup>
                                                <optgroup label="5F">
                                                    <option>Block 27 Extension</option>
                                                </optgroup>
                                                <optgroup label="6A">
                                                    <option>Cristobal Street</option>
                                                    <option>Trance Street</option>
                                                    <option>Balimpuyo</option>
                                                    <option>Part of Tabacuhan Road</option>
                                                </optgroup>
                                                <optgroup label="6AEXT">
                                                    <option>Tulio Street</option>
                                                    <option>Delrosario Street</option>
                                                    <option>Part of Tabacuhan Road</option>
                                                </optgroup>
                                                <optgroup label="6B1">
                                                    <option>Part of Tabacuhan Road</option>
                                                    <option>Millionare Street</option>
                                                    <option>Bigtime Street</option>
                                                    <option>Calapati Compound (Beside Tabacuhan Elementary School)</option>
                                                </optgroup>
                                                <optgroup label="6B2">
                                                    <option>Part of Tabacuhan Road</option>
                                                    <option>Tabacuhan Elementary School</option>
                                                    <option>Magiting Street</option>
                                                    <option>Del Rosario Street (Left Side)</option>
                                                </optgroup>
                                                <optgroup label="6C1">
                                                    <option>From 1466 Julo Tabacuhan to 1480 Julo Tabacuhan</option>
                                                </optgroup>
                                                <optgroup label="6C2">
                                                    <option>From 1482 Upper Julo to 1483 Upper Julo</option>
                                                </optgroup>
                                                <optgroup label="6D">
                                                    <option>Tabacuhan Extension</option>
                                                    <option>Quiet Place</option>
                                                    <option>Tinapahan Extension</option>
                                                </optgroup>
                                                <optgroup label="6E">
                                                    <option>Whole of Holy Spirit</option>
                                                    <option>San Isidro Street</option>
                                                    <option>San Pedro Street</option>
                                                    <option>San Roque Street</option>
                                                    <option>Holy Spirit Drive</option>
                                                </optgroup>
                                                <optgroup label="7">
                                                    <option>Upper Julo Tabacuhan</option>
                                                </optgroup>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> Barangay: </label>
                                            <input type="text" class="form-control" name="brgy" placeholder="Enter Barangay" value="Sta. Rita" readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label> Municipality: </label>
                                            <input type="text" class="form-control" name="municipal" placeholder="Enter Municipality" value="Olongapo City" readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <!-- <label class="mtop" style="font-size:15px;"> Please upload an ID with an address or any proof of billing. </label>
                                            <input type="file" class="form-control" name="id_picture" placeholder=""> -->
                                            <label for="formFile" class="form-label mt-1"  style="font-size:15px;">Please upload an ID with an address or any proof of billing. </label>
                                            <input class="form-control" type="file" id="formFile" name="id_picture">
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mt-2">Are you a registered voter? </label>
                                            <select class="form-select" name="voter" id="regvote" required>
                                                <option value="" <?php echo empty($_POST['voter']) ? 'selected' : ''; ?>>See Option</option>
                                                <option value="Yes" >Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="mt-2">Are you head of the family? </label>
                                            <select class="form-select" name="family_role" id="famhead" required>
                                                <option value="" <?php echo empty($_POST['family_role']) ? 'selected' : ''; ?>>See Option</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
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
                                            <input type="email" class="form-control" name="email" placeholder="Enter Email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" readonly>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Password:</label>
                                            <input type="password" class="form-control" id="password-field" name="password" placeholder="Enter Password" required>
                                            <!-- <i class="fa-solid fa-eye field-icon toggle-password"></i> -->
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Confirm Password:</label>
                                            <input type="password" class="form-control" id="confirm-password-field" name="confirm_password" placeholder="Enter Confirm Password" required>
                                            <!-- <i class="fa-solid fa-eye field-icon1 toggle-confirm-password"></i> -->
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Passwords do not match.</div> <!-- Updated error message -->
                                        </div>
                                        <div class="form-check" style="margin-left: 54%">
                                            <input class="form-check-input" type="checkbox" value="" id="show-password-checkbox">
                                            <label class="form-check-label" for="show-password-checkbox">
                                                Show Password
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="role" value="resident">
                                <div class="row">
                                    <div class="col-md-6"><a class="btn btn-danger w-100 mt-2" href="login.php"> Back to Login</a></div>
                                    <div class="col-md-6"><button class="btn btn-primary w-100 mt-2" type="submit" name="add_resident" id="submit-button" disabled>Submit</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <script>
            // Retrieve the values from the query parameters
            var params = new URLSearchParams(window.location.search);
            var fname = params.get('fname');
            var lname = params.get('lname');
            var email = params.get('email');

            // Set the values in the input fields
            document.getElementById('fname').value = fname;

            document.getElementById('lname').value = lname;

            document.getElementById('email').value = email;
        </script>

        <script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordField = document.getElementById("password-field");
        const confirmPasswordField = document.getElementById("confirm-password-field");
        const showPasswordCheckbox = document.getElementById("show-password-checkbox");
        const submitButton = document.getElementById("submit-button");

        function togglePasswordVisibility() {
            const type = showPasswordCheckbox.checked ? 'text' : 'password';
            passwordField.type = type;
            confirmPasswordField.type = type;
        }

        showPasswordCheckbox.addEventListener('change', togglePasswordVisibility);

        function checkPasswords() {
            if (passwordField.value === confirmPasswordField.value) {
                confirmPasswordField.setCustomValidity('');
                submitButton.disabled = false;
            } else {
                confirmPasswordField.setCustomValidity('Passwords do not match.');
                submitButton.disabled = true;
            }
        }

        passwordField.addEventListener("keyup", checkPasswords);
        confirmPasswordField.addEventListener("keyup", checkPasswords);
    });
</script>
        <!-- <footer id="footer" class="bg-primary text-white d-flex-column text-center"> -->

            <!-- Copyright--> 
<!-- 
            <div class="py-3 text-center">
                Copyright
                <script>
                document.write(new Date().getFullYear())
                </script>  -->
                <!--BI & ESMS
            </div>

        </footer>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

 -->
 <script>
        function updateStreet() {
            const purokDropdown = document.getElementById('purok');
            const streetDropdown = document.getElementById('street');
            const selectedPurok = purokDropdown.value;

            // Show all optgroups if the default option is selected
            if (selectedPurok === "") {
                const optgroups = streetDropdown.querySelectorAll('optgroup');
                optgroups.forEach(optgroup => {
                    optgroup.style.display = 'block';
                });
                return; // Exit the function early
            }

            // Hide all optgroups
            const optgroups = streetDropdown.querySelectorAll('optgroup');
            optgroups.forEach(optgroup => {
                optgroup.style.display = 'none';
            });

            // Show optgroup corresponding to selected purok
            const selectedOptgroup = streetDropdown.querySelector(`optgroup[label="${selectedPurok}"]`);
            if (selectedOptgroup) {
                selectedOptgroup.style.display = 'block';
            }
        }

        function updatePurok() {
            const purokDropdown = document.getElementById('purok');
            const streetDropdown = document.getElementById('street');
            const selectedStreet = streetDropdown.value;

            // Find optgroup containing the selected street
            const optgroups = streetDropdown.querySelectorAll('optgroup');
            let selectedPurok = '';
            optgroups.forEach(optgroup => {
                const options = optgroup.querySelectorAll('option');
                options.forEach(option => {
                    if (option.textContent === selectedStreet) {
                        selectedPurok = optgroup.label;
                    }
                });
            });

            // Update selected purok in the purok dropdown
            purokDropdown.value = selectedPurok;

            // Update streets based on selected purok
            updateStreet();
        }

    </script>
        <!-- <script src="js/purok-street.js"></script> -->
        
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

        <script>
            function downloadPDF() {
    // Path to your PDF file
    const pdfPath = 'assets/purok_and_street.pdf';

    // Use fetch to load the PDF file
    fetch(pdfPath)
        .then(response => response.blob())
        .then(blob => {
            // Create a link element
            const link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'purok_and_street.pdf';
            link.click();
        })
        .catch(error => {
            console.error('Error fetching the PDF file:', error);
        });
}
        </script>
        

        <!-- <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script> -->
    </body>
</html>

