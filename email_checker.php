<?php 
     require('classes/resident.class.php');
     error_reporting(E_ALL ^ E_WARNING);
     ini_set('display_errors',0);
    $residentbmis->email_checker();
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
            .card{
                margin: auto;
                width: 50%;
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
                .card{
                    width: 100%;
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
                    <h3 class="text-center">Email Checker</h3>
                    <div class="card border-0 shadow p-3">
                        <label>Enter Email</label>
                        <input class="form-control mt-3" placeholder="sample@gmail.com">

                        <div class="d-flex justify-content-between">
                        <a href="login.php" class="btn btn-danger mt-3">Back to Login</a>
                        <button type="submit" class="btn btn-success mt-3">Check Email</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

