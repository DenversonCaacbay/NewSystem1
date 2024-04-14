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
        <!-- bootstrap css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
        <!-- fontawesome icons --> 
        <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
 
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
            body::-webkit-scrollbar{
                display:none;
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

            .card{
                border-radius: 10px;
                width: 80%;
                top:100px;
                margin-bottom: 0px;
            }
            .company--title{
                width: 100%;
                padding-left: 50px;
                padding-top: 60px;
            }
            .login--title{
                color: #309464;
                font-size: 30px;
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
            .footer{
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                margin-top: 0px;
                color: #fff; /* Change the text color as needed */
                text-align: center;
                padding: 0px 0; /* Adjust the padding as needed */
            }
            @media (max-width: 767.98px) {
                .card{
                    top:20px;
                    width: 100%;
                    margin-bottom: 50px;
                }
                .company--title{
                    width: 100%;
                    text-align: center;
                    padding-left: 0px;
                    padding-top: 20px;
                }
                .footer{
                    position: relative;
                    left: 0;
                    bottom: 0;
                    width: 100%;
                    margin-top:30px;
                    color: #fff; /* Change the text color as needed */
                    text-align: center;
                    padding: 0px 0; /* Adjust the padding as needed */
                }
            }
            
        </style>

    </head>



    <body>
        <!-- This is the heading and card section --> 
        <section class="main-section"> 
            <div class="container-fluid mt-2"> 
                <div class="row">
                        <div class="col-md-6 text-white align-content-center"> 
                            <div class="company--title">
                                <img src="icon.png" width="150">
                                <h1> Barangay Sta. Rita Information & Management System</h1>
                                <h5><i>“Your one stop barangay solution”</i></h5>
                            </div>
                        </div>
                        <div class="col-md-6 align-content-center"> 
                        <div class="card m-auto main-card"> 
                            <div class="card-body"> 
                                <h4 class="login--title">Login</h4>
                                <form method="post"> 
                                    <label> Email: </label>
                                    <div class="input-container">
                                        <i class="fa fa-envelope icon"></i>
                                        <input class="input-field" type="email" placeholder="Enter Email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                                    </div>
                                    <label> Password: </label>
                                    <div class="input-container">
                                        <i class="fa fa-key icon"></i>
                                        <input class="input-field" type="password" placeholder="Enter Password" id="myInput" name="password" autocomplete="off" required>
                                    </div>
                                    <div class="custom-control custom-switch mt-3">
                                        <input type="checkbox" onclick="myFunction()" class="custom-control-input" id="switch1">
                                        <label class="custom-control-label" for="switch1">Show Password</label>
                                    </div>
                                    <button class="btn btn-success mt-3" type="submit" name="login"> Login </button>
                                </form>
                                <hr>
                                <div class="registration-section"> 
                                    <p1> <strong> Haven't registered yet? </strong> </p1> 
                                    <br>
                                    <p1> Hindi ka pa rehistrado? </p1> 
                                    <br>
                                    <button class="btn btn-success create-button" onclick="trying();" disabled> Create Account </button> 
                                    <div class="custom-control custom-switch mt-3">
                                        <input type="checkbox" onclick="enableCreate()" class="custom-control-input" id="switch2">
                                        <a class="custom-control-label" href="communiserve_privacy_policy.html" target="_blank" for="switch1">Communiserve Privacy Policy</a>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            
            </div>

            <footer id="footer" class="footer bg-primary text-white text-center">

            <!--Copyright-->

            <div class="py-3 text-center">
                Copyright
                <script>
                document.write(new Date().getFullYear())
                </script> 
                CommuniServe
            </div>

        </footer>

        </section>
        

        <script>
            function myFunction() {
                var x = document.getElementById("myInput");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                }
            }

            function enableCreate() {
                var checkbox = document.getElementById("switch2");
                var button = document.querySelector(".create-button");

                if (checkbox.checked === true) {
                    button.disabled = false;
                } else {
                    button.disabled = true;
                }
            }

            function trying() {
                window.location.href = "email_checker.php";
            }
        </script>

    </body>
</html>