<?php
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
   $clearance_approved = $residentbmis->count_clearance_approved();
   $clearance_decline = $residentbmis->count_clearance_decline();

    $bspermit_approved = $residentbmis->count_bspermit_approved();
    $bspermit_decline = $residentbmis->count_bspermit_decline();

    $brgyid_approved = $residentbmis->count_brgyid_approved();
    $brgyid_decline = $residentbmis->count_brgyid_decline();

    $indigency_approved = $residentbmis->count_indigency_approved();
    $indigency_decline = $residentbmis->count_indigency_decline();

    $residency_approved = $residentbmis->count_residency_approved();
    $residency_decline = $residentbmis->count_residency_decline();


?>

<?php 
    include('dashboard_sidebar_start.php');
?>

<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row"> 
        <div class="col-md-12"> 
            <h4 class=" text-center">Archives</h4>
        </div>
    </div>
      
    <div class="row"> 
        
        <div class="col-sm-6 mt-2">
            <div class="card p-2">
                <div class="card-body">
                    <h4 class="card-title">Barangay Residency</h4>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-subtitle mb-2 text-muted">Decline: <?= $residency_decline?></h5>
                            <h5 class="card-subtitle mb-2 text-muted">Approved: <?= $residency_approved?></h5>
                        </div>
                        <a href="archive_residency.php" class="btn btn-primary w-25 align-self-center">View</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-2">
            <div class="card p-2">
                <div class="card-body">
                    <h4 class="card-title">Barangay ID</h4>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-subtitle mb-2 text-muted">Approved: <?= $brgyid_approved?></h5>
                            <h5 class="card-subtitle mb-2 text-muted">Decline: <?= $brgyid_decline?></h5>
                        </div>
                        <a href="archive_brgyid.php" class="btn btn-primary w-25 align-self-center">View</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-2">
            <div class="card p-2">
                <div class="card-body">
                    <h4 class="card-title">Business Recommendation</h4>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-subtitle mb-2 text-muted">Approved: <?= $bspermit_approved?></h5>
                            <h5 class="card-subtitle mb-2 text-muted">Decline: <?= $bspermit_decline?></h5>
                        </div>
                        <a href="archive_bspermit.php" class="btn btn-primary w-25 align-self-center">View</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-2">
            <div class="card p-2">
                <div class="card-body">
                    <h4 class="card-title">Barangay Clearance</h4>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-subtitle mb-2 text-muted">Approved: <?= $clearance_approved?></h5>
                            <h5 class="card-subtitle mb-2 text-muted">Decline: <?= $clearance_decline?></h5>
                        </div>
                        <a href="archive_clearance.php" class="btn btn-primary w-25 align-self-center">View</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-2">
            <div class="card p-2">
                <div class="card-body">
                    <h4 class="card-title">Certificate of Indigency</h4>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-subtitle mb-2 text-muted">Approved: <?= $indigency_approved?></h5>
                            <h5 class="card-subtitle mb-2 text-muted">Decline: <?= $indigency_decline?></h5>
                        </div>
                        <a href="archive_indigency.php" class="btn btn-primary w-25 align-self-center">View</a>
                    </div>
                </div>
            </div>
        </div>

    <br><br>



    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
<!-- responsive tags for screen compatibility -->
<meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
<!-- custom css --> 
<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="..//bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

<?php 
    include('dashboard_sidebar_end.php');
?>
