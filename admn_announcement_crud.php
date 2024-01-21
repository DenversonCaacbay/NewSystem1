<?php
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
   $bmis->create_announcement();
   $bmis->delete_announcement();
   $view = $bmis->view_announcement();
   $announcementcount = $bmis->count_announcement();

   $dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
   $tm = new DateTime("now", new DateTimeZone('Asia/Manila'));
   $cdate = $dt->format('Y/m/d');   
   $ctime = $tm->format('H');

?>

<?php 
    include('dashboard_sidebar_start.php');
?>

<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row"> 
        <div class="col-md-12"> 
            <h1 class="mb-4 text-center">Event Announcement Page</h1>
        </div>
    </div>


    <br>
      
    <div class="row"> 
        <div class="col-sm-4"> 
            <div class="card">
                <div class="card-header bg-primary text-white" style="font-size: 20px;"> Event Announcement Form </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row"> 
                            <div class="col">
                                <h6>
                                    <i class="fas fa-bullhorn"></i>
                                    Announcement Message
                                </h6>
                                <br>
                                <input type="file" class="form-control" name="picture" required>
                                <textarea name="event" class="form-control mt-3" rows="6" placeholder="Enter Message Here"></textarea>
                            </div>
                        </div>

                        <br>
                        <hr class="w-100">

                        <div class="row"> 
                            <div class="col"> 
                                <input type="hidden" name="start_date" value="<?= $cdate?>">
                                <input name="addedby" type="hidden" value="<?= $userdetails['surname']?>, <?= $userdetails['firstname']?>">
                                <button type="submit" name="create_announce" class="btn btn-primary w-100"> Submit Entry </button>
                            </div>
                        </div>       
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-8"> 
            <div class="card">
                <div class="card-header bg-primary text-white" style="font-size: 20px;"> Current Announcement Posted </div>
                <div class="card-body">
                    <div class="card p-2">
                        <?php if(is_array($view)) {?>
                            <?php foreach($view as $view) {?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <?php if (is_null($view['picture'])): ?>
                                            <img id="blah" src="assets/default-thumbnail.jpg" class="img-fluid" width="250" height="200" alt="Poster Picture">
                                        <?php else: ?>
                
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="openModal('<?= $view['picture'] ?>', '<?= $view['category'] ?>')">
                                                <img src="<?= $view['picture'] ?>" class="img-fluid" alt="Modal Image" width="50">
                                        </a>

                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-8">
                                    <h4><b>Description:</b><br> <?= $view['event'];?> </h4>
                                    <h4><b>Created At:</b> <?= $view['start_date'];?> </h4>
                                    <h4><b>Created by:</b> <?= $view['addedby'];?> </h4>   
                                    <form action="" method="post">
                                            <input type="hidden" name="id_announcement" value="<?= $view['id_announcement'];?>">
                                            <button class="btn btn-danger" type="submit" name="delete_announcement"> Remove </button>
                                        </form>    
                                    </div>
                                </div>
                                           
                               
                            <?php }?>
                        <?php } ?>
                    </div>
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
<link href="../customcss/regiformstyle.css" rel="stylesheet" type="text/css">
<!-- bootstrap css --> 
<link href="..//bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"> 
<!-- fontawesome icons -->
<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="..//bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

<?php 
    include('dashboard_sidebar_end.php');
?>
