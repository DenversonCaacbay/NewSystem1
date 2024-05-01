<?php
    error_reporting(E_ALL ^ E_WARNING);
    include('classes/staff.class.php');
    include('classes/resident.class.php');

    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $view = $residentbmis->view_feedback();

    // var_dump($view);

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
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
                <div class="col-md-4 mt-3">
                    <div class="card p-3">
                        <h4 class="fw-bold"><?= $view['fname'];?> <?= $view['lname'];?></h4>
                        <h5><b>Comment:</b> <br><?= $view['comment'];?></h5>
                        <h5><b>Rate:</b> <?= $view['rating'];?></h5>
                    </div>
                </div>
            <?php }?>
        <?php } ?>
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