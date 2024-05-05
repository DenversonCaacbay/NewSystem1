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



<?php 
    include('dashboard_sidebar_start.php');
?>
<link rel="stylesheet" href="css/dashboard.css" />
<!-- Begin Page Content -->
<div class="container-fluid page--container">

<!-- Page Heading -->
    <h4 class="mt-3">Resident Feedbacks</h4>
    <div class="row">
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
                <div class="col-md-4 mt-3">
                    <div class="card d-flex flex-column h-100 p-3">
                        <!-- <h4 class="card-title text-primary fw-bold"><?= $view['fname'];?> <?= $view['lname'];?></h4> -->
                        <h4 class="card-title text-primary fw-bold">Unknown Resident</h4>
                        <h5 class="card-desc"><b>Comment:</b> <br><?= $view['comment'];?></h5>
                        <div class="mt-auto">
                            <h5><b>Rate:</b> 
                                <?php
                                $rating = $view['rating'];
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $rating) {
                                        echo '<i class="fas fa-star text-primary"></i>';
                                    } else {
                                        echo '<i class="far fa-star text-primary"></i>';
                                    }
                                }
                                ?>
                            </h5>
                        </div>
                    </div>
                </div>
            <?php }?>
        <?php } ?>
    </div>
</div>

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