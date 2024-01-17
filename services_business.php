<?php 
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
  
        <link rel="stylesheet" href="css/services-navbar.css">
        
        <style>
            /* Back-to-Top */
            .bg-primary{
        background: #309464 !important;
                }
                .btn-primary{
                    background: #309464 !important;
                }
                body::-webkit-scrollbar {
                        display: none;
                    }
            .top-link {
            transition: all 0.25s ease-in-out;
            position: fixed;
            bottom: 0;
            right: 0;
            display: inline-flex;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            margin: 0 3em 3em 0;
            border-radius: 50%;
            padding: 0.25em;
            width: 80px;
            height: 80px;
            background-color: #3661D5;
            }
            .top-link.show {
            visibility: visible;
            opacity: 1;
            }
            .top-link.hide {
            visibility: hidden;
            opacity: 0;
            }
            .top-link svg {
            fill: white;
            width: 24px;
            height: 12px;
            }
            .top-link:hover {
            background-color: #3498DB;
            }
            .top-link:hover svg {
            fill: #000000;
            }

            .screen-reader-text {
            position: absolute;
            clip-path: inset(50%);
            margin: -1px;
            border: 0;
            padding: 0;
            width: 1px;
            height: 1px;
            overflow: hidden;
            word-wrap: normal !important;
            clip: rect(1px, 1px, 1px, 1px);
            }
            .screen-reader-text:focus {
            display: block;
            top: 5px;
            left: 5px;
            z-index: 100000;
            clip-path: none;
            background-color: #eee;
            padding: 15px 23px 14px;
            width: auto;
            height: auto;
            text-decoration: none;
            line-height: normal;
            color: #444;
            font-size: 1em;
            clip: auto !important;
            }

            .container1
            {
                background-color: #3498DB;
                height: 342px;
                color: black;
                font-family: Arial, Helvetica, sans-serif;
                text-align: center;
            }

            .applybutton
            {
                width: 100% !important;
                height: 50px !important;
                border-radius: 20px;
                margin-top: 5%;
                margin-bottom: 8%;
                font-size: 25px;
                letter-spacing: 3px;
            }

            .paa
            {
                margin-top: 10px;
                position: relative;
                left: -28%;
            }

            .text1{
                margin-top: 30px;
                font-size: 50px;
            }

            .picture{
                height: 120px;
                width: 120px;
            }

            /* width */
            ::-webkit-scrollbar {
            width: 5px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
            background: #f1f1f1; 
            }
            
            /* Handle */
            ::-webkit-scrollbar-thumb {
            background: #888; 
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
            background: #555; 
            }

            .card5 {
                width: 195px;
                /*height: 210px;*/
                overflow: auto;
                margin: auto;
                color: white;
            }

            .card4 {
                width: 195px;
                /*height: 210px;*/
                overflow: auto;
                margin: auto;
                color: white;
            }

            .card3 {
                width: 195px;
                /*height: 210px;*/
                overflow: hidden;
                margin: auto;
                color: white;
            }

            .card2 {
                width: 195px;
                /*height: 210px;*/
                overflow: auto;
                margin: auto;
                color: white;
            }

            .card1 {
                width: 195px;
                /*height: 210px;*/
                overflow: auto;
                margin: auto;
                color: white;
            }

            a{
                color:white;
                }
            .shfooter .collapse {
                display: inherit;
            }
                @media (max-width:767px) {
            .shfooter ul {
                    margin-bottom: 0;
            }

            .shfooter .collapse {
                    display: none;
            }

            .shfooter .collapse.show {
                    display: block;
            }

            .shfooter .title .fa-angle-up,
            .shfooter .title[aria-expanded=true] .fa-angle-down {
                    display: none;
            }

            .shfooter .title[aria-expanded=true] .fa-angle-up {
                    display: block;
            }

            .shfooter .navbar-toggler {
                    display: inline-block;
                    padding: 0;
            }

            }

            .resize {
                text-align: center;
            }
            .resize {
                margin-top: 3rem;
                font-size: 1.25rem;
            }
            /*RESIZESCREEN ANIMATION*/
            .fa-angle-double-right {
                animation: rightanime 1s linear infinite;
            }

            .fa-angle-double-left {
                animation: leftanime 1s linear infinite;
            }
            @keyframes rightanime {
                50% {
                    transform: translateX(10px);
                    opacity: 0.5;
            }
                100% {
                    transform: translateX(10px);
                    opacity: 0;
            }
            }
            @keyframes leftanime {
                50% {
                    transform: translateX(-10px);
                    opacity: 0.5;
            }
                100% {
                    transform: translateX(-10px);
                    opacity: 0;
            }
            }

            /* Contact Chip */

            .chip {
            display: inline-block;
            padding: 0 25px;
            height: 50px;
            line-height: 50px;
            border-radius: 25px;
            background-color: #2C54C1;
            margin-top: 5px;
            }

            .chip img {
            float: left;
            margin: 0 10px 0 -25px;
            height: 50px;
            width: 50px;
            border-radius: 50%;
            }

            .zoom {
            transition: transform .3s;
            }

            .zoom:hover {
            -ms-transform: scale(1.4); /* IE 9 */
            -webkit-transform: scale(1.4); /* Safari 3-8 */
            transform: scale(1.4); 
            }

            @media (min-width: 768px) {
            /* Display "desk" class on medium and larger screens (desktop) */
            
        }

        @media (max-width: 767.98px) {
            /* Display "mob" class on smaller screens (mobile) */
            .text1 {
                font-size: 20px;
                font-weight: bold;
            }
            h5{
                font-size: 17px;
            }
            .picture{
                width: 100px;
                height: 100px;
            }
        }

        </style>
  </head>

    <body>

        <!-- Back-to-Top and Back Button -->


        <!-- Eto yung navbar -->

        <nav class="navbar navbar-dark navbar-expand-lg bg-primary sticky-top">
            <div class="container-fluid w-100">
                <!-- Desktop view -->
                <a class="navbar-brand desk ms-3 d-none d-lg-block" style="color: white;">Barangay Santa Rita Information & E-Services</a>

                <!-- Mobile view -->
                <a class="navbar-brand mob mx-auto d-lg-none" style="color: white;">BSRI & E-Services</a>

                <div class="dropdown ml-auto me-3">
                    <a title="Your Account" class="nav-link text-white dropdown-toggle" style="margin-right: 2px;" type="button" data-toggle="dropdown">
                        <?= $userdetails['surname'];?>, <?= $userdetails['firstname'];?>
                        <span class="caret" style="margin-left: 2px;"></span>
                    </a>
                    <ul class="dropdown-menu" style="width: 175px; right: 0;" >
                        <a class="btn" href="resident_profile.php?id_resident=<?= $userdetails['id_resident'];?>"> <i class="fas fa-user"> &nbsp; </i>Personal Profile  </a>
                        <a class="btn" href="resident_changepass.php?id_resident=<?= $userdetails['id_resident'];?>"> <i class="fas fa-lock" >&nbsp;</i> Change Password  </a>
                        <a class="btn" href="logout.php"> <i class="fas fa-sign-out-alt">&nbsp;</i> Logout  </a>
                    </ul>
                </div>
            </div>            
        </nav>

        <div class="container-fluid"> 
            <div class="row"> 
                <div class="col-md-6"> 
                    <div class="text-center">
                        <h1 class="text1">Business Permit (Mayor's Permit) </h1>
                        <h5> Before you can start operating your business in the Philippines, you need to secure 
                        <br> a Mayor’s Permit or Business Permit from the Local Government Unit (LGU) where your 
                        <br> company office is located. </h5>
                    </div>
                    <div class="row mt-3">
                        <div class="col text-center"><img class="picture mx-auto d-block" src="icons/Documents/santaritalogo.png"></div>
                        <div class="col text-center"><img class="picture mx-auto d-block" src="icons/Documents/rnplogo.png"></div>
                        <div class="col text-center"><img class="picture mx-auto d-block" src="icons/Documents/sklogo.png"></div>
                    </div>

                   
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="mt-3">Procedure</h3>
                                <hr style="background-color: black;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <i class="fas fa-id-card fa-4x"></i>
                                <h3>Step 1: Preparation</h3>
                                <p>The first step is to gather all the necessary information required for acquiring a business permit.</p>
                            </div>

                            <div class="col">
                                <i class="fas fa-laptop fa-4x"></i>
                                <h3>Step 2: Fill-Up</h3>
                                <p>The second step involves completing the entire form in our system.</p>
                            </div>

                            <div class="col">
                                <i class="fas fa-user-check fa-4x"></i>
                                <h3>Step 3: Assessment</h3>
                                <p>The third step, verify all the information provided in our system to ensure accuracy in your document.</p>
                            </div>

                            <div class="col">
                                <i class="fas fa-file fa-4x"></i>
                                <h3>Step 4: Release</h3>
                                <p>The fourth step involves the issuance of your Business/Mayor's Permit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
<!-- Sample -->
                <form method="post" class="was-validated mt-3 p-3" enctype="multipart/form-data">
                    <div class="row"> 
                        <div class="col-md-12"><h4>Request Form</h4></div>
                        <div class="col-md-4" hidden>
                            <div class="form-group">
                                <label for="lname">Last Name:</label>
                                <input name="lname" type="text" class="form-control" value="<?= $userdetails['surname'];?>" readonly>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-4" hidden>
                            <div class="form-group">
                                <label for="fname">First Name:</label>
                                <input name="fname" type="text" class="form-control" value="<?= $userdetails['firstname'];?>" readonly>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-4" hidden>
                            <div class="form-group">
                                <label for="mi">Middle Name </label>
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
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> House No: </label>
                                <input type="text" class="form-control" name="houseno"  placeholder="Enter House No." value="<?= $userdetails['houseno'];?>"  readonly>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Street: </label>
                                <input type="text" class="form-control" name="street"  placeholder="Enter Street" value="<?= $userdetails['street'];?>"  readonly>
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
                                <label for="status">Business Industry:</label>
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
                                <label for="aoe">Area of Establishment (SqM): </label>
                                <input type="number" name="aoe" class="form-control" placeholder="Enter your AOE" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

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
                            <label>Supporting Evidence Photo:</label>
                            <div class="custom-file form-group">
                                <input type="file" onchange="readURL(this);" class="custom-file-input" id="customFile" name="bspermit_photo" required>
                                <label class="custom-file-label" for="customFile">Choose File Photo</label>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Photo Display:</label><br>
                            <img id="blah" src="http://placehold.it/470x350" width="300" alt="your image" />
                        </div>
                        <div class="col-md-12">
                            <input name="id_resident" type="hidden" class="form-control" value="<?= $userdetails['id_resident']?>">
                            
                            <button name ="create_bspermit" type="submit" class="btn btn-primary w-100 mt-3">Submit Request</button>
                        </div>
                    </div>
        
                </form>
                </div>
            </div>
        </div>


        <!-- Button trigger modal -->

            <!-- Modal -->

                            
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
