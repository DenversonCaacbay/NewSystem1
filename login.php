<?php 
    error_reporting(E_ALL ^ E_WARNING);
    
    if(!isset($_SESSION)) {
        $showdate = date("Y-m-d");
        date_default_timezone_set('Asia/Manila');
        $showtime = date("h:i:a");
        $_SESSION['storedate'] = $showdate;
        $_SESSION['storetime'] = $showdate;
        session_start();
    }

    // redirect user if already logged in
    $user_role = $_SESSION['userdata']['role'];

    if($_SESSION['userdata']){
        if($user_role == 'administrator'){
            header('Location: admn_dashboard.php');
        }

        if($user_role == 'staff'){
            header('Location: staff_dashboard.php');
        }

        if($user_role == 'resident'){
            header('Location: resident_homepage.php');
        }
        
    }

    //include('autoloader.php');
    require('classes/main.class.php');
    $bmis->login();

   
?>

<!DOCTYPE html> 
<html> 
    <head> 
        <title> Barangay Santa Rita Management System </title>
        <!-- responsive tags for screen compatibility -->
        <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
        <!-- custom css --> 
        <link href="..//css/index.css" rel="stylesheet" type="text/css">
        <!-- bootstrap css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
        <!-- fontawesome icons --> 
        <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
        <!-- fontawesome icons --> 
        <script src="..//customjs/main.js" type="text/javascript"></script>
        <link rel="manifest" href="manifest.json">
        <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('service-worker.js')
            .then(function(registration) {
                console.log('Service Worker registered with scope:', registration.scope);
            }).catch(function(error) {
                console.log('Service Worker registration failed:', error);
            });
        }
        </script>

        <style> 
            body {
                background: #309464 !important;
            }
            .bg-primary{
                    background: #309464 !important;
                }
                .btn-primary{
                    background: #309464 !important;
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
            border: 2px solid #309464;
            }

            /* Set a style for the submit button */
            .btn {
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
            }

            .btn:hover {
            opacity: 1;
            }
        </style>

    </head>



    <body>


        <!-- This is the heading and card section --> 
        <section class="main-section"> 
            <div class="container-fluid mt-2"> 
                <div class="row">
                        <div class="col-sm-12 main-heading text-center text-white" > 
                            <img src="icon.png" width="150">
                            <h3> Barangay Santa Rita Management System </h3>
                        </div>
                </div>
                <div class="row">
                    <div class="col-sm"></div>
                        <div class="col-sm"> 
                            <div class="card main-card"> 
                                <div class="card-body"> 
                                    <form method="post"> 

                                        <label> Email </label>
                                        <div class="input-container">
                                            <i class="fa fa-envelope icon"></i>
                                            <input class="input-field" type="email" placeholder="Enter Email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                                        </div>

                                        <label> Password </label>
                                        <div class="input-container">
                                            <i class="fa fa-key icon"></i>
                                            <input class="input-field" type="password" placeholder="Enter Password" id="myInput" name="password" required>
                                        </div>

                                        <br>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" onclick="myFunction()" class="custom-control-input" id="switch1">
                                            <label class="custom-control-label" for="switch1">Show Password</label>
                                        </div>

                                        <br>
                                        
                                        <button class="btn btn-primary login-button" type="submit" name="login"> Log-in </button>
                                    
                                    </form>

                                    <hr>

                                    <div class="registration-section"> 
                                        <p1> <strong> Haven't registered yet? </strong> </p1> 
                                        <br>
                                        <p1> Hindi ka pa rehistrado? </p1> 
                                        <br>
                                        <button class="btn btn-success create-button" onclick="trying();"> Create Account </button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-sm"></div>
                </div>
                            
            </div>

        </section>

        <!-- Footer -->

        <footer id="footer" class="bg-primary text-white fixed-bottom d-flex-column text-center">

            <!--Copyright-->

            <div class="py-3 text-center">
                Copyright
                <script>
                document.write(new Date().getFullYear())
                </script> 
                BI & ESMS
            </div>

        </footer>

        <script>
            function myFunction() {
                var x = document.getElementById("myInput");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                }
            }

            function trying() {
                window.location.href = "resident_registration.php";
            }
        </script>

    </body>
</html>