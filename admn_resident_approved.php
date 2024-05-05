<?php
    
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
//    $view = $residentbmis->view_approved_account();

   $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
   $limit = 5;
   $offset = ($currentPage - 1) * $limit;

   list($view, $moreRecords) = $residentbmis->view_approved_account($limit, $offset);

   $residentbmis->create_resident();
   $residentbmis->update_resident();
   $residentbmis->delete_resident();
   

   $rescount = $residentbmis->count_resident();
   $rescountm = $residentbmis->count_male_resident();
   $rescountf = $residentbmis->count_female_resident();
   $rescountfh = $residentbmis->count_head_resident();
   $rescountfm = $residentbmis->count_member_resident();
   
?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<link rel="stylesheet" href="css/table.css"/>
<style>
    .input-icons i {
        position: absolute;
    }
        
    .input-icons {
        margin-bottom: 20px;
        margin-left: 0%;
    }
        
    .icon {
        padding: 10px;
        min-width: 40px;
    }

    .search{
        text-align: center;
    }
</style>

    <!-- Begin Page Content -->
    <div class="container-fluid page--container">
        <div class="row">
            <div class="col-md-8"> <h4 class="mb-0 ms-2">Viewing Approved Accounts</h4></div>
            <div class="col-md-4"><a class="btn btn-primary me-3" style="float:right"  href="admn_resident_crud.php"> Back </a></div>
           
        </div>

        <!-- Page Heading -->


        <div class="col-md-12 mt-4">
			<form method="POST" action="">
                <div class="input-icons d-flex">
                    <i class="fa fa-search icon"></i>
                    <input type="search" class="form-control search" name="keyword" style="border-radius: 5px;" value="" required=""/>
                    <button class="btn btn-success ms-3" name="search_resident" >Search</button>
                    <a href="admn_resident_approved.php" class="btn btn-info ms-3" >Reload</a>
                </div>
			</form>
            <div class="row ">
                <div class="col-md-12 page--table">
                    <?php 
                        include('resident_register/resident_approved.php');
                    ?>
                </div>
                <div class="pagination d-flex fixed-bottom mt-3 me-3">
                    <?php if ($currentPage > 1): ?>
                        <a class="btn btn-primary" href="?page=<?= $currentPage - 1 ?>">Prev</a>
                    <?php endif; ?>

                    <span class="current-page mt-1 me-3 ms-3">Page <?= $currentPage ?></span>

                    <?php if ($moreRecords): ?>
                        <a class="btn btn-primary me-2" href="?page=<?= $currentPage + 1 ?>">Next</a>
                    <?php endif; ?>
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
<link href="../BarangaySystem/customcss/regiformstyle.css" rel="stylesheet" type="text/css">
<!-- bootstrap css --> 
<link href="../BarangaySystem/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"> 
<!-- fontawesome icons -->
<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="../BarangaySystem/bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

<?php 
    include('dashboard_sidebar_end.php');
?>
