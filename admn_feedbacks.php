<?php
    error_reporting(E_ALL ^ E_WARNING);
    include('classes/staff.class.php');
    include('classes/resident.class.php');

    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();

    $rescount = $residentbmis->count_resident();
    $rescountm = $residentbmis->count_male_resident();
    $rescountf = $residentbmis->count_female_resident();
    $rescountfh = $residentbmis->count_head_resident();
    $rescountfm = $residentbmis->count_member_resident();
    $rescountvoter = $residentbmis->count_voters();
    $rescountsenior = $residentbmis->count_resident_senior();
    $staffcount = $staffbmis->count_staff();
?>

<link rel="stylesheet" href="css/dashboard.css" />

<?php 
    include('dashboard_sidebar_start.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid dashboard--container">

<!-- Page Heading -->
    <h4> Feedbacks - Ongoing</h4>
    <div class="row">
        <div class="col-md-4 mt-3">
            <div class="card p-3">
                <h4 class="fw-bold">Unknown 1</h4>
                <h5><b>Comment:</b> <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et tortor at risus viverra adipiscing at.</h5>
                <h5><b>Rate:</b> 3</h5>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card p-3">
                <h4 class="fw-bold">Unknown 1</h4>
                <h5><b>Comment:</b> <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et tortor at risus viverra adipiscing at.</h5>
                <h5><b>Rate:</b> 3</h5>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card p-3">
                <h4 class="fw-bold">Unknown 1</h4>
                <h5><b>Comment:</b> <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et tortor at risus viverra adipiscing at.</h5>
                <h5><b>Rate:</b> 3</h5>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card p-3">
                <h4 class="fw-bold">Unknown 1</h4>
                <h5><b>Comment:</b> <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et tortor at risus viverra adipiscing at.</h5>
                <h5><b>Rate:</b> 3</h5>
            </div>
        </div>
    </div>


<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
<!-- responsive tags for screen compatibility -->
<meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
<!-- custom css --> 
<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>
                
<?php 
    include('dashboard_sidebar_end.php');
?>