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
<style>
    .container--announcement{
        height: 400px;
    }
    .announcement-text{
        font-size: 20px;
    }
    .card-announcement{
        height:700px; 
        overflow: auto;
    }
    .card-header{
        font-size:  20px;
    }
    .btn-sample{
        font-size: 20px;
    }
    code{
        font-size: 15px;
    }
    label{
        font-size:15px;
    }
   @media screen and (max-width: 1420px) {
    .announcement-text{
        font-size: 12px;
    }
    .card-announcement{
        height:400px; 
        overflow: auto;
    }
    .card-header{
        font-size: 13px;
    }
    .btn-sample{
        font-size: 15px;
    }
    code{
        font-size: 10px;
    }
    label{
        font-size:10px;
    }
   }
</style>
<!-- Begin Page Content -->

<div class="container-fluid container--announcement">

    <!-- Page Heading -->

    <div class="row"> 
        <div class="col-md-12 d-flex"> 
            <h4 class="mb-4 flex-grow-1">Event Announcement Page</h4>
        </div>
    </div>
      
    <div class="row"> 
        <div class="col-md-4"> 
            <div class="card">
                <div class="card-header bg text-white"> Event Announcement Form <a class="btn btn-sample btn-primary " style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-images"></i></a></div>
                <div class="card-body">
                
                    <form method="post" enctype="multipart/form-data">
                    <code><i>Note:</i> Image should be like banner format, click see sample to view sample banner.</code>
                        <div class="row"> 
                            <div class="col">
                                <input type="file" class="form-control" name="announcement_image" required>
                                <label class="mt-2">Title</label>
                                <input type="text" class="form-control" name="announcement_title" required>
                                <label class="mt-2">Description</label>
                                <textarea name="event" class="form-control" rows="4" placeholder="Enter Message Here" required></textarea>
                                <label class="mt-2">Date and Time</label>
                                <input type="datetime-local" class="form-control" name="announcement_datetime" required>
                                <input type="text" name="status" value="Ongoing" hidden>
                            </div>
                        </div>

                        <div class="row mt-3"> 
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
        <div class="col-md-8"> 
            <div class="card card-announcement">
                <div class="card-header bg text-white sticky-top"> Current Announcement Posted </div>
                <div class="card-body mb-2">
                    <!-- <div class="card p-2"> -->
                        <?php if(is_array($view)) {?>
                            <?php foreach($view as $view) {?>
                                <div class="card mt-1 p-2">

                                <div class="row">
                                    <div class="col-md-4">
                                        <?php if (is_null($view['announcement_image'])): ?>
                                            <img id="blah" src="assets/default-thumbnail.jpg" class="img-fluid" width="250" height="200" alt="Poster Picture">
                                        <?php else: ?>
                
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="openModal('<?= $view['picture'] ?>', '<?= $view['category'] ?>')">
                                                <img src="<?= $view['announcement_image'] ?>" class="img-fluid" alt="Modal Image" width="250">
                                        </a>

                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-8">
                                    <h4 class="announcement-text"><b>Title:</b><br> <?= $view['announcement_title'];?> </h4>
                                    <h4 class="announcement-text"><b>Description:</b><br> <?= $view['event'];?> </h4>
                                    <h4 class="announcement-text"><b>Event Date:</b><br> <?= $view['announcement_datetime'];?> </h4>
                                    <h4 class="announcement-text"><b>Created at:</b> <?= date("F d, Y", strtotime($view['start_date'])); ?></h4>
                                    <h4 class="announcement-text"><b>Created by:</b> <?= $view['addedby'];?> </h4>   
                                    <form action="" method="post">
                                            <input type="hidden" name="id_announcement" value="<?= $view['id_announcement'];?>">
                                            <button class="btn btn-danger" type="submit" name="delete_announcement"> Remove </button>
                                            <!-- <button class="btn btn-primary p-2" type="submit" name="delete_announcement"> Mark As Done </button> -->
                                        </form>    
                                    </div>
                                </div>

                                </div>
                                           
                               
                            <?php }?>
                        <?php } ?>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Sample Banner Image</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <code>Image Size: 960 x 523</code>
        <img src="uploads/announcements/1706245737.jpg" alt="" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


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
