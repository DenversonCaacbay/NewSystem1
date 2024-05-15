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
                    <div class="card d-flex flex-column h-100 p-3" onclick="showModal('<?= $view['fname'];?> <?= $view['lname'];?>', '<?= $view['comment'];?>', <?= $view['rating'];?>)">
                        <h4 class="card-title text-primary fw-bold">Unknown Resident</h4>
                        <h6 class="card-desc"><b>Comment:</b> <br><?= strlen($view['comment']) > 30 ? substr($view['comment'], 0, 30) . '...' : $view['comment'];?></h6>
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

<!-- Modal HTML (Assuming Bootstrap Modal) -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resident Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 id="modalName"></h4>
                <h5><b>Comment:</b></h5>
                <p id="modalComment"></p>
                <h5><b>Rate:</b></h5>
                <p id="modalRating"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript function to show modal -->
<script>
    function showModal(name, comment, rating) {
        // Code to display modal with full information
        // You can use JavaScript libraries like Bootstrap modal or create your own modal
        // Here is a simple example using Bootstrap modal:
        $('#exampleModal').modal('show'); // Assuming you have a modal with id "exampleModal"
        
        // Set modal content
        document.getElementById('modalName').innerText = name;
        document.getElementById('modalComment').innerText = comment;
        document.getElementById('modalRating').innerHTML = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= rating) {
                document.getElementById('modalRating').innerHTML += '<i class="fas fa-star text-primary"></i>';
            } else {
                document.getElementById('modalRating').innerHTML += '<i class="far fa-star text-primary"></i>';
            }
        }
    }
</script>

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