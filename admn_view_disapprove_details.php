<?php
    
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
   $view = $residentbmis->view_single_resident();
   
?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<link rel="stylesheet" href="css/table.css"/>

    <!-- Begin Page Content -->
    <div class="container-fluid page--container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-center mb-0">Viewing Resident Details</h4>
            <div>
                <!-- <button class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#exampleModal">Banned Details</button> -->
                <a class="btn btn-primary" href="admn_resident_disapproved.php">Back</a>
            </div>
            
        </div>

        <!-- Page Heading -->


        <div class="col-md-12 mt-3">
        <div class="row">
                <div class="col-md-12" style="font-size: 18px; font-weight:bold;">Personal Details</div>
                <div class="col-md-4">
                    <label>Last Name</label>
                    <input type="text" class="form-control" value="<?= $view['lname'];?>">
                </div>
                <div class="col-md-4">
                <label>First Name</label>
                    <input type="text" class="form-control" value="<?= $view['fname'];?>">
                </div>
                <div class="col-md-4">
                <label>Middle Name</label>
                    <input type="text" class="form-control" value="<?= $view['mi'];?>">
                </div>
                <div class="col-md-2 mt-3">
                <label>Birthdate</label>
                    <input type="text" class="form-control" value="<?= $view['bdate'];?>">
                </div>
                <div class="col-md-2 mt-3">
                <label>Birth Place</label>
                    <input type="text" class="form-control" value="<?= $view['bplace'];?>">
                </div>
                <div class="col-md-3 mt-3">
                <label>Nationality</label>
                    <input type="text" class="form-control" value="<?= $view['nationality'];?>">
                </div>
                <div class="col-md-3 mt-3">
                <label>Civil Status</label>
                    <input type="text" class="form-control" value="<?= $view['status'];?>">
                </div>
                <div class="col-md-2 mt-3">
                <label>Sex</label>
                    <input type="text" class="form-control" value="<?= $view['sex'];?>">
                </div>
                <div class="col-md-12 mt-3" style="font-size: 18px; font-weight:bold;">Address Details</div>
                <div class="col-md-2 mt-3">
                <label>House No</label>
                    <input type="text" class="form-control" value="<?= $view['houseno'];?>">
                </div>
                <div class="col-md-2 mt-3">
                <label>Purok</label>
                    <input type="text" class="form-control" value="<?= $view['purok'];?>">
                </div>
                <div class="col-md-2 mt-3">
                <label>Street</label>
                    <input type="text" class="form-control" value="<?= $view['street'];?>">
                </div>
                <div class="col-md-3 mt-3">
                <label>Barangay</label>
                    <input type="text" class="form-control" value="<?= $view['brgy'];?>">
                </div>
                <div class="col-md-3 mt-3">
                <label>Municipality</label>
                    <input type="text" class="form-control" value="<?= $view['municipal'];?>">
                </div>
                <div class="col-md-6 mt-3">
                <label>Voter?</label>
                    <input type="text" class="form-control" value="<?= $view['voter'];?>">
                </div>
                <div class="col-md-6 mt-3">
                <label>Family Head?</label>
                    <input type="text" class="form-control" value="<?= $view['family_role'];?>">
                </div>
                <div class="col-md-12 mt-3" style="font-size: 18px; font-weight:bold;">Contact Details</div>
                <div class="col-md-6 mt-3">
                <label>Contact Number</label>
                    <input type="text" class="form-control" value="<?= $view['contact'];?>">
                </div>
                <div class="col-md-6 mt-3">
                <label>Email Address</label>
                    <input type="text" class="form-control" value="<?= $view['email'];?>">
                </div>
            </div>
	    </div>
<!-- Modal for Registering Residents -->
    </div>


    
    <!-- /.container-fluid -->

<!-- End of Main Content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
<!-- responsive tags for screen compatibility -->
<meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
<!-- custom css --> 
<link href="../BarangaySystem/customcss/regiformstyle.css" rel="stylesheet" type="text/css">
<!-- bootstrap css --> 
<link href="../BarangaySystem/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"> 
<!-- fontawesome icons -->
<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="../BarangaySystem/bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

<?php 
    include('dashboard_sidebar_end.php');
?>
