<?php
    
   error_reporting(E_ALL ^ E_WARNING);
   ini_set('display_errors',0);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
   $view = $residentbmis->view_rejected_account();
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
<style>
    .input-icons i {
        position: absolute;
    }
        
    .input-icons {
        width: 30%;
        margin-bottom: 20px;
        margin-left: 34%;
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
    <div class="container-fluid">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8"> <h1 class="mb-0">Viewing Declined Accounts</h1></div>
            <div class="col-md-4"><a class="btn btn-primary" style="float:right"  href="admn_resident_crud.php"> Back </a></div>
           
        </div>
    </div>

        <!-- Page Heading -->


        <div class="col-md-12 mt-4">
        <form method="POST" action="">
                <div class="input-icons d-flex">
                    <i class="fa fa-search icon"></i>
                    <input type="search" class="form-control search" name="keyword" style="border-radius: 30px;" value="" required=""/>
                    <button class="btn btn-success" name="search_resident" style="width: 90px; font-size: 17px; border-radius:30px; margin-left:10px;">Search</button>
                    <a href="admn_disapproved_resident.php" class="btn btn-info" style="width: 90px; font-size: 17px; border-radius:30px; margin-left:10px;">Reload</a>
                </div>
			</form>
		<?php 
            include('resident_register/resident_disapproved.php');
        ?>
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
